<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __contructor()
    {
        $this->middleware('auth');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (auth()->attempt($credentials)) {
                if (auth()->user()->is_admin == 1) {
                    return redirect()->route('admin.home');
                } else {
                    return redirect()->route('home');
                }
            } else {
                return redirect()->back()->with('error', trans('home.Notlogin'));
            }
        } catch (Throwable $e) {
            return redirect()->back()->with('error', trans('home.notsuccess'));
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('susccess', trans('home.logoutsucess'));
    }

    protected $providers = [
        'facebook','google'
    ];

    public function show()
    {
        return view('social.login');
    }

    public function redirectToProvider($driver)
    {
        if( ! $this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }


    public function handleProviderCallback( $driver )
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        return empty( $user->email )
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendSuccessResponse()
    {
        return redirect()->route('home');
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('get.login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        $user = User::where('email', $providerUser->getEmail())->first();
        if( $user ) {
            $user->update([
                'avatar' => $providerUser->avatar,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } else {
            $user = User::create([
                'fullname' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'avatar' => $providerUser->getAvatar(),
                'phone' => '',
                'provider' => $driver,
                'is_admin'=>0,
                'provider_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
                'password' => ''
            ]);
        }
        Auth::login($user, true);

        return $this->sendSuccessResponse();
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
