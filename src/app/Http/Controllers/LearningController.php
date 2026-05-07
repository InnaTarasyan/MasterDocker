<?php

namespace App\Http\Controllers;

use App\Contracts\LessonRepositoryInterface;
use App\Events\LessonViewed;
use App\Models\Lesson;
use App\Services\LearningProgressService;
use Illuminate\Support\Facades\Gate;

class LearningController extends Controller
{
    public function __construct(
        private readonly LessonRepositoryInterface $lessons,
        private readonly LearningProgressService $progress,
    ) {
    }

    public function home()
    {
        $topicPreview = collect($this->lessons->topicPreview())
            ->map(function (array $lesson): array {
                $lesson['can_view'] = Gate::allows('view', Lesson::fromArray($lesson));

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
        $lessons = collect($this->lessons->all())
            ->map(function (array $lesson): array {
                $lesson['can_view'] = Gate::allows('view', Lesson::fromArray($lesson));

                return $lesson;
            })
            ->values()
            ->all();

        return view('learn.index', [
            'lessons' => $lessons,
            'activeSlug' => null,
        ]);
    }

    public function lesson(Lesson $lesson)
    {
        $nextLesson = $lesson->next_slug ? $this->lessons->findBySlug($lesson->next_slug) : null;
        $userId = auth()->id();

        LessonViewed::dispatch($lesson, $userId);

        if ($userId !== null) {
            $this->progress->markCompleted($userId, $lesson->slug);
        }

        return view('learn.show', [
            'lesson' => $lesson->toArray(),
            'lessons' => $this->lessons->all(),
            'activeSlug' => $lesson->slug,
            'nextLesson' => $nextLesson,
            'progressPercent' => $userId !== null ? $this->progress->completionRate($userId) : null,
        ]);
    }

    public function roadmap()
    {
        $roadmap = collect($this->lessons->roadmap())
            ->map(function (array $group): array {
                $group['steps'] = collect($group['steps'])
                    ->map(function (array $step): array {
                        $lesson = $this->lessons->findBySlug($step['slug']);
                        $step['can_view'] = $lesson
                            ? Gate::allows('view', Lesson::fromArray($lesson))
                            : false;

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
            'cheatsheet' => $this->lessons->cheatsheet(),
        ]);
    }

    public function projects()
    {
        return view('projects', [
            'projects' => $this->lessons->projects(),
        ]);
    }
}
