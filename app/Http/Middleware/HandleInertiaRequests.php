<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tofandel\InertiaVueModal\HandlesInertiaModalRequest;

class HandleInertiaRequests extends HandlesInertiaModalRequest
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            // مشاركة بيانات المستخدم المسجل دخوله
            'user' => fn () => $request->user() ? $request->user()->only([
                'id', 'name', 'email', 'type', 'profile_photo_path', 'profile_photo_url'
            ]) : null,
            
            // Flash messages
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
            
            // معلومات التطبيق
            'app' => [
                'name' => config('app.name'),
                'locale' => app()->getLocale(),
            ],
        ]);
    }
}
