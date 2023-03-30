<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Exercise;
use App\Models\User;
use App\Models\Workout;
use App\Policies\ExercisePolicy;
use App\Policies\UserPolicy;
use App\Policies\WorkoutPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Exercise::class => ExercisePolicy::class,
        Workout::class => WorkoutPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
