<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Training;
use App\Models\User;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     * Nur der Account, welcher das Training erstellt hat, darf dieses auch bearbeiten.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Anpassung hier von Julian Fleischmann – Zeile 24
        Gate::define('update-training', function (User $user, Training $training) {
            return $user->id === $training->user_id;
        });
        // bis hier
    }
}
