<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class LinkedInPostController extends Controller
{
    public function create()
    {
        return view('linkedin.create_post');
    }

    public function store(Request $request)
    {
        $content = $request->input('content');
        
        $accessToken = Auth::user()->linkedin_access_token;
        if (!$accessToken) {
            return redirect()->back()->withErrors('No se encontró el token de acceso de LinkedIn.');
        }

        $client = new Client();
        $response = $client->post('https://api.linkedin.com/v2/ugcPosts', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type'  => 'application/json',
                'x-li-format'   => 'json',
            ],
            'body' => json_encode([
                'author' => 'urn:li:person:' . Auth::user()->linkedin_id,
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

        if (isset($result['id'])) {
            $Post = new Post();
            $Post->user_id = Auth::user()->id;
            $Post->platform= 'LinkedIn';
            $Post->content = $content;
            $Post->status = 'Published';
            $Post->save();
            return redirect('/dashboard')->with('success', 'Publicación exitosa en LinkedIn.');
            
        } else {
            return redirect()->back()->withErrors('Error al publicar en LinkedIn.');
        }
    }
    public function schedulePost(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'scheduled_at' => 'required|date',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->platform= 'LinkedIn';
        $post->content = $request->content;
        $post->scheduled_at = $request->scheduled_at;
        $post->status = 'Program';
        $post->save();

        return redirect('/home')->with('status', 'Post programado exitosamente!');
    }

    public function addToQueue(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->platform= 'LinkedIn';
        $post->content = $request->content;
        $post->scheduled_at = $request->scheduled_at;
        $post->status = 'Pending';
        $post->save();

        return redirect('/home')->with('status', 'Post added to queue successfully!');
    }
}