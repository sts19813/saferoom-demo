<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

class EnsureDemoAccess
{
    /**
     * Require an authenticated demo account and reject direct navigation to a
     * module that the selected role does not operate.
     *
     * @param  Closure(Request): BaseResponse  $next
     */
    public function handle(Request $request, Closure $next): BaseResponse
    {
        $user = collect(config('demo.users'))->firstWhere('id', $request->session()->get('demo_user'));

        if (! $user) {
            return redirect()->guest(route('login'));
        }

        $view = (string) ($request->route()->defaults['data']['view'] ?? '');
        $permissions = config("demo.permissions.{$user['role']}", []);

        if (! in_array('*', $permissions, true) && ! in_array($view, $permissions, true)) {
            return redirect()->route($this->fallbackRoute($permissions))
                ->with('access_error', 'Tu perfil no tiene permiso para consultar ese módulo.');
        }

        $request->attributes->set('demoUser', Arr::except($user, 'password'));

        return $next($request);
    }

    /** @param array<int, string> $permissions */
    private function fallbackRoute(array $permissions): string
    {
        return in_array('access', $permissions, true) && count($permissions) === 1
            ? 'access.index'
            : 'dashboard';
    }
}
