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

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Workout::class => WorkoutPolicy::class,
        Exercise::class => ExercisePolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
