<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginRestriction;
use Carbon\Carbon;

class LoginTimeRestriction
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && !in_array($user->id, [1, 2])) {

             if ($user->is_active == 0) {
            Auth::logout(); // Log the user out immediately if they're inactive
            return redirect()->route('login')->withErrors([
                'email' => 'Your account is inactive. Please contact support.',
            ]);
        }
        
            $restriction = LoginRestriction::latest()->first();

            if ($restriction) {
                $now = Carbon::now();
                $start = Carbon::createFromTimeString($restriction->start_time);
                $end = Carbon::createFromTimeString($restriction->end_time);

                if (!$now->between($start, $end)) {
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'email' => 'Login is allowed only between ' . $start->format('h:i A') . ' and ' . $end->format('h:i A'),
                    ]);
                }
            }
        }

        return $next($request);
    }

    
}
