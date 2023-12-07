<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class LinkedInControllerPost extends Controller
{
    public function create()
    {
        return view('linkedin.create_post');
    }

    public function store(Request $request)
    {
        $content = $request->input('content');
        $title = $request->input('title');
        
        $accessToken = env('LINKEDIN_TOKEN');
        if (!$accessToken) {
            return redirect()->back()->withErrors('No se encontró el token de acceso de LinkedIn.');
        }

        $client = new Client();

        try {
        $response = $client->post('https://api.linkedin.com/v2/ugcPosts', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type'  => 'application/json',
            ],
            'body' => json_encode([
                'author' => 'urn:li:person:' . env('CLIENTID_LINKEDIN'),
                'lifecycleState' => 'PUBLISHED',
                'specificContent' => [
                    'com.linkedin.ugc.ShareContent' => [
                        'shareCommentary' => [
                            'text' => $content,
                        ],
                        'shareMediaCategory' => 'NONE',
                    ],
                ],
                'visibility' => [
                    'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
                ],
            ]),
        ]);
        $body = $response->getBody();
        $result = json_decode($body, true);
        } catch (RequestException $e) {
            echo $e->getResponse()->getBody()->getContents();
        }

        if (isset($result['id'])) {
            $Post = new Post();
            $Post->user_id = Auth::user()->id;
            $Post->title = $title;
            $Post->platform= 'LinkedIn';
            $Post->content = $content;
            $Post->status = 'Published';
            $Post->save();
            return redirect('/home')->with('success', 'Publicación exitosa en LinkedIn.');
            
        } else {
            return redirect()->back()->withErrors('Error al publicar en LinkedIn.');
        }
    }
}