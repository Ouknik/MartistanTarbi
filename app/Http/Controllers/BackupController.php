<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        return inertia('Backup/Index');
    }

    public function store(Request $request)
    {
        $filename = "backup_" . strtotime(now()) . ".sql";
        $command = "mysqldump --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . " > " . storage_path() . "/app/backup/" . $filename;
        exec($command);

        return redirect()->back()->with('success', 'Backup créé avec succès.');
    }
}
