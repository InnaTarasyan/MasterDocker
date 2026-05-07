# Docker Learning Platform - Complete Technology Guide

This project is an educational web platform built to teach Docker through real Laravel workflows, practical examples, and structured learning paths. It combines modern PHP backend engineering, containerized infrastructure, and fast frontend tooling into a single developer-friendly product.

The goal of this README is to describe all major technologies used in this website in depth, explain why they matter, and provide a practical map for contributors who want to extend the platform.

---

## Vision and Product Direction

The platform is designed as a learning system, not just a static site.  
It focuses on:

- clear topic progression from beginner to advanced;
- reusable lesson architecture;
- practical command snippets for real development;
- smooth local setup using Docker;
- scalable foundation for future user progress tracking and analytics.

It is intentionally built with production-grade technologies even though the current product can run as a content-driven educational app. That decision makes future upgrades much easier (auth, personalization, dashboards, test automation, API expansion, and queue-based background processing).

---

## High-Level Technology Stack

### Core Application Layer

- **PHP 8.3+ compatibility target in app dependencies**
- **Laravel 13** framework
- **Blade** server-side templating
- **Service provider architecture** for clean dependency registration
- **Repository pattern** for content access abstraction
- **Policy-based authorization** for future permission control
- **Events + listeners + jobs** for async analytics workflows

### Frontend and Build Layer

- **Tailwind CSS v4**
- **Vite v8**
- **Laravel Vite Plugin**
- **@tailwindcss/vite integration**
- **Axios** available for client-side requests
- **Concurrently** for multi-process local dev workflows

### Infrastructure and Runtime Layer

- **Docker Compose**
- **PHP-FPM container**
- **Nginx reverse proxy container**
- **MySQL 8 container**
- **Named Docker volume** for persistent database storage

### Quality and DX Tooling

- **PHPUnit 12** for testing
- **Laravel Pint** for code style
- **Laravel Pail** for log tailing
- **Laravel Tinker** for REPL productivity
- **Collision** for readable CLI errors
- **FakerPHP + Mockery** for realistic and maintainable tests

---

## Backend Technologies in Detail

## Laravel 13

Laravel 13 is the backbone of this project. It provides:

- a clean request lifecycle and routing system;
- expressive controllers and middleware;
- dependency injection container;
- event-driven architecture;
- queue processing support;
- policy and authorization primitives;
- ergonomic testing workflow.

For an educational platform, this is powerful because the application can start as a content-first website and evolve into a richer SaaS-like system without re-platforming.

## PHP 8.3 Ecosystem

The Composer configuration targets modern PHP (`^8.3`) and the Docker image runs PHP-FPM 8.4, giving access to modern language improvements and runtime performance.  
This keeps the project future-ready while staying compatible with current Laravel ecosystem standards.

## Service Container and Contract-Driven Design

The project structure includes:

- `LessonRepositoryInterface`
- service provider wiring in `LearningServiceProvider`
- concrete implementations such as `CachedLessonRepository`

This is a strong architectural choice because it enables:

- easy testing through mocks/fakes;
- drop-in implementation swaps;
- cache integration without changing controller logic;
- separation between business intent and implementation details.

## Repository Pattern for Lesson Domain

Lessons are represented as domain-level content objects and served through repository abstractions.  
Even when data starts as in-memory/static structures, this pattern prepares the app for future backends:

- relational DB storage;
- headless CMS adapters;
- Markdown/JSON content pipelines;
- external APIs.

## Event-Driven Analytics Pipeline

The codebase includes dedicated components for analytics:

- `LessonViewed` event
- `QueueLessonViewAnalytics` listener
- `RecordLessonViewAnalytics` job

This pattern is excellent for scale and reliability:

- user-facing requests stay fast;
- analytics is processed asynchronously;
- heavy writes and external calls can be retried safely;
- future telemetry expansion is straightforward.

## Authorization with Policies

`LessonPolicy` exists to enforce access decisions close to the domain model.  
Even if policy rules are minimal now, introducing policy architecture early is a best practice because it prevents auth logic from leaking into controllers/views.

## Learning Progress Service Layer

`LearningProgressService` suggests business logic extraction beyond controllers.  
This supports cleaner code boundaries:

- controllers orchestrate;
- services encapsulate logic;
- repositories provide data;
- events/jobs handle side effects.

---

## Frontend Technologies in Detail

## Blade Templating Engine

Blade is used for server-rendered page composition and reusable layout primitives.  
Why it fits this platform:

- highly SEO-friendly rendered HTML;
- minimal frontend complexity for content-heavy pages;
- direct integration with Laravel routing and localization capabilities;
- simple componentization when UI grows.

## Tailwind CSS v4

Tailwind v4 enables fast utility-based styling with a consistent design language.  
For educational UI screens (roadmaps, sidebars, code blocks, highlight cards), utility classes accelerate development and keep styling predictable.

Key benefits in this project:

- responsive layouts for content pages;
- quick dark-theme consistency;
- maintainable UI tokens through utility conventions;
- reduced custom CSS overhead.

## Vite 8 + Laravel Vite Plugin

Vite powers both development and production builds:

- near-instant hot reload during local development;
- optimized production bundles;
- modern module graph performance.

Laravel Vite Plugin ensures smooth framework integration for asset loading and cache-busted output.

## @tailwindcss/vite Integration

The build pipeline uses the official Tailwind + Vite bridge, which simplifies styling integration and keeps compatibility with latest Tailwind architecture.

## Axios

Axios is available in dev dependencies for HTTP interactions.  
Even if current pages are mostly server-rendered, Axios unlocks:

- progressive enhancement;
- async UI widgets;
- analytics/telemetry pings;
- future SPA-like islands.

## Browser UX Enhancements

The platform includes practical UX touches:

- dark mode toggle with local persistence;
- copy-to-clipboard actions for code/commands;
- sticky learning navigation behavior;
- responsive educational page structure.

These features improve real learning usability, especially for command-heavy technical content.

---

## Infrastructure and DevOps Technologies

## Docker Compose Orchestration

`docker-compose.yml` defines a multi-container environment that mirrors realistic web deployment topology:

- `app`: custom PHP-FPM runtime
- `nginx`: web server + reverse proxy
- `mysql`: relational data storage

This setup gives contributors a consistent, reproducible local environment regardless of host machine setup.

## Custom PHP-FPM Image

The custom Dockerfile:

- starts from `php:8.4-fpm`;
- installs required system libraries;
- installs common PHP extensions (`pdo_mysql`, `mbstring`, `bcmath`, `gd`, etc.);
- copies Composer from official Composer image.

This balances flexibility and reproducibility: you control runtime dependencies while keeping image setup transparent.

## Nginx as HTTP Edge

Nginx handles incoming HTTP traffic and forwards PHP requests to PHP-FPM.  
This mirrors a standard production architecture and improves confidence that local behavior matches deployment expectations.

## MySQL 8 Data Layer

MySQL 8 runs in a dedicated container with explicit environment variables and persistent named volume.  
This provides:

- modern SQL features;
- reliable local persistence;
- easy container lifecycle resets without data loss (if volume retained).

## Container Networking + Volume Persistence

By composing services in one network and persisting MySQL data in a named volume, the environment supports fast iteration for both backend and database work.

---

## Testing, Quality, and Developer Experience

## PHPUnit 12

Modern PHPUnit enables comprehensive test coverage across:

- HTTP routes/controllers;
- service logic;
- repository behavior;
- authorization policies;
- job and event dispatching.

## Laravel Pint

Pint enforces consistent style and formatting, reducing review friction and making diffs cleaner.

## Mockery + FakerPHP

These tools support robust automated testing:

- Mockery for dependency behavior isolation;
- Faker for realistic fixture generation.

## Collision and Pail

- **Collision** makes CLI errors readable and actionable.
- **Pail** improves log observability during active development.

Combined with concurrent process scripts, this creates a smooth local feedback loop.

## Tinker

Tinker provides a REPL environment to quickly test Eloquent models, services, and framework behavior interactively.

---

## Application Architecture Patterns Used

This project applies several strong software engineering patterns:

- **MVC** through controllers and Blade views;
- **Repository pattern** for data access abstraction;
- **Dependency inversion** via interfaces and service container bindings;
- **Event-driven design** for decoupled analytics workflows;
- **Job queue pattern** for background processing;
- **Policy-based authorization** for controlled resource access;
- **Layered responsibilities** (controllers/services/repositories/listeners/jobs).

This combination keeps the codebase maintainable as features grow.

---

## Routing and Content Experience

Main routes include:

- `/` - platform introduction and onboarding context
- `/learn` - index of all lessons
- `/learn/{slug}` - lesson details by slug
- `/roadmap` - progression tracking page
- `/cheatsheet` - practical command references
- `/projects` - real-world examples and snippets

These pages form a complete educational path: discover -> learn -> reference -> practice.

---

## Build and Runtime Workflows

From `src` you can use:

- `composer setup` for one-command environment bootstrap (install deps, env creation, key generation, migration, frontend deps, build)
- `composer dev` for parallel local processes (server, queue listener, logs, Vite)
- `composer test` for test runs
- `npm run dev` for frontend hot reload
- `npm run build` for production assets

This workflow design reduces onboarding friction and improves contributor productivity.

---

## Why This Stack Is "Cool" for This Site

This stack is especially strong for an educational technology product because it combines:

1. **Developer speed** (Laravel, Blade, Tailwind, Vite)
2. **Infrastructure realism** (Nginx + PHP-FPM + MySQL in Docker)
3. **Architecture readiness** (contracts, providers, services, policies, events, jobs)
4. **Scalability path** (queues, analytics, cache-ready repository layer)
5. **Long-term maintainability** (testing tools, formatting tools, explicit boundaries)

In other words, the project is not a toy tutorial app; it is a practical foundation that can grow into a serious learning platform.

---

## Future Technology Expansion Ideas

If you want to grow the platform further, this stack can naturally evolve into:

- Redis-based queue/cache layer;
- Horizon dashboard for queue monitoring;
- user authentication and per-user progress tracking;
- API endpoints for mobile or external clients;
- full-text lesson search;
- content editing panel;
- multilingual lesson localization;
- analytics dashboards for engagement metrics.

Because current architecture already uses interfaces, events, jobs, and service abstractions, these additions can be introduced incrementally.

---

## Quick Start

From `src`:

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run build
php artisan serve --host=0.0.0.0 --port=8000
```

Docker-based stack can be started from repository root with Compose when desired.

---

## Multilingual Technology Hashtags

### English Hashtags

#Laravel #PHP #PHP8 #Laravel13 #Blade #TailwindCSS #TailwindV4 #Vite #Vite8 #Docker #DockerCompose #Nginx #MySQL8 #PHPRuntime #PHPFPM #WebDevelopment #BackendDevelopment #FrontendDevelopment #FullStack #DevOps #CloudNative #Containerization #SoftwareArchitecture #RepositoryPattern #DependencyInjection #EventDriven #QueueJobs #AnalyticsPipeline #Authorization #PolicyBasedAccess #Testing #PHPUnit #CodeQuality #DeveloperExperience #OpenSource #EducationPlatform #LearningPlatform #TechStack #ModernWeb #ScalableArchitecture

### Russian Hashtags

#Ларавел #ПХП #ВебРазработка #Бэкенд #Фронтенд #Фуллстек #Докер #ДокерКомпоз #Контейнеры #Нгинкс #МайСКЛ #СовременнаяРазработка #АрхитектураПО #ПаттерныПроектирования #Репозиторий #ВнедрениеЗависимостей #СобытийнаяАрхитектура #ОчередиЗадач #Аналитика #Авторизация #Тестирование #ПХПЮнит #КачествоКода #ДевОпс #ОбразовательнаяПлатформа #Технологии #Программирование #РазработкаСайтов #ИнженерияПО #Масштабируемость

### Armenian Hashtags

#Լարավել #ՓՀՓ #ՎեբՄշակում #Բեքենդ #Ֆրոնտենդ #ՖուլՍթեք #Դոքեր #Կոնտեյներներ #ԷնջինԷքս #ՄայԷսՔյուԷլ #Ծրագրավորում #ԾրագրայինՃարտարապետություն #Տեխնոլոգիաներ #ԿրթականՀարթակ #ՈւսուցմանՀարթակ #ԺամանակակիցՎեբ #ՄշակմանԳործընթաց #ԿոդիՈրակ #Թեստավորում #ԻվենթԱրխիտեկտուրա #ԱշխատանքներիՀերթ #Անալիտիկա #Մասշտաբայնություն #ԾառայություններիԴիզայն #ԴիվՕփս #ԲացԿոդ #ՎեբԾառայություններ #ԼոկալՄշակում #ԴևելոփերՓորձ

---

## License

Framework foundation follows Laravel MIT licensing.  
Project-specific content and custom logic follow your repository policy.
