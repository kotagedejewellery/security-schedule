---
target: mobile admin and public schedule
total_score: 21
max_score: 40
na_heuristics: 
p0_count: 0
p1_count: 3
target_identity: "file:E:\\AI Engineer\\PT KotaGede Jewellery\\New System\\security-schedule\\resources\\views\\admin\\schedule.blade.php"
target_fingerprint: "sha256:c0d8636c73ff2b919245b3ecba16273f19dda4df1fefd9a53ff4428ee6a4cb4a"
target_path: "E:\\AI Engineer\\PT KotaGede Jewellery\\New System\\security-schedule\\resources\\views\\admin\\schedule.blade.php"
timestamp: 2026-11-25T10-01-44Z
slug: resources-views-admin-schedule-blade-php
---
# Mobile UI/UX review: admin and public schedule

## Design health score

| # | Heuristic | Score | Key issue |
| --- | --- | ---: | --- |
| 1 | Visibility of system status | 3 | Save success exists, but unsaved changes are not communicated. |
| 2 | Match with real world | 3 | The monthly grid and Indonesian labels are familiar. |
| 3 | User control and freedom | 2 | Blank selection deletes an assignment; there is no undo or leave-warning. |
| 4 | Consistency and standards | 2 | Month navigation and public preview are duplicated in the admin flow. |
| 5 | Error prevention | 1 | “Kosong” can delete saved data without an explicit destructive affordance. |
| 6 | Recognition rather than recall | 3 | Labels, sticky context, and textual statuses reduce memorisation. |
| 7 | Flexibility and efficiency | 2 | The one-cell workflow is dependable but slow for repeated monthly work. |
| 8 | Aesthetic and minimalist design | 2 | Mobile header controls compete with the schedule. |
| 9 | Error recovery | 1 | No recovery path for unintended clearing or abandoned edits. |
| 10 | Help and documentation | 2 | Small hints exist, but edit consequences lack contextual guidance. |
| **Total** |  | **21/40** | **Acceptable; significant refinement needed** |

## Design specificity verdict

The sticky date column, month cadence, location codes, and textual duty states are specific to security scheduling. The shell is coherent but the mobile control structure is not yet specific to fast duty entry: it looks like a generic internal form header before the actual schedule work begins.

The deterministic source detector found no rule violations in either Blade view. Source-level accessibility evidence found two contrast risks: base-location text in table headers is approximately 4.24:1 at a small size, and the empty em-dash state is approximately 2.34:1. Browser rendering for the authenticated admin screen was not available.

## Overall impression

The grid is the right product. The highest-value change is to let it own the first viewport on a phone: reduce header competition, retain one clear preview action, and make destructive clearing unmistakable.

## What is working

- Native horizontal scrolling, sticky date/headers, and 44px controls respect the mobile spreadsheet use case.
- Table semantics, select labels, visible focus, reduced-motion handling, and textual statuses provide a strong accessible base.
- The save bar gives a clear primary action once an admin is editing.

## Priority issues

### P1 — Public header layout breaks its hierarchy at phone width

The public screenshot shows the title and updated-status text squeezed beside the month controls. The mobile control block remains inside the desktop two-column header grid, so the title loses its full-width reading area.

**Fix:** at the mobile breakpoint make the masthead one column. Show title/status first at full width, then one month-picker row, then previous/next as the secondary row. Keep only this one navigation pattern.

### P1 — Admin header exposes too many competing actions before the grid

Month selection, Tampilkan, Lihat publik, and Keluar wrap within the same dark header. The schedule appears only after a large action stack.

**Fix:** reserve the header for month selection. Keep a single preview action in the save bar and move logout to a quiet text action. This removes the duplicate “Lihat publik” / “Pratinjau publik” route.

### P1 — “Kosong” hides a destructive outcome

Choosing an empty value deletes an existing assignment on save. The note is easy to miss while scanning many selects.

**Fix:** use an explicit “Hapus penugasan” option for a saved cell, and show an unsaved-change state before switching month, previewing, or leaving. Do not add complex history; a lightweight leave confirmation is sufficient for the MVP.

### P2 — Horizontal scrolling lacks an editor cue

The public view says to swipe the table, but the editor does not. On the supplied screenshot, only part of the officer columns is visible.

**Fix:** add the same concise instruction directly above the admin grid: “Geser tabel untuk melihat petugas lain.” Keep the sticky date column.

### P2 — Small secondary text and empty cells need stronger contrast

Officer base locations and empty em-dashes are hard to read at phone scale.

**Fix:** darken those two neutral tones to WCAG AA contrast; do not alter semantic status colors that already pass.

## Persona red flags

- **Alex, admin rutin:** monthly repetition means hundreds of native-select interactions. Confirm whether admins create full months or only change exceptions before considering one small fill/copy action.
- **Sam, keyboard/screen-reader user:** semantic markup is good, but a large two-axis grid remains laborious and there is no announced recovery state for accidental deletion.
- **Casey, mobile one-handed user:** target sizes are good, but the tall header and unsaved edits increase interruption risk before reaching the primary task.

## Minor observations

- The location-code disclosure is appropriately progressive, but its summary needs a 44px touch target.
- The empty admin state should say who can resolve the missing-officer condition, since officer management is deliberately out of scope.
- Consolidate visual tokens later; palette overrides at the end of inline styles make future tuning harder, but this is not a user-facing priority.

## Questions to consider

1. Does the admin normally build a whole month or only change exceptions?
2. Should changing a month while edits are unsaved be blocked with a confirmation?
3. Is the direct month picker essential, or are previous/next controls sufficient for normal use?
