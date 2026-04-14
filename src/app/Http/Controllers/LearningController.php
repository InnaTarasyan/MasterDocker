<?php

namespace App\Http\Controllers;

use App\Support\LessonRepository;

class LearningController extends Controller
{
    public function home()
    {
        return view('home', [
            'topicPreview' => LessonRepository::topicPreview(),
        ]);
    }

    public function learnIndex()
    {
        return view('learn.index', [
            'lessons' => LessonRepository::all(),
            'activeSlug' => null,
        ]);
    }

    public function lesson(string $slug)
    {
        $lesson = LessonRepository::findBySlug($slug);

        abort_if(! $lesson, 404);

        return view('learn.show', [
            'lesson' => $lesson,
            'lessons' => LessonRepository::all(),
            'activeSlug' => $slug,
            'nextLesson' => $lesson['next_slug'] ? LessonRepository::findBySlug($lesson['next_slug']) : null,
        ]);
    }

    public function roadmap()
    {
        return view('roadmap', [
            'roadmap' => LessonRepository::roadmap(),
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
