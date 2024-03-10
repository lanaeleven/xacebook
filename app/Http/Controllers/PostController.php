<?php

namespace App\Http\Controllers;

use App\Models\FriendList;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index() {
        $id = Auth::user()->id;
        $friends = Auth::user()->user1;
        $friend_id = [];
        foreach ($friends as $f) {
            array_push($friend_id, $f->user2_id);
        }

        $posts = Post::whereIn('user_id', $friend_id)->orWhere('user_id', $id)->get()->sortDesc();

        return view('home', ['posts' => $posts, 'title' => 'Home']);
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'user_id' => 'required',
            'body' => 'required',
            'image' => 'image|file|max:10240'
        ]);
        
        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('posts-image');
        }

        $post = Post::create($validated);

        return redirect('/');
    }
}
