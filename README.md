# HR App

A human resource management app built with Laravel. It covers the day-to-day stuff an HR team deals with: employee records, departments, job roles, task assignments, attendance (presence), payroll with printable slips, and leave requests with an approval flow.

## What it does

- **Dashboard** - headcount stats, latest tasks, and a presence chart (the chart is only visible to management roles).
- **Employees** - full CRUD with department, job role, status, and salary. Each employee can be linked to a login account.
- **Departments & Job Roles** - master data behind the employee records.
- **Tasks** - assign tasks to employees, track status (`pending` / `in_progress` / `completed`).
- **Presence** - daily check-in/check-out records per employee.
- **Payroll** - salary records per employee, with a printable PDF slip (DomPDF).
- **Leave Requests** - employees submit requests; privileged roles confirm or reject them.

## Roles & access

Access control uses [spatie/laravel-permission](https://spatie.be/docs/laravel-permission). There are five roles:

| Role        | Sees                                                                                    | Can manage                                                |
| ----------- | --------------------------------------------------------------------------------------- | --------------------------------------------------------- |
| Super Admin | Everything                                                                              | Everything                                                |
| HR Officer  | Everything                                                                              | Everything                                                |
| Supervisor  | Everything                                                                              | Everything                                                |
| Manager     | Dashboard (with chart), employees, departments, roles, tasks, presence, payroll, leaves | Nothing (view only)                                       |
| Staff       | Dashboard (no chart), own tasks, own presence, own leave requests                       | Own task status, own presence entries, own leave requests |

A few rules worth knowing:

- Everyone who registers gets the **Staff** role automatically, plus a linked employee record.
- Changing someone's job role in the Employee menu also syncs their login permissions.
- You can't change your own role, and you can't demote the last Super Admin - the app will stop you with a 403.
- Staff only ever see their own tasks, presence, and leave records. What isn't yours returns 403.

## Tech Stack

- Laravel 12
- Spatie Permision
- Breeze
- MySQL

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Point `DB_*` in `.env` at your database, then:

```bash
php artisan migrate --seed
npm install && npm run build
php artisan serve
```

Run the test suite with:

```bash
php artisan test
```

## Creating the first Super Admin

Registration only ever creates Staff accounts, so the first admin is bootstrapped from the terminal. Register normally through `/register` first, then promote the account:

```bash
php artisan user:promote you@company.com
```

This assigns the Super Admin role, makes sure the account is linked to an employee record, and aligns the job role to match. After that, further promotions can be done through the Employee menu in the UI - no more terminal needed.

If permissions ever get out of sync (for example after pulling changes to the permission seeder), refresh them with:

```bash
php artisan db:seed --class=RolePermissionSeeder
php artisan permission:cache-reset
```
