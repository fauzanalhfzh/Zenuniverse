<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegenerateHearts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = clone $request->user();

        if ($user && $user->hearts < 5) {
            if (!$user->last_heart_replenished_at) {
                // If the user has missing hearts but no timer started (e.g., from old data or manual DB change), start it now
                $request->user()->last_heart_replenished_at = now();
                $request->user()->save();
            } else {
                $secondsPassed = abs(now()->diffInSeconds($user->last_heart_replenished_at));
                
                if ($secondsPassed >= 300) {
                    // Calculate how many hearts to add (1 every 300 seconds)
                    $heartsToAdd = floor($secondsPassed / 300);
                    $newHearts = min(5, $user->hearts + $heartsToAdd);
                    
                    // Track leftover seconds to maintain exact cycle
                    $remainderSeconds = $secondsPassed % 300;
                    
                    // Update user
                    $request->user()->hearts = $newHearts;
                    
                    if ($newHearts >= 5) {
                        $request->user()->last_heart_replenished_at = null;
                    } else {
                        $request->user()->last_heart_replenished_at = now()->subSeconds($remainderSeconds);
                    }
                    
                    $request->user()->save();
                }
            }
        }

        return $next($request);
    }
}
