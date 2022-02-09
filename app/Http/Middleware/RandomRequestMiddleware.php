<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class RandomRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $presents = User::getAvailablePresents()->random();

        $route = $request->route();

        $routeAction = array_merge($route->getAction(), [
            'uses' => $presents . '@' . $route->getActionMethod(),
            'controller' => $presents . '@' . $route->getActionMethod(),
        ]);

        $route->setAction($routeAction);
        $route->controller = false;

        return $next($request);
    }
}
