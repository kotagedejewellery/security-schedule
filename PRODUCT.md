# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Stack

Laravel 13 with Blade, Tailwind CSS, Alpine.js, PostgreSQL, and Docker Compose. The stack was specified and approved by the user.

## Users

- Security personnel check a shared monthly schedule from a phone or desktop.
- Administrators enter and revise each security officer's daily assignment.

## Product Purpose

Replace the existing monthly spreadsheet with a simple, readable schedule: one read-only page for the team and one protected admin page for schedule management.

## Positioning

The schedule keeps the spreadsheet's familiar date-by-person grid while adding protected editing, validation, and a durable shared record.

## Operating Context

Schedules are organised by month. Each officer has one daily assignment: a fixed location code, off, or leave. The initial location codes are PLG, HJZ, BDG, and SMG.

## Capabilities and Constraints

- No dashboard, automatic rotation, payroll, notifications, export, or HR integration in the MVP.
- The public route is read-only; the admin route requires login and server-side authorisation.
- PostgreSQL must run in Docker Compose with persistent storage. Migrations are forward-only and never reset existing data.
- GSAP, Motion, and Lenis are deferred unless a measured interaction need arises.

## Evidence on Hand

The user supplied a spreadsheet screenshot showing the required monthly schedule format, officer columns, location codes, and leave totals.

## Product Principles

1. Preserve the familiar schedule grid.
2. Keep task completion faster than visual decoration.
3. Make status explicit in text, not colour alone.
4. Protect schedule changes at the server boundary.
5. Stop at the two required surfaces.

## Accessibility & Inclusion

The web interface must support keyboard focus, readable mobile layout, native scrolling, and reduced motion.
