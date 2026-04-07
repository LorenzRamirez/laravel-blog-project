<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = auth()->user()
            ->posts()
            ->where('active', true)
            ->paginate(10);

        return Inertia::render('Post/Index', ['posts' => $posts]);
    }

    public function create(): Response
    {
        return Inertia::render('Post/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        auth()->user()->posts()->create($validated);

        return redirect()->route('posts.index');
    }

    public function edit(Post $post): Response
    {
        return Inertia::render('Post/Edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->back();
    }
}
