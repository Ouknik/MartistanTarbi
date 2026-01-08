<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Symfony\Component\Console\Output\BufferedOutput;

class ConfigurationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $configuration = Configuration::first();
        return Inertia::render('Admin/Reglages/Index', [
            'configuration' => $configuration,
        ]);
    }





    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $logo_name = null;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $logo_name = time() . '.' . $image->getClientOtiginalExtension();
            $destinationPath = public_path('/images/logo');
            $image->move($destinationPath, $logo_name);
        } else if ($request->filled('logo')) {
            $logoUrl = $request->input('logo');
            $parsedUrl = parse_url($logoUrl);
            if (isset($parsedUrl['host']) && $parsedUrl['host'] === request()->getHttpHost()) {
                $logo_name = basename($parsedUrl['path']);
            }
        }

        $configurationData = [
            'logo' => $logo_name
        ];

        $configuration = Configuration::first();
        if ($configuration) {
            if ($logo_name && $logo_name === $configuration->logo) {
                unset($configurationData['logo']);
            }
            $configuration->save();
        } else {
            Configuration::create($configurationData);
        }
    }

    public function updateLogo(Request $request)
    {

        // dd($request->logo);

        $imagepath = '';

        if ($request->logo) {
            $request->validate([
                'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('logo')) {
                // Générez un nouveau nom unique pour l'image
                $imageName = uniqid() . '.' . $request->file('logo')->getClientOriginalExtension();

                // Stockez l'image avec le nouveau nom
                $imagepath = $request->file('logo')->store('images/logo', 'public');

                // Ajoutez un préfixe au chemin
                $imagepath = '/' . $imagepath;

                // Si vous souhaitez également utiliser move_uploaded_file avec le préfixe
                $imagepath = '/images/logo/' . $imageName;
                move_uploaded_file($request->file('logo'), public_path($imagepath));
            }
        } else {
            $imagepath = 'images/assurances/no-image-available.jpg';
        }

        $users = User::all();

        User::query()->update(['profile_photo_path' => $imagepath]);

        // dd($users,$imagepath);
        // foreach ($users as $user) {
        //     $user->update([
        //         'profile_photo_path' => 1,
        //     ]);
        // }
    }

    public function exportDatabase(Request $request)
    {


        try {
            // Run the backup command without email notifications
            $output = new BufferedOutput();
            $exitCode = Artisan::call('backup:run', [
                '--only-db' => true,
                '--disable-notifications' => true,
            ], $output);

            if ($exitCode === 0) {
                // Get the path to the backup file
                $backupPath = trim($output->fetch());
                
                // Move the backup file to the desktop
                $desktopPath = getenv("HOMEDRIVE") . getenv("HOMEPATH") . '\Desktop\\'; // Desktop path for Windows

                $backupFileName = basename($backupPath);
                $desktopBackupPath = $desktopPath . $backupFileName;

                // Move the backup file to the desktop using Laravel's Storage
                Storage::move($backupPath, $desktopBackupPath);

                return response()->json(['message' => 'Database backup completed successfully. Backup saved to desktop.']);
            } else {
                return response()->json(['error' => 'Database backup failed'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
      
    }
}
