<?php

namespace App\Bootstrappers;

use Stancl\Tenancy\Contracts\TenancyBootstrapper;
use Stancl\Tenancy\Contracts\Tenant;

class UrlTenancyBootstrapper implements TenancyBootstrapper
{
    protected $originalUrl;
    protected $originalAssetUrl;
    protected $originalSessionPath;

    public function bootstrap(Tenant $tenant): void
    {
        // Store original values
        $this->originalUrl = config('app.url');
        $this->originalAssetUrl = config('app.asset_url');
        $this->originalSessionPath = config('session.files');

        // Get the current request's host and scheme
        $request = request();
        $scheme = $request->getScheme();
        $host = $request->getHost();
        $port = $request->getPort();

        // Build the new URL
        $newUrl = $scheme . '://' . $host;
        if ($port && $port != 80 && $port != 443) {
            $newUrl .= ':' . $port;
        }

        // Set tenant-specific session path
        $tenantSessionPath = storage_path('framework/sessions/tenant_' . $tenant->id);
        if (!is_dir($tenantSessionPath)) {
            mkdir($tenantSessionPath, 0755, true);
        }

        // Update config
        config([
            'app.url' => $newUrl,
            'app.asset_url' => $newUrl,
            'session.files' => $tenantSessionPath,
        ]);

        // Update URL generator
        url()->forceRootUrl($newUrl);
    }

    public function revert(): void
    {
        // Restore original values
        config([
            'app.url' => $this->originalUrl,
            'app.asset_url' => $this->originalAssetUrl,
            'session.files' => $this->originalSessionPath,
        ]);

        url()->forceRootUrl($this->originalUrl);
    }
}
