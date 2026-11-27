# Graph Report - security-schedule  (2026-11-26)

## Corpus Check
- 52 files · ~17,054 words
- Verdict: corpus is large enough that graph structure adds value.
- Unclassified: 22 file(s) not represented in the graph (top: (none) 18, .example 1, .xml 1)

## Summary
- 290 nodes · 346 edges · 32 communities (18 shown, 14 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `6b0aea08`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- Illuminate\Database\Schema\Blueprint
- Illuminate\Http\Request
- User
- package.json
- Mobile UI/UX review: admin and public schedule
- UserFactory.php
- Product
- Usulan Tech Stack — Security Schedule MVP
- config
- AppServiceProvider
- Architecture: Jadwal Security
- Product Requirements: Jadwal Security
- TestCase
- Jadwal Security
- Instruksi Agen Proyek
- logging.php
- 2026-11-25T07-49-39Z__resources-views.md
- artisan
- Laravel Application
- console.php
- ExampleTest

## God Nodes (most connected - your core abstractions)
1. `User` - 17 edges
2. `SecurityOfficer` - 15 edges
3. `ScheduleAccessTest` - 14 edges
4. `ScheduleAssignment` - 12 edges
5. `Product` - 11 edges
6. `AdminScheduleController` - 9 edges
7. `scripts` - 9 edges
8. `Mobile UI/UX review: admin and public schedule` - 9 edges
9. `require-dev` - 8 edges
10. `Usulan Tech Stack — Security Schedule MVP` - 8 edges

## Surprising Connections (you probably didn't know these)
- `{closure#1}()` --calls--> `ScheduleAssignment`  [EXTRACTED]
  app/Http/Controllers/AdminScheduleController.php → app/Models/ScheduleAssignment.php
- `ScheduleController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/ScheduleController.php → app/Http/Controllers/Controller.php
- `ScheduleAccessTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/ScheduleAccessTest.php → tests/TestCase.php
- `AdminScheduleController` --inherits--> `ScheduleController`  [EXTRACTED]
  app/Http/Controllers/AdminScheduleController.php → app/Http/Controllers/ScheduleController.php
- `TestingEnvironmentTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/TestingEnvironmentTest.php → tests/TestCase.php

## Import Cycles
- None detected.

## Communities (32 total, 14 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.05
Nodes (40): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+32 more)

### Community 1 - "Illuminate\Database\Schema\Blueprint"
Cohesion: 0.10
Nodes (15): {closure#1}(), {closure#2}(), {closure#3}(), {closure#1}(), {closure#2}(), {closure#1}(), {closure#2}(), {closure#3}() (+7 more)

### Community 2 - "Illuminate\Http\Request"
Cohesion: 0.13
Nodes (11): AdminScheduleController, Controller, ScheduleController, {closure#1}(), {closure#2}(), {closure#3}(), Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions (+3 more)

### Community 3 - "User"
Cohesion: 0.09
Nodes (16): {closure#1}(), ScheduleAssignment, SecurityOfficer, User, Carbon\Carbon, Illuminate\Database\Eloquent\Attributes\Fillable, Illuminate\Database\Eloquent\Attributes\Hidden, Illuminate\Database\Eloquent\Factories\HasFactory (+8 more)

### Community 4 - "package.json"
Cohesion: 0.10
Nodes (20): devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite, optionalDependencies, @laravel/multiplex (+12 more)

### Community 5 - "Mobile UI/UX review: admin and public schedule"
Cohesion: 0.13
Nodes (14): Design health score, Design specificity verdict, Minor observations, Mobile UI/UX review: admin and public schedule, Overall impression, P1 — Admin header exposes too many competing actions before the grid, P1 — “Kosong” hides a destructive outcome, P1 — Public header layout breaks its hierarchy at phone width (+6 more)

### Community 6 - "UserFactory.php"
Cohesion: 0.15
Nodes (8): UserFactory, DatabaseSeeder, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Database\Seeder, Illuminate\Support\Facades\Hash, Illuminate\Support\Str, Pdo\Mysql, static

### Community 7 - "Product"
Cohesion: 0.17
Nodes (11): Accessibility & Inclusion, Capabilities and Constraints, Evidence on Hand, Operating Context, Platform, Positioning, Product, Product Principles (+3 more)

### Community 8 - "Usulan Tech Stack — Security Schedule MVP"
Cohesion: 0.18
Nodes (10): Acceptance criteria implementasi, Alternatif bila tim sudah TypeScript-first, Asumsi yang perlu dikonfirmasi sebelum implementasi, Batas Docker dan data, Batas MVP, Bentuk aplikasi, Data minimum, Keputusan (+2 more)

### Community 9 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 11 - "Architecture: Jadwal Security"
Cohesion: 0.33
Nodes (5): Architecture: Jadwal Security, Bentuk aplikasi, Data, Keamanan dan operasi, Komponen

### Community 12 - "Product Requirements: Jadwal Security"
Cohesion: 0.33
Nodes (5): Aturan bisnis, Batas MVP, Pengguna dan halaman, Product Requirements: Jadwal Security, Tujuan

### Community 13 - "TestCase"
Cohesion: 0.47
Nodes (3): Illuminate\Foundation\Testing\TestCase, TestingEnvironmentTest, TestCase

### Community 14 - "Jadwal Security"
Cohesion: 0.33
Nodes (5): Cek mobile sebelum rilis, Jadwal Security, Menjalankan lokal, Operasional, Test

### Community 15 - "Instruksi Agen Proyek"
Cohesion: 0.40
Nodes (4): Data dan security, Instruksi Agen Proyek, Konteks dan tool, Scope dan kualitas

### Community 16 - "logging.php"
Cohesion: 0.40
Nodes (4): Monolog\Handler\NullHandler, Monolog\Handler\StreamHandler, Monolog\Handler\SyslogUdpHandler, Monolog\Processor\PsrLogMessageProcessor

### Community 17 - "2026-11-25T07-49-39Z__resources-views.md"
Cohesion: 0.40
Nodes (4): Design Health Score, Design Specificity, Persona Red Flags, Priority Issues

### Community 19 - "Laravel Application"
Cohesion: 0.50
Nodes (3): Agent Setup, Laravel Application, Prerequisites

## Knowledge Gaps
- **101 isolated node(s):** `$schema`, `name`, `type`, `description`, `keywords` (+96 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 165 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **14 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `SecurityOfficer` connect `User` to `Illuminate\Http\Request`, `UserFactory.php`?**
  _High betweenness centrality (0.033) - this node is a cross-community bridge._
- **Why does `User` connect `User` to `UserFactory.php`?**
  _High betweenness centrality (0.029) - this node is a cross-community bridge._
- **Why does `ScheduleAssignment` connect `User` to `Illuminate\Http\Request`?**
  _High betweenness centrality (0.015) - this node is a cross-community bridge._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _101 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.04878048780487805 - nodes in this community are weakly interconnected._
- **Should `Illuminate\Database\Schema\Blueprint` be split into smaller, more focused modules?**
  _Cohesion score 0.10227272727272728 - nodes in this community are weakly interconnected._
- **Should `Illuminate\Http\Request` be split into smaller, more focused modules?**
  _Cohesion score 0.13043478260869565 - nodes in this community are weakly interconnected._