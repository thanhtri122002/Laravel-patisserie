<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use App\Models\Visit;
use Jenssegers\Agent\Agent;
/**
 * A middleware used to track the number of site visit
 * @description - Retrieve a visitor id, if not create a new one, create a new visit model
 */
class TrackVisit
{
    public function handle($request, Closure $next)
    {
        $visitorId = $request->cookie('visitor_id') ?: (string) Str::uuid();

        if (!$request->cookie('visitor_id')) {
            cookie()->queue(cookie('visitor_id', $visitorId, 60 * 24 * 365));
        }

        $agent = new Agent();

        Visit::create([
            'ip'         => $request->ip(),
            'device'     => $agent->device(),
            'platform'   => $agent->platform(),
            'browser'    => $agent->browser(),
            'visitor_id' => $visitorId,
            'url'        => $request->path(),
        ]);

        return $next($request);
    }
}
