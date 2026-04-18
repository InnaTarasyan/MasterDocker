<?php

namespace App\Http\Controllers;

use App\Support\LessonRepository;
use Illuminate\Support\Facades\Gate;

class LearningController extends Controller
{
    public function home()
    {
        $topicPreview = collect(LessonRepository::topicPreview())
            ->map(function (array $lesson): array {
                $lesson['can_view'] = Gate::allows('view-lesson', $lesson);

                return $lesson;
            })
            ->values()
            ->all();

        return view('home', [
            'topicPreview' => $topicPreview,
        ]);
    }

    public function learnIndex()
    {
        $lessons = collect(LessonRepository::all())
            ->map(function (array $lesson): array {
                $lesson['can_view'] = Gate::allows('view-lesson', $lesson);

                return $lesson;
            })
            ->values()
            ->all();

        return view('learn.index', [
            'lessons' => $lessons,
            'activeSlug' => null,
        ]);
    }

    public function lesson(string $slug)
    {
        $lesson = LessonRepository::findBySlug($slug);

        abort_if(! $lesson, 404);
        Gate::authorize('view-lesson', $lesson);

        return view('learn.show', [
            'lesson' => $lesson,
            'lessons' => LessonRepository::all(),
            'activeSlug' => $slug,
            'nextLesson' => $lesson['next_slug'] ? LessonRepository::findBySlug($lesson['next_slug']) : null,
        ]);
    }

    public function roadmap()
    {
        $roadmap = collect(LessonRepository::roadmap())
            ->map(function (array $group): array {
                $group['steps'] = collect($group['steps'])
                    ->map(function (array $step): array {
                        $lesson = LessonRepository::findBySlug($step['slug']);
                        $step['can_view'] = $lesson ? Gate::allows('view-lesson', $lesson) : false;

                        return $step;
                    })
                    ->all();

                return $group;
            })
            ->all();

        return view('roadmap', [
            'roadmap' => $roadmap,
        ]);
    }

    public function cheatsheet()
    {
        return view('cheatsheet', [
            'cheatsheet' => LessonRepository::cheatsheet(),
        ]);
    }

    public function projects()
    {
        return view('projects', [
            'projects' => LessonRepository::projects(),
        ]);
    }
}
