<?php

namespace App\Providers;

use App\Models\Lesson;
use App\Models\User;
use App\Policies\LessonPolicy;
use App\Support\LessonRepository;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
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
        Gate::policy(Lesson::class, LessonPolicy::class);

        Gate::define('view-advanced-lessons', fn (?User $user): bool => $user !== null);

        Gate::define('view-lesson', function (?User $user, Lesson $lesson): bool {
            return Gate::forUser($user)->allows('view', $lesson);
        });

        Route::bind('lesson', function (string $slug): Lesson {
            $lesson = LessonRepository::findBySlug($slug);
            abort_if(! $lesson, 404);

            return Lesson::fromArray($lesson);
        });

        Blade::if('advancedLesson', function (array $lesson): bool {
            return LessonRepository::isAdvancedLesson($lesson['slug']);
        });
    }
}
