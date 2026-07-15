<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 🔐 DEFAULT PASSWORD RULE (GLOBAL)
        Password::defaults(function () {
            return Password::min(8)          // minimal 8 karakter
                ->letters()                 // wajib ada huruf
                ->mixedCase()               // huruf besar & kecil
                ->numbers()                 // wajib ada angka
                ->symbols();                 // wajib ada simbol
                // ->uncompromised();          // tidak pernah bocor
        });
    }
}
