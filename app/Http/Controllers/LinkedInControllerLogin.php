<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\Http\Controllers\Http;
use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class LinkedInControllerLogin extends Controller
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function redirectToLinkedIn()
    {
        $query = http_build_query([
            'client_id' => env('CLIENTID_LINKEDIN'),
            'response_type' => 'code',
            'state' => csrf_token(),
            'redirect_uri' => env('REDIRECTURI_LINKEDIN'),
            'scope' => 'openid profile w_member_social email ',
        ]);

        

        return redirect('https://www.linkedin.com/oauth/v2/authorization?' . $query);
    }

    public function handleLinkedInCallback(Request $request)
    {
        if ($request->has('code') && $request->has('state')) {
            // Verificar CSRF token
            if ($request->state !== csrf_token()) {
                return redirect()->back()->withErrors('CSRF token mismatch');
            }

            // Obtener el código de autorización de LinkedIn
            $code = $request->code;

            // Intercambiar el código de autorización por un token de acceso
            $accessToken = $this->getAccessToken($code);

            // Almacena el token de acceso en la sesión
            session(['linkedin_token' => $accessToken]);

            // Obtener el perfil del usuario
            $userProfile = $this->getUserProfile($accessToken);
        
            $linkedinId = $userProfile['sub']; //ID del usuario de LinkedIn.

            // Se busca el usuario por id del usuario autenticado para guardar el token de acceso
            $userId = Auth::user()->id;
            $user = User::where('id', $userId)->first();
            $user->linkedin_access_token = $accessToken;
            $user->linkedin_id = $linkedinId; 
            $user->save();
            
            return redirect('/home');
        }

        return redirect()->back()->withErrors('Authentication failed.');
    }

    protected function getAccessToken($code)
    {
        $response = $this->httpClient->post('https://www.linkedin.com/oauth/v2/accessToken', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('REDIRECTURI_LINKEDIN'),
                'client_id' => env('CLIENTID_LINKEDIN'),
                'client_secret' => env('CLIENTSECRET_LINKEDIN'),
            ],
        ]);

        $data = json_decode((string) $response->getBody(), true);

        return $data['access_token'];
    }

    public function getUserProfile($accessToken)
    {
        $response = $this->httpClient->get('https://api.linkedin.com/v2/userinfo', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ],
        ]);
    
        return json_decode($response->getBody(), true);
    }
}