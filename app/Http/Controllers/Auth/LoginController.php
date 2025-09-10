<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function index()
    {
        return view('pages.auth.login');
    }

    public function store(StoreLoginRequest $request)
    {
        $credentials = $request->validated();

        if ($this->authRepository->login($credentials)) {
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Email Atau Password Salah!'
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::withTrashed()->where('email', $googleUser->email)->first();

            if ($user) {
                if ($user->trashed()) {
                    $user->restore();
                    if ($user->resident) {
                        $user->resident()->restore();
                    }
                }
                $user->resident()->updateOrCreate(
                    ['user_id' => $user->id],
                    ['avatar' => $googleUser->avatar]
                );
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => null,
                ]);

                $user->resident()->create([
                    'avatar' => $googleUser->avatar,
                ]);

                $user->assignRole('resident');
            }

            Auth::login($user, true);

            return redirect()->intended(route('home'));
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'Gagal melakukan autentikasi dengan Google.'
            ]);
        }
    }

    public function logout()
    {
        $this->authRepository->logout();

        return redirect()->route('login');
    }
}
