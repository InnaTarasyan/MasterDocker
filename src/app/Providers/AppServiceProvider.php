<?php

namespace App\Providers;

use App\Models\User;
use App\Support\LessonRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-advanced-lessons', fn (?User $user): bool => $user !== null);

        Gate::define('view-lesson', function (?User $user, array $lesson): bool {
            if (! LessonRepository::isAdvancedLesson($lesson['slug'])) {
                return true;
            }

            return Gate::forUser($user)->allows('view-advanced-lessons');
        });
    }
}
