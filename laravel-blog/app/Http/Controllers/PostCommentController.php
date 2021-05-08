<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComment;
use App\Mail\CommentPostedMarkdown;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);

        // $when = now()->addMinute();
        // Mail::to($post->user)->later($when, new CommentPostedMarkdown($comment));

        // Mail::to($post->user)->send(new CommentPostedMarkdown($comment));
        Mail::to($post->user)->queue(new CommentPostedMarkdown($comment));

        return redirect()
            ->back()
            ->with('status', 'Comment was created!');
    }
}
