# Docker Learning Platform (Laravel)

This project is a modern educational website built with Laravel + Blade + TailwindCSS to teach Docker concepts in a structured, beginner-friendly way, with a special focus on real Laravel Docker workflows.

---

## Project Overview

The platform is designed around structured lessons and supporting pages:

- Home page introducing the learning journey
- Learn section with topic sidebar and lesson detail pages
- Roadmap page showing beginner to advanced progression
- Cheatsheet page for quick command and environment reference
- Project examples page with practical compose snippets

All content is served from an internal structured repository (`LessonRepository`) so lessons are easy to maintain and expand.

---

## Tech Stack

- Laravel 13
- Blade templates
- TailwindCSS (via Vite when available, CDN fallback if build assets are missing)
- PHP 8.3+

> Docker infrastructure files are left untouched by this feature implementation.

---

## Routes and Pages

| Route | Purpose |
|---|---|
| `/` | Home page with hero, Docker intro, path preview, benefits, CTA |
| `/learn` | Main lessons index with sticky sidebar and topic cards |
| `/learn/{slug}` | Full lesson template page |
| `/roadmap` | Structured learning path with UI-only completion toggles |
| `/cheatsheet` | Quick commands, ENV variables, and compose patterns |
| `/projects` | Real-world Docker setup cards and snippets |

Routes are defined in `routes/web.php` and handled by `LearningController`.

---

## Core Architecture

### 1) Controller Layer

`app/Http/Controllers/LearningController.php`

Responsible for rendering all educational pages:

- `home()`
- `learnIndex()`
- `lesson($slug)`
- `roadmap()`
- `cheatsheet()`
- `projects()`

### 2) Content Source Layer

`app/Support/LessonRepository.php`

Centralized static data source for:

- lesson list
- lesson detail content
- roadmap groups and steps
- cheatsheet items
- project examples

This avoids overcomplicated backend/database setup while still providing a clean internal content model.

### 3) View Layer

`resources/views/layouts/app.blade.php` provides:

- global navbar
- dark mode toggle
- copy-to-clipboard behavior for code blocks
- Vite asset loading with fallback

Feature views:

- `home.blade.php`
- `learn/index.blade.php`
- `learn/show.blade.php`
- `roadmap.blade.php`
- `cheatsheet.blade.php`
- `projects.blade.php`

---

## Lesson Data Structure

Each lesson follows a structured template with fields such as:

- `id`
- `title`
- `slug`
- `category`
- `intro`
- `key_concepts`
- `definitions`
- `highlights`
- `comparison` (headers + rows)
- `commands`
- `internal_steps`
- `laravel_connection`
- `common_mistakes`
- `summary`
- `next_slug`

This structure powers consistent rendering across all lesson pages.

---

## Lesson Page Features (`/learn/{slug}`)

Every lesson includes:

1. Title
2. Introduction box
3. Key concepts + definitions + highlighted keywords
4. Visual comparison section (table format)
5. Code examples with copy button
6. "How it works internally" step-by-step block
7. Laravel connection section
8. Common mistakes section
9. Summary box
10. Next lesson button (when available)

---

## Frontend UX Features

- Responsive layout with developer-style dark UI
- Sticky left sidebar on learning pages
- Global navigation across all sections
- Copy-to-clipboard for command/code snippets
- Dark mode toggle with `localStorage` persistence
- Roadmap completion state saved in `localStorage` (UI-only)

---

## Content Source Note

The original goal references `src/docker.docx` as raw source content.  
In this workspace, that file was not present at implementation time, so structured educational content was authored directly into `LessonRepository`.

If you add `src/docker.docx`, you can:

1. Extract text into structured topic blocks
2. Replace corresponding lesson fields in `LessonRepository`
3. Keep the same routes/views without architectural changes

---

## Setup and Run

From the `src` directory:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

If using Vite assets:

```bash
npm install
npm run build
```

Run app:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Open:

- `http://localhost:8000`

---

## Vite Manifest Fallback

To avoid `ViteManifestNotFoundException` in environments without built assets, the layout checks for:

- `public/build/manifest.json` or
- `public/hot`

If neither exists, it falls back to Tailwind CDN so pages remain available.

---

## How to Add a New Lesson

1. Open `app/Support/LessonRepository.php`
2. Add a new `self::lesson(...)` entry
3. Set `slug` and `next_slug` correctly
4. Optionally include it in `topicPreview()`
5. Add it to `roadmap()` if needed

No route or controller changes are required unless you introduce new page types.

---

## Customization Ideas

- Add search/filter for lessons
- Add markdown-based content files instead of inline arrays
- Add admin CMS later (if content team editing is needed)
- Add lesson progress per user after authentication is introduced
- Add tests for route responses and key view rendering

---

## License

This project is built on Laravel (MIT).  
Application content and custom code follow your repository policy.
