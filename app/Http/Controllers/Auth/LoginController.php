<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $state = Str::random(40);
        $request->session()->put('state', $state);

        $query = http_build_query([
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'redirect_uri' => env('PASSPORT_CLIENT_CALLBACK'),
            'response_type' => "code",
            'scope' => "",
            'state' => $state,
        ]);

        return redirect(env('PASSPORT_SERVER_AUTHORIZE') . "?" . $query);
    }

    public function callback(Request $request)
    {
        $state = $request->session()->pull('state');

        throw_unless(strlen($state) > 0 && $state == $request->state, InvalidArgumentException::class);

        $response = Http::asForm()->post(env('PASSPORT_SERVER_TOKEN'), [
            'grant_type' => "authorization_code",
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'redirect_uri' => env('PASSPORT_CLIENT_CALLBACK'),
            'code' => $request->code,
        ]);
        $request->session()->put($response->json());
        return redirect('/');
    }

    public function logout(Request $request)
    {
        $uri = env('APP_PLATFORM_AUTH') . '/logout';
        Session::remove('access_token');
        $request->session()->remove('state');
        // return redirect()->route('iniciar-sesion');
        return redirect()->away($uri);
    }

    public function showFormLogin()
    {
        return view('login');
    }
}
