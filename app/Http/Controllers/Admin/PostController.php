<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(20);
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $post = new Post();
        $categories = Category::all();
        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:posts|min:5|max:50',
            'content' => 'required |string',
            'image' => 'nullable|mimes:jpeg,bmp,png,ico',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title, '-');
        $post = new Post();
        $post->user_id = Auth::id();
        $post->fill($data);
        if (array_key_exists('image', $data)) {
            $img_path = Storage::put('img', $data['image']);
            $post->image = $img_path;
        }
        $post->save();

        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

        return redirect()->route('admin.posts.index')->with('message', 'Il nuovo post è stato creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        $post_tag_ids = $post->tags->pluck('id')->toArray();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'post_tag_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:5', 'max:50'],
            'content' => 'required |string',
            'image' => 'nullable|mimes:jpeg,bmp,png,ico',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->title, '-');

        if (array_key_exists('image', $data)) {
            if ($post->image) Storage::delete($post->image);
            $img_path = Storage::put('img', $data['image']);
            $post->image = $img_path;
        }
        $post->update($data);

        if (array_key_exists('tags', $data)) $post->tags()->sync($data['tags']);
        else $post->tags()->detach();

        return redirect()->route('admin.posts.show', compact('post'));
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) Storage::delete($post->image);

        if (count($post->tags)) $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
