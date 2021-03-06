<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function createPost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'body' => 'required|min:3',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return response()->json(['status' => 'success', 'data' => $post]);
    }

    public function getPosts()
    {
        $posts  = Post::all();
        return  response()->json(['status' => 'success', 'data' => $posts]);
    }

    public function updatePosts(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'body' => 'required|min:3',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);
        }
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return response()->json(['status' => 'success', 'data' => $post]);
    }

    public function deletePosts($id)
    {
        $post = Post::findOrFail($id);
        $isDeleted = $post->delete();
        if ($isDeleted) {
            return response()->json(['status' => 'success', 'data' => $post]);
        }
    }
}
