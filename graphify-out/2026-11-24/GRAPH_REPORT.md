# Graph Report - security-schedule  (2026-11-24)

## Corpus Check
- 47 files · ~11,707 words
- Verdict: corpus is large enough that graph structure adds value.
- Unclassified: 22 file(s) not represented in the graph (top: (none) 18, .example 1, .xml 1)

## Summary
- 242 nodes · 280 edges · 29 communities (15 shown, 14 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- Laravel Application
- Usulan Tech Stack — Security Schedule MVP
- composer.json
- Illuminate\Database\Schema\Blueprint
- Illuminate\Http\Request
- User
- package.json
- Product
- bootstrap/app.php
- require-dev
- README.md
- config
- AppServiceProvider
- TestCase
- logging.php
- Laravel Application
- console.php
- ExampleTest
- artisan

## God Nodes (most connected - your core abstractions)
1. `Product` - 11 edges
2. `AdminScheduleController` - 9 edges
3. `SecurityOfficer` - 9 edges
4. `User` - 9 edges
5. `scripts` - 9 edges
6. `require-dev` - 8 edges
7. `Usulan Tech Stack — Security Schedule MVP` - 8 edges
8. `ScheduleAssignment` - 7 edges
9. `ScheduleController` - 6 edges
10. `AppServiceProvider` - 5 edges

## Surprising Connections (you probably didn't know these)
- `ScheduleController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/ScheduleController.php → app/Http/Controllers/Controller.php
- `AdminScheduleController` --inherits--> `ScheduleController`  [EXTRACTED]
  app/Http/Controllers/AdminScheduleController.php → app/Http/Controllers/ScheduleController.php
- `ExampleTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/ExampleTest.php → tests/TestCase.php

## Import Cycles
- None detected.

## Communities (29 total, 14 thin omitted)

### Community 0 - "Laravel Application"
Cohesion: 0.50
Nodes (3): Agent Setup, Laravel Application, Prerequisites

### Community 1 - "Usulan Tech Stack — Security Schedule MVP"
Cohesion: 0.18
Nodes (10): Acceptance criteria implementasi, Alternatif bila tim sudah TypeScript-first, Asumsi yang perlu dikonfirmasi sebelum implementasi, Batas Docker dan data, Batas MVP, Bentuk aplikasi, Data minimum, Keputusan (+2 more)

### Community 2 - "composer.json"
Cohesion: 0.06
Nodes (32): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+24 more)

### Community 3 - "Illuminate\Database\Schema\Blueprint"
Cohesion: 0.10
Nodes (15): {closure#1}(), {closure#2}(), {closure#3}(), {closure#1}(), {closure#2}(), {closure#1}(), {closure#2}(), {closure#3}() (+7 more)

### Community 4 - "Illuminate\Http\Request"
Cohesion: 0.13
Nodes (10): AdminScheduleController, Controller, ScheduleController, ScheduleAssignment, SecurityOfficer, Carbon\Carbon, Illuminate\Database\Eloquent\Model, Illuminate\Http\Request (+2 more)

### Community 5 - "User"
Cohesion: 0.10
Nodes (14): User, UserFactory, DatabaseSeeder, Illuminate\Database\Eloquent\Attributes\Fillable, Illuminate\Database\Eloquent\Attributes\Hidden, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Seeder (+6 more)

### Community 6 - "package.json"
Cohesion: 0.10
Nodes (20): devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite, optionalDependencies, @laravel/multiplex (+12 more)

### Community 7 - "Product"
Cohesion: 0.17
Nodes (11): Accessibility & Inclusion, Capabilities and Constraints, Evidence on Hand, Operating Context, Platform, Positioning, Product, Product Principles (+3 more)

### Community 8 - "bootstrap/app.php"
Cohesion: 0.32
Nodes (6): {closure#1}(), {closure#2}(), {closure#3}(), Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

### Community 9 - "require-dev"
Cohesion: 0.25
Nodes (8): require-dev, fakerphp/faker, laravel/pail, laravel/pao, laravel/pint, mockery/mockery, nunomaduro/collision, phpunit/phpunit

### Community 10 - "README.md"
Cohesion: 0.25
Nodes (7): About Laravel, Agentic Development, Code of Conduct, Contributing, Learning Laravel, License, Security Vulnerabilities

### Community 11 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 13 - "TestCase"
Cohesion: 0.47
Nodes (3): Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase

### Community 14 - "logging.php"
Cohesion: 0.40
Nodes (4): Monolog\Handler\NullHandler, Monolog\Handler\StreamHandler, Monolog\Handler\SyslogUdpHandler, Monolog\Processor\PsrLogMessageProcessor

### Community 15 - "Laravel Application"
Cohesion: 0.50
Nodes (3): Agent Setup, Laravel Application, Prerequisites

## Knowledge Gaps
- **79 isolated node(s):** `$schema`, `name`, `type`, `description`, `keywords` (+74 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 135 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **14 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `SecurityOfficer` connect `Illuminate\Http\Request` to `User`?**
  _High betweenness centrality (0.034) - this node is a cross-community bridge._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _79 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.06060606060606061 - nodes in this community are weakly interconnected._
- **Should `Illuminate\Database\Schema\Blueprint` be split into smaller, more focused modules?**
  _Cohesion score 0.10227272727272728 - nodes in this community are weakly interconnected._
- **Should `Illuminate\Http\Request` be split into smaller, more focused modules?**
  _Cohesion score 0.12698412698412698 - nodes in this community are weakly interconnected._
- **Should `User` be split into smaller, more focused modules?**
  _Cohesion score 0.10461538461538461 - nodes in this community are weakly interconnected._
- **Should `package.json` be split into smaller, more focused modules?**
  _Cohesion score 0.09956709956709957 - nodes in this community are weakly interconnected._