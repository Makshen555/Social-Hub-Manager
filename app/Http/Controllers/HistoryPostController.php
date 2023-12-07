<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HistoryPostController extends Controller
{
    public function showHistory()
    {
        $userId= Auth::user()->id;
        $posts = Post::where('user_id', $userId)
            ->orderBy('created_at')
            ->paginate(10);
        return view('history.schedulePosts', compact('posts'));
    }
}