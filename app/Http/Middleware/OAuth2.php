<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class OAuth2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $access_token = $request->ajax() ? $request->header('Authorization') : $request->session()->get('access_token');

        $headers = [
            'Accept' => "application/json",
            'Authorization' => "Bearer " . $access_token,
        ];

        $response = Http::withHeaders($headers)->get(env('PASSPORT_SERVER_CHECK_USER'));

        if (@$response->object()->message == "Unauthenticated." || !isset($response->object()->user)) {
            if ($request->ajax()) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 1, 'message' => "No autorizado."]);
                exit;
            } else {
                header('Location: /iniciar-sesion');
            }
        } else {
            $user = $response->object()->user;
            $permissions = [];
            foreach($response->object()->permissions as $p) {
                $permissions[] = $p->permission_code;
            }
            @$user->permissions = $permissions;
            $request->setUserResolver(function () use ($user) {
                return $user;
            });
        }

        return $next($request);
    }
}
