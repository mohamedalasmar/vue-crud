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

    public function getPosts(){
        $posts  = Post::all();
        return  response()->json(['status'=>'success','data'=>$posts]);
    }


}
