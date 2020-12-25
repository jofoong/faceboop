<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('destroy-post', function(User $user, Post $post) {
            return $user->id === $post->user_id;
        });
        Gate::define('destroy-comment', function(User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });

        Gate::define('update-post', function(User $user, Post $post) {
            return $user->id === $post->user_id;
        });
        Gate::define('update-comment', function(User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });

        Gate::define('isAdmin', function($user) {
            return $user->role === 'admin';
        });
        Gate::define('isUser', function($user) {
            return $user->role === 'user';
        });
    }
}
