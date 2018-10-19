<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 10/07/2018
 * Time: 12:07
 */

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
//            if ($request->ajax()) {
//                return response('Unauthorized.', 401);
//            } else {
                switch ($guard) {
                    case 'jogador':
                        $path = 'vendedor/entrar';
                        break;

                    default:
                        $path = 'admin/login';
                        break;
                }
                return redirect()->guest($path);
//            }
        }
        return $next($request);
    }
}