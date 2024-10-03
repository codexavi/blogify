<?php

namespace App\Providers;

use App\Models\Comment; // Import the model
use App\Policies\CommentPolicy; // Import the policy
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Comment::class => CommentPolicy::class, // Register the CommentPolicy
    ];

    /**
     * Register any authentication/authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
