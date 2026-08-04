# 🚀 Practical Repository - Laravel 12 Fundamentals Course

Welcome to the official practical repository for the **Laravel 12: From Zero to Mastery** course. This repository serves as a comprehensive hands-on guide through the Laravel ecosystem, showcasing modern development practices, clean architecture, and industry-standard RESTful API design.

---

## 📌 Course & Repository Information

- **YouTube Course Link:** [Laravel 12 Full Course Playlist](https://youtube.com/playlist?list=PL6XRLlEsQ_7Xy0fwWHhmo5H_RCI1RbtqG&si=wBotL1ana2yCa3yT)
- **GitHub Repository URL:** `https://github.com/AneesAhshawafi/Apply_Laravel_Course.git`

---

## 🏗️ Repository Architecture & Sub-Projects

The repository is structured into **3 interconnected sub-projects** designed for step-by-step practical learning:

```
Apply_Laravel_Course/
├── Courses_Management_System/  # Main integrated project (Courses, Students, Enrollments, APIs, Sessions, Events & Notifications)
├── ApplyAuthentication/        # Dedicated project for authentication mechanisms (Breeze / Custom Auth / Guards / Sanctum)
└── StudyLaravel/               # Foundational sandbox for routing, controllers, models, and early experimentation
```

### 1. `Courses_Management_System` (Main Application)
A feature-rich course and student management system featuring:
- Management of Countries (`Country`), Courses (`Course`), Training Courses (`TrainCourse`), and Students (`Student`).
- Many-to-Many pivot model for course enrollments (`TrnCrsEnrolment`).
- Sanctum-secured RESTful APIs formatted via `CourseResource` and a custom standardized `ApiResponse` helper.
- Image uploads, dynamic AJAX search, and server-side pagination.
- Event-driven architecture (`Events`), background notifications (`Notifications`), and transactional emails (`Mailables`).

### 2. `ApplyAuthentication`
A specialized application focused on application security and authentication workflows:
- Traditional session-based authentication and customized guards.
- Core authentication controllers (`LoginController`, `RegisterController`, `ForgotPasswordController`, `ResetPasswordController`, `VerificationController`, `ConfirmPasswordController`).

### 3. `StudyLaravel`
The foundational sandbox environment for learning core framework building blocks:
- Routing experiments and regex parameter constraints (`whereNumber`, `whereAlpha`).
- Initial Resource Controllers and pagination setups.
- Concept documentation files such as `chats/Understanding Route Naming.md`.

---

## 🛠️ How to Install and Run

Follow these steps to set up and run the project locally:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/AneesAhshawafi/Apply_Laravel_Course.git
   cd Apply_Laravel_Course/Courses_Management_System
   ```

2. **Install Composer Dependencies:**
   ```bash
   composer install
   ```

3. **Configure Environment File:**
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Set Up Database & Run Migrations:**
   Update your database credentials inside `.env` and execute:
   ```bash
   php artisan migrate --seed
   ```

6. **Create Storage Symbolic Link:**
   ```bash
   php artisan storage:link
   ```

7. **Start the Local Development Server:**
   ```bash
   php artisan serve
   ```

---

## 📋 Table of Contents & Concepts Overview

1. [Architecture & Request Lifecycle](#1-architecture--request-lifecycle)
2. [Advanced Routing & Middleware System](#2-advanced-routing--middleware-system)
3. [Controllers, Requests & Responses](#3-controllers-requests--responses)
4. [Database & Eloquent ORM](#4-database--eloquent-orm)
5. [RESTful API & Sanctum Authentication](#5-restful-api--sanctum-authentication)
6. [Service Container, Providers & Facades](#6-service-container-providers--facades)
7. [Event-Driven Architecture, Mail & Notifications](#7-event-driven-architecture-mail--notifications)
8. [Views & Blade Templating](#8-views--blade-templating)
9. [Sessions & Advanced Caching System](#9-sessions--advanced-caching-system)
10. [Console Commands & Artisan Utilities](#10-console-commands--artisan-utilities)
11. [File-by-File Concepts Index](#11-file-by-file-concepts-index)
12. [Artisan Commands Cheat Sheet](#12-artisan-commands-cheat-sheet)

---

## 1. 🏗️ Architecture & Request Lifecycle

- **MVC Architectural Pattern:**
  - **Model:** Handles data logic, Eloquent ORM, database schemas, and relationships.
  - **View:** User interface layer using Blade templates and HTML components.
  - **Controller:** Orchestrates request handling by bridging Models and Views.
- **Laravel 12 Request Lifecycle:**
  - Single entry point at `public/index.php`.
  - Loading `bootstrap/app.php` — the modernized entry point introduced in Laravel 12 replacing the traditional HTTP Kernel for middleware, routing, and exception configuration.
  - Loading registered Service Providers defined in `bootstrap/providers.php`.
  - Passing requests through Middleware pipelines, invoking controller methods, and returning HTTP responses.
- **Service Container & Dependency Injection (IoC Container):**
  - Automatic and manual Dependency Injection via constructors and method signatures.
- **Facades:**
  - Expressive static interfaces accessing underlying container services (`Route`, `DB`, `Storage`, `Cache`, `Mail`, `Auth`, `URL`, `Cookie`, `Notification`).

---

## 2. 🌐 Advanced Routing & Middleware System

- **Routing Paradigms & Naming:**
  - Named routes for non-fragile URL generation (`->name('courses.index')`).
  - Resource Controllers (`Route::resource('courses', CoursesController::class)`) with selective action filters (`only()`, `except()`).
  - Automatic API Resources (`Route::apiResource('courses', CourseController::class)`).
  - Route groups, prefixes, and middleware binding (`Route::prefix()`, `Route::group()`, `Route::middleware()`).
  - Instant and permanent redirects (`Route::redirect`, `Route::permanentRedirect`, `redirect()->away()`).
  - Fallback routes for handling 404 requests (`Route::fallback()`).
- **Signed & Temporary Signed URLs:**
  - Securing sensitive routes (such as `unsubscribe`) using `URL::signedRoute()` and `URL::temporarySignedRoute()`.
  - Validating URL signatures inside controllers via `$request->hasValidSignature()`.
- **Custom Middleware & Rate Limiting:**
  - Custom middleware: `PoliceMan` (request filtering) and `SetLocale` (dynamic session-based language switching).
  - Rate limiting via `RateLimiter::for` using three strategies:
    1. Per-User or IP: `Limit::perMinute(3)->by($request->user()?->id ?: $request->ip())`.
    2. IP-only: `Limit::perMinute(60)`.
    3. Global static rate limiting: `Limit::perMinute(100)->by('global-key')`.
- **Session Blocking & Cache Headers:**
  - Preventing request race conditions using `->block($lockSeconds, $waitSeconds)`.
  - Automated HTTP cache headers via `cache.headers`.

---

## 3. 🎮 Controllers, Requests & Responses

- **Controller Variations:**
  - Web Resource Controllers (`CoursesController`, `StudentController`, `TrainCourseController`).
  - API Resource Controllers (`API\CourseController`, `API\AuthController`).
- **HTTP Request Inspection & Utilities:**
  - Reading and injecting headers (`hasHeader`, `header`, `headers->set`).
  - Compliance with `PSR-7` standards via `Psr\Http\Message\ServerRequestInterface`.
  - Content Negotiation: `getAcceptableContentTypes`, `prefers`, `expectsJson`, `accepts`.
  - Conditional input methods: `filled`, `isNotFilled`, `anyFilled`, `whenFilled`, `missing`, `whenMissing`, `merge`, `mergeIfMissing`.
- **Response Types:**
  - Standard Views, JSON responses, and `redirect()->route()`.
  - File Downloads (`response()->download()`) and Inline File Viewing (`response()->file()`).
  - Chunked Data Streaming (`response()->stream()`) with instant buffer flushing (`ob_flush()`, `flush()`) for large data exports.
  - JSONP callbacks using `withCallback()`.
  - Custom Response Macros defined in `AppServiceProvider` (`Response::macro('caps', ...)`).

---

## 4. 💾 Database & Eloquent ORM

- **Migrations & DDL Alterations:**
  - Table creation, column modification (`change()`), and soft delete columns.
  - Foreign key constraints with cascading deletes (`foreignId('country_id')->constrained()`).
- **Seeders & Factories:**
  - Seeding initial data via `CountrySeeder`, `CoursesSeeder`, `StudentSeeder`, and `TrainCourseSeeder`.
  - Generating test data using Eloquent Factories and `Faker`.
- **Eloquent Models & Relationships:**
  - Mass assignment protection using `$fillable`.
  - One-to-Many relationship (`Country` -> `Student`).
  - Many-to-Many relationship with a pivot model (`TrainCourse` <-> `Student` via `TrnCrsEnrolment`).
- **Soft Deletes Architecture:**
  - Applying the `SoftDeletes` trait to models (`Course`, `Student`, `TrainCourse`).
  - Trashed query methods: `withTrashed()`, `onlyTrashed()`, `restore()`, and `forceDelete()`.
- **Dynamic Queries & Database Transactions:**
  - Server-side pagination via `paginate(10)`.
  - Dynamic multi-criteria AJAX search filtering in `StudentController::search()`.
  - Database Transactions for data integrity: `DB::beginTransaction()`, `DB::commit()`, `DB::rollBack()`.

---

## 5. 🔌 RESTful API & Sanctum Authentication

- **API Standards in Laravel 12:**
  - Stateless JSON API communication configured via `routes/api.php` and `routes/api_v2.php`.
  - Adherence to RESTful API conventions.
- **Standardized API Response Schema:**
  - Custom response helper `App\Helpers\ApiResponse::send($code, $status, $message, $data, $error)`.
  - Standard HTTP status code handling (`200 OK`, `201 Created`, `401 Unauthorized`, `404 Not Found`, `422 Unprocessable Entity`, `500 Internal Server Error`).
- **Data Transformation with API Resources:**
  - Transforming and formatting API attributes using `CourseResource` and `CourseResource::collection($courses)`.
- **API Authentication via Laravel Sanctum:**
  - Token creation via `$user->createToken('userToken')->plainTextToken`.
  - Token expiration management via `config/sanctum.php`.
  - Revoking tokens on logout via `$request->user()->currentAccessToken()->delete()`.
  - Endpoint protection using the `middleware('auth:sanctum')`.

---

## 6. 🏛️ Service Container, Providers & Facades

- **Dependency Injection:**
  - Injecting `HelperService` directly into `WelcomeController` via constructor injection.
- **Custom Service Providers:**
  - `MyServiceProvider` illustrating the architectural differences between `singleton` and `bind` bindings.
  - Performance optimization via `DeferrableProvider` and `provides()` for lazy-loading services.
- **Custom Facades:**
  - Custom `App\Facades\Helper` extending `Facade`.
  - Overriding `getFacadeAccessor()` using `#[Override]` to bind to `HelperService`.

---

## 7. 📡 Event-Driven Architecture, Mail & Notifications

- **Events & Listeners:**
  - Events: `AddCourse`, `MakeOrderCart`, `CancelOrderCart`.
  - Listeners: `ListenerOnAddCourse`, `SendEmailOnMakeOrder`, `SendEmailOnCancelOrder`.
  - Programmatic binding and automatic Event Discovery.
- **Mailables:**
  - `WelcomeMail` class supporting single and multi-recipient emails via `Mail::to()->send()`.
- **Multi-Channel Notifications:**
  - `CreateStudent` notification triggered upon student creation, delivering alerts via Database and Mail channels (`Notification::send($users, ...)`).

---

## 8. 🎨 Views & Blade Templating

- **Blade Fundamentals:**
  - Conditionals, loops, and raw output directives (`@if`, `@else`, `@foreach`, `@forelse`).
  - Template inheritance (`@extends`, `@section`, `@yield`, `@include`).
- **Blade Components:**
  - Class-based component `App\View\Components\Alert` rendered via `<x-alert alertType="..." message="..." />`.
- **Forms, Validation & Session Flash:**
  - CSRF protection via `@csrf`.
  - Input retention using `old('field')` and error rendering via `@error`.
  - Session flash messages (`with('success', ...)`).

---

## 9. 🧠 Sessions & Advanced Caching System

- **Session Management:**
  - Storage & Retrieval: `session()->put()`, `get()`, `all()`, `only()`, `except()`.
  - Inspection & Manipulations: `has`, `exists`, `missing`, `push`, `pull`, `increment`, `decrement`.
  - Flash Data persistence: `flash()`, `reflash()`, `keep(['username'])`.
  - Session Security: `session()->regenerate()`, `session()->invalidate()`.
- **Advanced Caching:**
  - Core Operations: `Cache::put()`, `get()`, `has()`, `pull()`, `add()`, `forever()`, `forget()`, `flush()`.
  - Atomic Operations & Patterns: `Cache::remember()`, `rememberForever()`, and `Cache::flexible()` for stale-while-revalidate strategy.
  - In-Memory Memoization: `Cache::memo()`.
  - Concurrency & Locks: `Cache::lock()`, `withoutOverlapping()`, and `funnel()`.

---

## 10. ⚡ Console Commands & Artisan Utilities

- **Custom Artisan Commands:**
  - Console command `CreateCourse` defined with signature: `php artisan course:create{coursename}` to generate courses from the CLI and execute quiet calls (`callSilent`).
- **Tinker REPL:**
  - Interactive debugging and model testing via `php artisan tinker`.

---

## 11. 📁 File-by-File Concepts Index

### 🔹 `Courses_Management_System/` Project

#### **Controllers (`app/Http/Controllers/`)**
- 📄 `API/AuthController.php`: API authentication, Sanctum token creation (`createToken`), login/logout, and standardized `ApiResponse` output.
- 📄 `API/CourseController.php`: API CRUD operations for courses, `CourseResource` transformations, pagination, and soft delete restoration.
- 📄 `StudentController.php`: Student CRUD, image uploads (`move`, `public_path`), bulk notifications (`Notification::send`), AJAX search, and temporary signed URLs.
- 📄 `CoursesController.php`: Web course management, database transactions (`DB::beginTransaction`), transactional mail (`WelcomeMail`), and event dispatching (`event(new AddCourse)`).
- 📄 `TrainCourseController.php`: Training course management, pivot model interactions (`TrnCrsEnrolment`), and enrollment actions.
- 📄 `WelcomeController.php`: Dependency Injection, custom Facade invocations (`Helper`), and route inspection (`Route::currentRouteName`).
- 📄 `LoginController.php`: API signup/login logic generating Sanctum tokens.

#### **Requests (`app/Http/Requests/`)**
- 📄 `API/LoginRequest.php` & `RegisterRequest.php`: Form request validation for API authentication.
- 📄 `StudentRequest.php`, `CoursesRequest.php`, `TrainCourseRequest.php`, `TrnCrsRequest.php`: Dedicated validation classes for domain models with custom messages.

#### **Services, Facades & Providers (`Services/`, `Facades/`, `Providers/`)**
- 📄 `Services/HelperService.php`: Core helper service logic.
- 📄 `Facades/Helper.php`: Custom Facade binding to `HelperService`.
- 📄 `Providers/MyServiceProvider.php`: Service Provider implementing `DeferrableProvider`, detailing `singleton` vs `bind`.
- 📄 `Providers/AppServiceProvider.php`: Global rate limiter definitions (`RateLimiter`), Response Macros (`Response::macro('caps')`), and event listeners.

#### **Events, Listeners, Mail & Notifications (`Events/`, `Listeners/`, `Mail/`, `Notifications/`)**
- 📄 `Events/AddCourse.php`, `MakeOrderCart.php`, `CancelOrderCart.php`: Domain events.
- 📄 `Listeners/ListenerOnAddCourse.php`, `SendEmailOnMakeOrder.php`, `SendEmailOnCancelOrder.php`: Event listeners.
- 📄 `Mail/WelcomeMail.php`: Mailable class for sending email alerts.
- 📄 `Notifications/CreateStudent.php`: Multi-channel notification for new student registrations.

#### **Models & Database (`Models/`, `database/`)**
- 📄 `Models/Student.php`, `Course.php`, `TrainCourse.php`, `Country.php`, `TrnCrsEnrolment.php`: Eloquent models with `SoftDeletes` and relationship definitions.
- 📄 `database/migrations/`: 16 migration files covering core tables, foreign key constraints, soft deletes, notifications, and Sanctum token tables.
- 📄 `database/seeders/` & `factories/`: Database seeders and factories for testing data generation.

#### **Routes (`routes/`)**
- 📄 `routes/web.php`: Comprehensive route notebook (600+ lines) covering sessions, caching, streaming, downloads, signed URLs, and request inspection.
- 📄 `routes/api.php` & `routes/api_v2.php`: Sanctum-protected API routes and API versioning (`v2`).

---

### 🔹 `ApplyAuthentication/` Project
- Focused on standard authentication scaffolding:
  - 📄 `Auth/LoginController.php`, `RegisterController.php`, `ForgotPasswordController.php`, `ResetPasswordController.php`, `VerificationController.php`, `ConfirmPasswordController.php`.

---

### 🔹 `StudyLaravel/` Project
- Foundational sandbox project:
  - 📄 `routes/web.php`: Initial route constraint experiments (`whereNumber`, `whereAlpha`).
  - 📄 `app/Http/Controllers/CountryController.php` & `ResFlightController.php`: Early Resource Controllers and pagination.
  - 📄 `chats/Understanding Route Naming.md`: Documentation notes explaining route naming patterns.

---

## 12. 🛠️ Artisan Commands Cheat Sheet

```bash
# Start local development server
php artisan serve

# Create Controllers, Models, and Migrations
php artisan make:controller CoursesController --resource
php artisan make:model Course -mfs # Model + Migration + Factory + Seeder

# Database Migrations & Seeding
php artisan migrate
php artisan migrate:rollback
php artisan db:seed

# Inspect Routes & Link Storage
php artisan route:list
php artisan storage:link

# Make Requests, Components, Resources & API Setup
php artisan make:component Alert
php artisan make:request StoreCourseRequest
php artisan make:resource CourseResource
php artisan install:api

# Events, Notifications & Queues
php artisan make:event AddCourse
php artisan make:listener ListenerOnAddCourse
php artisan queue:work
php artisan schedule:run

# Run Custom Console Command
php artisan course:create "Laravel 12 Course"
```

---

**👨‍💻 Developed and documented based on the comprehensive Laravel 12 Fundamentals Course.**
