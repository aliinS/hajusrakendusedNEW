<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Chirp;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('chirp')->latest()->paginate(10);

        return view('chirps.index', compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'chirp_id' => 'required|exists:chirps,id',
            'content' => 'required|string',
        ]);

        Comment::create([
            'chirp_id' => $request->chirp_id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        // Loading comments for a specific blog post
        $comments = $chirp->comments()->with('user')->get();

        return view('chirps.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {

        $comment->delete();

    }
}