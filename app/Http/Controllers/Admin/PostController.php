<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;

use App\Model\Post;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', ['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $postValidate = $request->validate(
            [
                'title' => 'required|max:240',
                'content' => 'required',
                'category_id' => 'exists:App\Model\Category,id',
                'tags.*' => 'nullable|exists:App\Model\Tag,id',
                'image' => 'nullable|image'
            ]
        );


        if (!empty($data['image'])) {
            $img_path = Storage::put('upload', $data['image']);
            $data['image '] = $img_path;
        }

        $post = new Post();
        $post->fill($data);
        $post->slug = $post->createSlug($data['title']);
        $post->save();

        if (!empty($data['tags'])) {
            $post->tags()->attach($data['tags']);
        }



        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data = [
            'post' => $post,
        ];
        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }


        $postValidate = $request->validate(
            [
                'title' => 'required|max:240',
                'content' => 'required',
                'category_id' => 'exists:App\Model\Category,id',
                'tags.*' => 'nullable|exists:App\Model\Tag,id'
            ]
        );

        if ($data['title'] != $post->title) {
            $post->title = $data['title'];
            $post->slug = $post->createSlug($data['title']);
        }
        if ($data['content'] != $post->content) {
            $post->content = $data['content'];
        }
        if ($data['category_id'] != $post->category_id) {
            $post->category_id = $data['category_id'];
        }

        $post->update();

        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {


        $post->tags()->detach();
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('status', "Post $post->id deleted!");
    }
}
