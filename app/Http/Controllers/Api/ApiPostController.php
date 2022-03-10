<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Post;


class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(8);
        return response()->json([
            'response' => true,
            'results' =>  $posts,
        ]);
    }

    public function inRandomOrder()
    {
        $posts = Post::inRandomOrder()->limit(4)->get();
        return response()->json([
            'response' => true,
            'results' =>  [
                'data' => $posts,
            ]
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return response()->json([
            'response' => true,
            'count' => $post ? 1 : 0,
            'results' =>  [
                'data' => $post
            ],
        ]);
    }
}
