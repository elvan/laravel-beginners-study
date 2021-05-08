<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentPosted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Comment was posted on your {$this->comment->commentable->title} blog post";

        return $this->from('laravel-blog@example.com', 'Blog Admin')
            ->subject($subject)
            // ->attach(
            //     storage_path('app/public') . '/' . $this->comment->user->image->path,
            //     [
            //         'as' => 'profile_picture.jpg',
            //         'mime' => 'image/jpg'
            //     ]
            // )
            // ->attachFromStorage(
            //     $this->comment->user->image->path,
            //     'profile_picture.jpg'
            // )
            // ->attachData(
            //     Storage::get($this->comment->user->image->path),
            //     'profile_picture_from_data.jpg',
            //     [
            //         'mime' => 'image/jpeg'
            //     ]
            // )
            ->view('emails.posts.commented');
    }
}
