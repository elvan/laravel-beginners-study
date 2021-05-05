<?php

namespace App\Http\ViewComposers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer
{
    public function compose(View $view)
    {
        $mostCommented = Cache::remember('blog-post-most-commented', now()->addMinute(), function () {
            return BlogPost::mostCommented()->take(5)->get();
        });
        $mostActiveUsers = Cache::remember('users-most-active', now()->addMinute(), function () {
            return User::withMostBlogPosts()->take(5)->get();
        });
        $mostActiveUsersLastMonth = Cache::remember('users-most-active-last-month', now()->addMinute(), function () {
            return User::withMostBlogPostsLastMonth()->take(5)->get();
        });

        $view->with('mostCommented', $mostCommented);
        $view->with('mostActiveUsers', $mostActiveUsers);
        $view->with('mostActiveUsersLastMonth', $mostActiveUsersLastMonth);
    }
}
