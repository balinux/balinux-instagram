<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('code')) {
            $response = app('guzzle')->request('POST', 'https://api.instagram.com/oauth/access_token', [
                'form_params' => [
                    'client_id' => env('INSTAGRAM_CLIENT_ID'),
                    'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => 'http://balinuxlab.web.id',
                    'code' => $request->code,
                ]
            ]);

            $response = json_decode((string) $response->getBody());
            $response = (array) $response;
            $accessToken = $response['access_token'];

            $response = app('guzzle')->request('GET', 'https://api.instagram.com/v1/users/self/media/liked?access_token=' . $accessToken);
            $response = json_decode((string) $response->getBody());
            $response = (array) $response;

            return view('media', compact('response'));
        }
        $url = sprintf('https://api.instagram.com/oauth/authorize/?client_id=%s&redirect_uri=%s&response_type=code&scope=public_content', env('INSTAGRAM_CLIENT_ID'), 'http://balinuxlab.web.id');

        return view('welcome', compact('url'));
    }
}
