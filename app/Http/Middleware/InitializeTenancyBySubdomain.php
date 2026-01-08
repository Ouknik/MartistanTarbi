<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stancl\Tenancy\Exceptions\NotASubdomainException;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

/**
 * Custom middleware to initialize tenancy by subdomain
 * This fixes issues with the default InitializeTenancyBySubdomain
 */
class InitializeTenancyBySubdomain extends InitializeTenancyByDomain
{
    /**
     * The index of the subdomain fragment in the hostname
     * split by `.`. 0 for first fragment, 1 if you prefix
     * your subdomain fragments with `www`.
     *
     * @var int
     */
    public static $subdomainIndex = 0;

    /** @var callable|null */
    public static $onFail;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $hostname = $request->getHost();
        $subdomain = $this->makeSubdomain($hostname);

        if ($subdomain instanceof \Exception) {
            $onFail = static::$onFail ?? function ($e) {
                throw $e;
            };

            return $onFail($subdomain, $request, $next);
        }

        if ($subdomain instanceof \Illuminate\Http\Response) {
            return $subdomain;
        }

        return $this->initializeTenancy(
            $request,
            $next,
            $subdomain
        );
    }

    /** @return string|\Illuminate\Http\Response|\Exception|mixed */
    protected function makeSubdomain(string $hostname)
    {
        $parts = explode('.', $hostname);

        $isLocalhost = count($parts) === 1;
        $isIpAddress = count(array_filter($parts, 'is_numeric')) === count($parts);

        $isACentralDomain = in_array($hostname, config('tenancy.central_domains'), true);
        $notADomain = $isLocalhost || $isIpAddress;
        $thirdPartyDomain = ! Str::endsWith($hostname, config('tenancy.central_domains'));

        if ($isACentralDomain || $notADomain || $thirdPartyDomain) {
            return new NotASubdomainException($hostname);
        }

        return $parts[static::$subdomainIndex];
    }
}
