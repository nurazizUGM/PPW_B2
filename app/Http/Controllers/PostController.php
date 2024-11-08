<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts  = Post::whereNotNull('picture')->get();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $img = $request->file('picture');
            $data['picture'] = $img->storeAs('posts', $img->hashName(), 'public');
        }

        Post::create($data);

        return redirect()->route('post.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $img = $request->file('picture');
            $data['picture'] = $img->storeAs('posts', $img->hashName(), 'public');
            if ($post->picture && Storage::exists('public/' . $post->picture)) {
                Storage::delete('public/' . $post->picture);
            }
        }

        $post->update($data);
        return redirect()->route('post.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->picture && Storage::exists('public/' . $post->picture)) {
            Storage::delete('public/' . $post->picture);
        }
        $post->delete();
        return redirect()->route('post.index')
            ->with('success', 'Post deleted successfully.');
    }
}
