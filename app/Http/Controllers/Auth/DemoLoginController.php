<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class DemoLoginController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($this->userForId($request->session()->get('demo_user'))) {
            return redirect()->route('dashboard');
        }

        return view('auth.login', ['users' => config('demo.users')]);
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = collect(config('demo.users'))->first(
            fn (array $user): bool => mb_strtolower($user['email']) === mb_strtolower($credentials['email'])
                && hash_equals($user['password'], $credentials['password']),
        );

        if (! $user) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Revisa el correo y la contraseña de demostración.']);
        }

        $request->session()->regenerate();
        $request->session()->put('demo_user', $user['id']);

        return redirect()->intended(route('dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function userForId(?string $id): ?array
    {
        $user = collect(config('demo.users'))->firstWhere('id', $id);

        return $user ? Arr::except($user, 'password') : null;
    }
}
