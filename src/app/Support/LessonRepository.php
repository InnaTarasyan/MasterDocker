<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class LessonRepository
{
    public static function advancedLessonSlugs(): array
    {
        $advancedGroup = collect(self::roadmap())->firstWhere('level', 'Advanced');

        return collect($advancedGroup['steps'] ?? [])
            ->pluck('slug')
            ->all();
    }

    public static function isAdvancedLesson(string $slug): bool
    {
        return in_array($slug, self::advancedLessonSlugs(), true);
    }

    public static function all(): array
    {
        return Cache::rememberForever('lessons.all', fn (): array => [
            self::lesson(
                'Introduction',
                'introduction',
                'Docker provides a standard way to package application code, runtime, and dependencies so the same project runs in development, staging, and production.',
                [
                    'Docker uses lightweight isolation based on Linux kernel features.',
                    'An image is a template while a container is a running process.',
                    'Docker CLI communicates with Docker Engine to build and run workloads.',
                    'Compose lets teams define multi-service stacks in a single YAML file.',
                ],
                [
                    ['Docker' => 'Platform to build, ship, and run containerized apps.'],
                    ['Containerization' => 'Packaging software with everything it needs to execute.'],
                    ['Portability' => 'Consistent behavior across local and cloud environments.'],
                ],
                ['Repeatability', 'Isolation', 'Fast onboarding'],
                ['Concept', 'Description'],
                [
                    ['Traditional setup', 'Manual installs and machine-specific differences'],
                    ['Dockerized setup', 'Versioned images and shared compose definitions'],
                ],
                ['docker --version', 'docker info', 'docker ps -a'],
                [
                    'You run a command through Docker CLI.',
                    'Docker Engine validates and resolves required image layers.',
                    'A container process starts with isolated network and filesystem namespaces.',
                ],
                [
                    'Laravel teams avoid machine drift by sharing one `docker-compose.yml`.',
                    'New developers can boot a full Laravel stack in minutes.',
                ],
                [
                    'Skipping `.env` alignment with compose service names.',
                    'Assuming local PHP extensions match production.',
                ],
                'Docker gives Laravel projects a predictable, reproducible runtime from first commit to deployment.',
                'docker-basics'
            ),
            self::lesson(
                'Docker Basics',
                'docker-basics',
                'Docker basics focus on building images, creating containers, and exposing services to your host machine.',
                [
                    'Images are immutable and built in layers.',
                    'Containers are ephemeral by default.',
                    'Port mappings expose container ports to your machine.',
                    'Volumes persist data beyond container lifecycle.',
                ],
                [
                    ['Image' => 'Read-only blueprint created from Dockerfile instructions.'],
                    ['Container' => 'Running instance of an image with writable layer.'],
                    ['Volume' => 'Persistent data storage managed by Docker.'],
                ],
                ['Layers', 'Ports', 'Persistence'],
                ['Without Docker', 'With Docker'],
                [
                    ['Install PHP/MySQL manually', 'Run `docker compose up` once'],
                    ['Different local versions', 'Pinned image tags and same runtime'],
                    ['Hard to reset state', 'Recreate clean containers quickly'],
                ],
                ['docker pull nginx:alpine', 'docker run -d -p 8080:80 nginx:alpine', 'docker stop <container_id>'],
                [
                    'CLI sends instruction to Docker daemon.',
                    'Daemon pulls missing layers from registry.',
                    'Container network endpoint and writable layer are attached.',
                    'Process runs as PID 1 in container namespace.',
                ],
                [
                    'Laravel `app` service usually maps `8000:8000` or `80:80` for HTTP access.',
                    'MySQL and Redis stay internal while Laravel reaches them by service name.',
                ],
                [
                    'Forgetting to publish required ports.',
                    'Expecting data persistence without a volume.',
                ],
                'Basics are about lifecycle: pull image, run container, expose ports, and persist the right data.',
                'images-vs-containers'
            ),
            self::lesson(
                'Docker Images vs Containers',
                'images-vs-containers',
                'Understanding this difference is foundational: image is the package, container is the running application process.',
                [
                    'One image can create many containers.',
                    'Image layers are cached during builds.',
                    'Container writable layer disappears after removal.',
                    'State should be externalized to volumes or databases.',
                ],
                [
                    ['Image layer' => 'Incremental filesystem snapshot from each Dockerfile step.'],
                    ['Container runtime' => 'Active execution context with CPU/memory and network.'],
                ],
                ['Immutability', 'Runtime state', 'Reusability'],
                ['Docker Image', 'Docker Container'],
                [
                    ['Blueprint', 'Running instance'],
                    ['Static artifact', 'Dynamic process'],
                    ['Built once', 'Started/stopped many times'],
                    ['Shared across environments', 'Environment-specific runtime state'],
                ],
                ['docker build -t laravel-app:dev .', 'docker run --name app-1 laravel-app:dev', 'docker rm app-1'],
                [
                    'Build pipeline executes Dockerfile instructions into layers.',
                    'Run command creates a container from selected image metadata.',
                    'Container gets runtime configuration: env vars, network, mounts, command.',
                ],
                [
                    'Build one Laravel image, then run separate containers for queue workers and HTTP processes.',
                    'This pattern avoids duplicate dependency installs and keeps deployments consistent.',
                ],
                [
                    'Editing files inside running container and expecting permanence.',
                    'Treating container filesystem as long-term storage.',
                ],
                'Images represent repeatable build output; containers represent temporary execution of that output.',
                'dockerfile'
            ),
            self::lesson(
                'Dockerfile',
                'dockerfile',
                'A Dockerfile is a scripted recipe that creates deterministic image builds for your Laravel application.',
                [
                    'Instruction order affects cache performance.',
                    'Use `.dockerignore` to avoid bloated build context.',
                    'Separate dependency installation from source copy for faster rebuilds.',
                    'Multi-stage builds reduce production image size.',
                ],
                [
                    ['FROM' => 'Sets base image for subsequent layers.'],
                    ['RUN' => 'Executes commands during image build.'],
                    ['COPY' => 'Copies project files into the image filesystem.'],
                ],
                ['Build cache', 'Layer order', 'Image size'],
                ['Step', 'Result'],
                [
                    ['`FROM php:8.3-fpm`', 'Starts from PHP runtime base'],
                    ['`COPY composer.*`', 'Allows dependency cache reuse'],
                    ['`RUN composer install`', 'Installs PHP packages in image'],
                    ['`COPY . .`', 'Adds app source and configs'],
                ],
                ['docker build -t laravel-edu .', 'docker history laravel-edu', 'docker image ls'],
                [
                    'Docker parses Dockerfile top to bottom.',
                    'Each command creates a new image layer and digest.',
                    'Layer cache is reused when instruction inputs are unchanged.',
                    'Final image manifest references all built layers.',
                ],
                [
                    'A Laravel Dockerfile commonly installs Composer deps and required PHP extensions.',
                    'Keeping `composer.lock` stable improves repeatable builds in CI/CD.',
                ],
                [
                    'Copying full source before running `composer install`.',
                    'Building production images with debug tools enabled.',
                ],
                'A good Dockerfile makes Laravel builds predictable, fast to rebuild, and optimized for deployment.',
                'docker-engine'
            ),
            self::lesson(
                'Docker Engine',
                'docker-engine',
                'Docker Engine is the daemon that builds images, manages containers, and coordinates local Docker resources.',
                [
                    'Engine exposes an API used by Docker CLI.',
                    'Container runtime leverages `containerd` and `runc` under the hood.',
                    'Images, networks, and volumes are managed as separate resources.',
                ],
                [
                    ['Daemon' => 'Background service that handles Docker lifecycle operations.'],
                    ['Client API' => 'Request interface used by CLI and external tools.'],
                ],
                ['Daemon/API', 'Resource management'],
                ['Request', 'Engine action'],
                [
                    ['`docker run`', 'Creates container + network attachments + starts process'],
                    ['`docker build`', 'Executes build graph and stores image layers'],
                    ['`docker volume create`', 'Creates persistent storage object'],
                ],
                ['docker info', 'docker system df', 'docker events'],
                [
                    'CLI command is translated into API call.',
                    'Engine validates config and host capabilities.',
                    'Engine delegates runtime execution and returns container ID/status.',
                ],
                [
                    'Laravel dev stacks rely on Engine network DNS to resolve service names like `mysql`.',
                    'If Engine is unhealthy, all Laravel container operations fail regardless of app code.',
                ],
                [
                    'Confusing Docker Desktop UI state with actual daemon state.',
                    'Ignoring daemon disk usage growth from old images/volumes.',
                ],
                'Docker Engine is the control plane that turns CLI commands into running Laravel infrastructure.',
                'docker-hub-registry'
            ),
            self::lesson(
                'Docker Hub & Registry',
                'docker-hub-registry',
                'Registries store and distribute versioned images so teams can share trusted Laravel runtime artifacts.',
                [
                    'Docker Hub is the default public registry.',
                    'Private registries are common for internal production images.',
                    'Image tags should map to releases, not random mutable names.',
                ],
                [
                    ['Registry' => 'Service that stores and serves container image manifests/layers.'],
                    ['Tag' => 'Human-readable reference to an image version.'],
                ],
                ['Versioning', 'Security', 'Distribution'],
                ['Public Hub', 'Private Registry'],
                [
                    ['Easy sharing', 'Controlled access'],
                    ['Open community images', 'Internal company images'],
                    ['Rate limits possible', 'Custom retention and policies'],
                ],
                ['docker login', 'docker tag laravel-edu my-registry/laravel-edu:v1.0.0', 'docker push my-registry/laravel-edu:v1.0.0'],
                [
                    'Build output creates image manifest and layers.',
                    'Push uploads missing layers and registers manifest.',
                    'Pull retrieves manifest, then downloads required layers only.',
                ],
                [
                    'CI can build Laravel image once and deploy same digest to all environments.',
                    'This eliminates "works on staging but not production" drift.',
                ],
                [
                    'Using `latest` tag as sole deployment reference.',
                    'Pulling untrusted images without vulnerability scanning.',
                ],
                'Registries make Laravel Docker workflows shareable, repeatable, and deployment-friendly.',
                'docker-compose'
            ),
            self::lesson(
                'Docker Compose',
                'docker-compose',
                'Compose defines multi-container applications so Laravel, MySQL, Redis, and Nginx boot together as one stack.',
                [
                    'Services, networks, and volumes are declared in one YAML file.',
                    'Compose automatically creates service DNS names.',
                    'Environment variables can be shared via `.env` and `environment` keys.',
                ],
                [
                    ['Service' => 'Named container definition in compose file.'],
                    ['Depends_on' => 'Startup ordering hint between services.'],
                    ['Network' => 'Virtual network enabling service-to-service communication.'],
                ],
                ['Orchestration', 'Service DNS', 'Reusable configs'],
                ['Single container flow', 'Compose services flow'],
                [
                    ['Run each container manually', 'Describe full stack once in YAML'],
                    ['Manual links and env wiring', 'Automatic network + service names'],
                    ['Hard to replicate for team', 'One command for everyone'],
                ],
                ['docker compose up -d', 'docker compose ps', 'docker compose logs -f app'],
                [
                    'Compose parses YAML and resolves service dependency graph.',
                    'Network and volume resources are created first.',
                    'Each service container starts with declared env vars and mounts.',
                    'Service discovery is enabled through internal DNS.',
                ],
                [
                    'Laravel should use `DB_HOST=mysql`, not `127.0.0.1`, when MySQL is another service.',
                    'Queue workers, scheduler, and web can all run from the same image with different commands.',
                ],
                [
                    'Using host loopback addresses for inter-service communication.',
                    'Not recreating containers after changing Dockerfile or env-sensitive config.',
                ],
                'Compose turns Laravel infrastructure setup into a repeatable, team-friendly command.',
                'volumes'
            ),
            self::lesson(
                'Volumes',
                'volumes',
                'Volumes preserve data and improve development workflows by separating persistent state from ephemeral containers.',
                [
                    'Named volumes survive container deletion.',
                    'Bind mounts mirror host files for live code edits.',
                    'Database data should always live in a volume for local reliability.',
                ],
                [
                    ['Named volume' => 'Docker-managed storage attached by logical name.'],
                    ['Bind mount' => 'Direct mount from host path into container path.'],
                ],
                ['Persistence', 'Local development speed'],
                ['No volume', 'Volume attached'],
                [
                    ['Container removal loses DB data', 'DB data remains across restarts'],
                    ['Hard reset every rebuild', 'Reusable persistent project state'],
                ],
                ['docker volume ls', 'docker volume inspect laravel_mysql_data', 'docker compose down -v'],
                [
                    'Volume driver creates storage path on Docker host.',
                    'Container mount points are attached before process start.',
                    'Application writes to mount path and data persists independently.',
                ],
                [
                    'Laravel code is often bind-mounted for fast local iteration.',
                    'MySQL data directory should use named volume to avoid accidental loss.',
                ],
                [
                    'Deleting volumes blindly during troubleshooting.',
                    'Using bind mounts for heavy database files on slow host disks.',
                ],
                'Use volumes intentionally: bind mounts for source code, named volumes for durable Laravel service data.',
                'networking'
            ),
            self::lesson(
                'Networking',
                'networking',
                'Docker networking connects Laravel services safely and predictably using internal DNS and isolated virtual networks.',
                [
                    'Compose creates a default bridge network per project.',
                    'Services resolve each other by service name.',
                    'Only explicitly published ports are reachable from host.',
                ],
                [
                    ['Bridge network' => 'Default local network driver for container communication.'],
                    ['Port publishing' => 'Maps container port to host interface.'],
                    ['Service discovery' => 'Built-in DNS resolves compose service names.'],
                ],
                ['Isolation', 'Service discovery', 'Port mapping'],
                ['Host access', 'Container-to-container access'],
                [
                    ['Uses published host ports', 'Uses internal service names and ports'],
                    ['Example: `localhost:8080`', 'Example: `mysql:3306`'],
                ],
                ['docker network ls', 'docker network inspect <project>_default', 'docker exec -it app ping mysql'],
                [
                    'Compose brings up a project-specific network.',
                    'Containers join network with DNS entries keyed by service names.',
                    'Outbound/inbound rules are applied by Docker bridge driver.',
                ],
                [
                    'Laravel `.env` should point to service DNS names (`mysql`, `redis`).',
                    'Nginx and PHP-FPM services communicate internally without exposing every port to host.',
                ],
                [
                    'Setting `DB_HOST=127.0.0.1` inside containerized Laravel app.',
                    'Exposing unnecessary ports publicly.',
                ],
                'Correct Docker networking removes connectivity guesswork and keeps Laravel service communication reliable.',
                null
            ),
        ]);
    }

    public static function topicPreview(): array
    {
        return collect(self::all())
            ->whereIn('slug', [
                'docker-basics',
                'images-vs-containers',
                'dockerfile',
                'docker-engine',
                'docker-hub-registry',
                'docker-compose',
                'volumes',
                'networking',
            ])
            ->values()
            ->all();
    }

    public static function findBySlug(string $slug): ?array
    {
        foreach (self::all() as $lesson) {
            if ($lesson['slug'] === $slug) {
                return $lesson;
            }
        }

        return null;
    }

    public static function roadmap(): array
    {
        return Cache::rememberForever('lessons.roadmap', fn (): array => [
            [
                'level' => 'Beginner',
                'steps' => [
                    ['title' => 'What is Docker', 'description' => 'Understand the container model and why it matters.', 'slug' => 'introduction'],
                    ['title' => 'Images vs Containers', 'description' => 'Learn build artifacts vs runtime instances.', 'slug' => 'images-vs-containers'],
                ],
            ],
            [
                'level' => 'Intermediate',
                'steps' => [
                    ['title' => 'Dockerfile', 'description' => 'Create reproducible Laravel image builds.', 'slug' => 'dockerfile'],
                    ['title' => 'Docker Compose', 'description' => 'Run Laravel, DB, cache, and queue together.', 'slug' => 'docker-compose'],
                    ['title' => 'Laravel Docker setup', 'description' => 'Wire env values and service communication correctly.', 'slug' => 'docker-engine'],
                ],
            ],
            [
                'level' => 'Advanced',
                'steps' => [
                    ['title' => 'Volumes', 'description' => 'Protect persistent data and optimize dev loop.', 'slug' => 'volumes'],
                    ['title' => 'Networking', 'description' => 'Use secure service-to-service communication.', 'slug' => 'networking'],
                    ['title' => 'Production deployment', 'description' => 'Push tagged images and deploy consistently.', 'slug' => 'docker-hub-registry'],
                ],
            ],
        ]);
    }

    public static function cheatsheet(): array
    {
        return Cache::rememberForever('lessons.cheatsheet', fn (): array => [
            'docker_commands' => [
                'docker --version',
                'docker info',
                'docker context ls',
                'docker login',
                'docker logout',
                'docker pull nginx:alpine',
                'docker build -t app:dev .',
                'docker image ls',
                'docker image inspect app:dev',
                'docker history app:dev',
                'docker tag app:dev my-registry/app:v1.0.0',
                'docker push my-registry/app:v1.0.0',
                'docker run --rm hello-world',
                'docker run -d --name web -p 8080:80 nginx:alpine',
                'docker run -it --rm alpine:3.20 sh',
                'docker ps',
                'docker ps -a',
                'docker logs -f web',
                'docker exec -it web sh',
                'docker inspect web',
                'docker stop web',
                'docker start web',
                'docker restart web',
                'docker rm web',
                'docker container prune',
                'docker image prune -a',
                'docker network ls',
                'docker network inspect bridge',
                'docker volume ls',
                'docker volume inspect my_volume',
                'docker system df',
                'docker system prune',
                'docker compose up -d',
                'docker compose up --build -d',
                'docker compose ps',
                'docker compose logs -f app',
                'docker compose exec app php artisan migrate',
                'docker compose exec app php artisan queue:work',
                'docker compose run --rm app php artisan test',
                'docker compose config',
                'docker compose pull',
                'docker compose stop',
                'docker compose restart app',
                'docker compose down',
                'docker compose down -v',
            ],
            'laravel_env' => [
                'APP_NAME=Laravel',
                'APP_ENV=local',
                'APP_DEBUG=true',
                'APP_URL=http://localhost:8082',
                'APP_PORT=8082',
                'WWWUSER=1000',
                'WWWGROUP=1000',
                'LOG_CHANNEL=stack',
                'LOG_LEVEL=debug',
                'BROADCAST_CONNECTION=log',
                'CACHE_STORE=redis',
                'FILESYSTEM_DISK=local',
                'SESSION_DRIVER=redis',
                'SESSION_LIFETIME=120',
                'QUEUE_CONNECTION=redis',
                'REDIS_CLIENT=phpredis',
                'REDIS_HOST=redis',
                'REDIS_PASSWORD=null',
                'REDIS_PORT=6379',
                'REDIS_DB=0',
                'REDIS_CACHE_DB=1',
                'DB_HOST=mysql',
                'DB_PORT=3306',
                'DB_DATABASE=laravel',
                'DB_USERNAME=laravel',
                'DB_PASSWORD=secret',
                'DB_CONNECTION=mysql',
                'MAIL_MAILER=smtp',
                'MAIL_HOST=mailpit',
                'MAIL_PORT=1025',
                'MAIL_USERNAME=null',
                'MAIL_PASSWORD=null',
                'MAIL_ENCRYPTION=null',
                'VITE_APP_NAME="${APP_NAME}"',
                'COMPOSE_PROJECT_NAME=laravel_docker_app',
                'DOCKER_DEFAULT_PLATFORM=linux/amd64',
                'XDEBUG_MODE=off',
                'XDEBUG_CONFIG=client_host=host.docker.internal client_port=9003',
                'PUID=1000',
                'PGID=1000',
                'TZ=UTC',
            ],
            'compose_patterns' => [
                'Laravel + MySQL: app, mysql, optional nginx service.',
                'Laravel + Redis queue: app, redis, worker, scheduler services.',
                'Full stack setup: app, nginx, mysql, redis, worker, scheduler.',
                'Use `depends_on` for startup order hints, but add healthchecks for real readiness.',
                'Use one image for app/web/worker/scheduler, override only command per service.',
                'Mount source code in development (`.:/var/www/html`) for live reload.',
                'Use named volumes for stateful services (`mysql_data`, `redis_data`).',
                'Use service DNS names in Laravel env (`DB_HOST=mysql`, `REDIS_HOST=redis`).',
                'Keep internal service ports private; publish only web/debug ports.',
                'Use `docker compose --env-file .env up -d` for explicit environment loading.',
                'Run one-off tasks with `docker compose run --rm app php artisan <command>`.',
                'Use `docker compose config` to validate merged/interpolated compose config.',
                'Split production/dev settings with override files (`compose.override.yaml`).',
                'Avoid hardcoding secrets in compose YAML; inject from env or secret manager.',
            ],
            'references' => [
                [
                    'title' => 'Docker CLI Reference',
                    'url' => 'https://docs.docker.com/reference/cli/docker/',
                ],
                [
                    'title' => 'Docker Compose Command Reference',
                    'url' => 'https://docs.docker.com/reference/cli/docker/compose/',
                ],
                [
                    'title' => 'Docker Compose Environment Variables',
                    'url' => 'https://docs.docker.com/compose/how-tos/environment-variables/set-environment-variables/',
                ],
                [
                    'title' => 'Docker Compose Variable Interpolation',
                    'url' => 'https://docs.docker.com/compose/how-tos/environment-variables/variable-interpolation/',
                ],
                [
                    'title' => 'Docker Compose Environment Variable Precedence',
                    'url' => 'https://docs.docker.com/compose/how-tos/environment-variables/envvars-precedence/',
                ],
                [
                    'title' => 'Laravel Configuration',
                    'url' => 'https://laravel.com/docs/13.x/configuration',
                ],
                [
                    'title' => 'Laravel Redis',
                    'url' => 'https://laravel.com/docs/13.x/redis',
                ],
                [
                    'title' => 'Laravel Queues',
                    'url' => 'https://laravel.com/docs/13.x/queues',
                ],
                [
                    'title' => 'Docker Laravel Development Setup Guide',
                    'url' => 'https://docs.docker.com/guides/frameworks/laravel/development-setup/',
                ],
            ],
        ]);
    }

    public static function projects(): array
    {
        return Cache::rememberForever('lessons.projects', fn (): array => [
            [
                'title' => 'Laravel + MySQL Docker Setup',
                'description' => 'Minimal development stack with PHP app container and MySQL persistence.',
                'snippet' => "services:\n  app:\n    build: .\n    depends_on:\n      - mysql\n  mysql:\n    image: mysql:8.4\n    environment:\n      MYSQL_DATABASE: laravel\n    volumes:\n      - mysql_data:/var/lib/mysql",
            ],
            [
                'title' => 'Laravel + Nginx + PHP-FPM',
                'description' => 'Separated web server and PHP runtime for cleaner production parity.',
                'snippet' => "services:\n  nginx:\n    image: nginx:alpine\n    ports:\n      - \"8080:80\"\n    depends_on:\n      - php\n  php:\n    build: .\n    command: php-fpm",
            ],
            [
                'title' => 'Full Production Stack',
                'description' => 'Application, reverse proxy, database, cache, and worker services.',
                'snippet' => "services:\n  app:\n    image: registry/laravel-app:v1.0.0\n  nginx:\n    image: nginx:alpine\n  mysql:\n    image: mysql:8.4\n  redis:\n    image: redis:7-alpine\n  worker:\n    image: registry/laravel-app:v1.0.0\n    command: php artisan queue:work",
            ],
        ]);
    }

    private static function lesson(
        string $title,
        string $slug,
        string $intro,
        array $keyConcepts,
        array $definitions,
        array $highlights,
        array $comparisonHeaders,
        array $comparisonRows,
        array $commands,
        array $internalSteps,
        array $laravelConnection,
        array $commonMistakes,
        string $summary,
        ?string $nextSlug
    ): array {
        return [
            'id' => $slug,
            'title' => $title,
            'slug' => $slug,
            'category' => 'docker-fundamentals',
            'intro' => $intro,
            'key_concepts' => $keyConcepts,
            'definitions' => $definitions,
            'highlights' => $highlights,
            'comparison' => [
                'headers' => $comparisonHeaders,
                'rows' => $comparisonRows,
            ],
            'commands' => $commands,
            'internal_steps' => $internalSteps,
            'laravel_connection' => $laravelConnection,
            'common_mistakes' => $commonMistakes,
            'summary' => $summary,
            'next_slug' => $nextSlug,
        ];
    }
}
