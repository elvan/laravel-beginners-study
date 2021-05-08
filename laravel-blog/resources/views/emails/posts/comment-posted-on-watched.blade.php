@component('mail::message')
# Comment was posted on post you were commented on

Hi {{ $comment->commentable->user->name }}

Someone has commented on the blog post you were commented on

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
View The Blog Post
@endcomponent

@component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id])])
Visit {{ $comment->user->name }} profile
@endcomponent

@component('mail::panel')
{{ $comment->content }}
@endcomponent

@endcomponent
