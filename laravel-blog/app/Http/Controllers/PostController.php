<?php

namespace App\Http\Controllers;

use App\Events\BlogPostPosted;
use App\Facades\CounterFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'create', 'store', 'edit', 'update', 'destroy'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::latestWithRelations()->get();

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $blogPost = BlogPost::create($validated);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');
            $blogPost->image()->save(Image::make(['path' => $path]));
        }

        event(new BlogPostPosted($blogPost));

        $request->session()->flash('status', 'The blog post was created!');

        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogPost = Cache::remember("blog-post-{$id}", now()->addMinute(), function () use ($id) {
            return BlogPost::with([
                'comments',
                'comments.user',
                'user',
                'tags',
            ])->findOrFail($id);
        });

        return view('posts.show', [
            'post' => $blogPost,
            'counter' => CounterFacade::increment("blog-post-{$id}", ['blog-post']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize($post);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $validated = $request->validated();

        $this->authorize($blogPost);
        $blogPost->fill($validated);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            if ($blogPost->image) {
                Storage::delete($blogPost->image->path);

                $blogPost->image->path = $path;
                $blogPost->image->save();
            } else {
                $blogPost->image()->save(Image::make(['path' => $path]));
            }
        }

        $blogPost->save();
        $request->session()->flash('status', 'The blog post was updated!');

        return redirect()->route('posts.show', ['post' => $blogPost]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize($post);
        $post->delete();
        session()->flash('status', 'The blog post was deleted!');

        return redirect()->route('posts.index');
    }
}
