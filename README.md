<p align="center"><img src="/resources/docs/banner.jpg"></p>

# CollabX - Your Developer's Project Management Companion

Welcome to **CollabX** – a modern, free, and open-source project management platform built **by developers, for developers**. Whether you're a freelancer juggling multiple clients or a dev team managing complex projects, CollabX simplifies how you work.

Built with **Laravel** (backend) and **React** (frontend), CollabX gives you everything you need to manage clients, organize projects, track time, and generate professional invoices – all in one intuitive platform.

## Why CollabX?

Sure, there are tons of project management tools out there. But most are bloated, expensive, or not designed with developers in mind. CollabX is different:

- **Built for developers** – Tailored workflows for dev teams and freelancers
- **100% open-source** – Full transparency and customization
- **Self-hosted** – Your data stays in your control
- **Free** – No hidden fees or subscription locks
- **Lightweight & Fast** – Built with modern tech stack

## Features at a Glance

- **User Management** – Create roles (client, manager, developer, designer) with granular permission controls
- **Client Management** – Organize all your clients and their associated projects in one place
- **Project Management** – Full project oversight with team member access controls
- **Smart Task Organization** – Use task groups (Todo, In Progress, QA, Done, Deployed) to visualize workflow
- **Rich Task Features** – Assignees, due dates, custom labels, time estimates, attachments, task subscribers, and comments
- **Advanced Filtering** – Find exactly what you need with powerful task filters
- **Real-time Updates** – Stay in sync with WebSocket-powered live notifications and task updates
- **Smart Mentions** – Tag team members in task descriptions and comments
- **My Tasks Dashboard** – Personalized task view for each team member
- **Activity Tracking** – View project history and activity logs
- **Invoice Management** – Generate professional invoices from billable tasks with logged hours
- **Export Options** – Print or download invoices directly from the platform
- **Comprehensive Dashboard** – View project progress, overdue tasks, recent assignments, and team comments at a glance
- **Time Reports** – Track daily logged time per user and total project time
- **Dark Mode** – Easy on the eyes during those late-night coding sessions

## Screenshots

Take a peek at what CollabX looks like in action:

<p align="center">
<img src="/resources/docs/screenshots/Dashboard - light.jpeg" width="45%">
<img src="/resources/docs/screenshots/Dashboard - dark.jpeg" width="45%">
</p>
<p align="center">
<img src="/resources/docs/screenshots/Projects - light.jpeg" width="45%">
<img src="/resources/docs/screenshots/Projects - dark.jpeg" width="45%">
</p>
<p align="center">
<img src="/resources/docs/screenshots/Project tasks - light.jpeg" width="45%">
<img src="/resources/docs/screenshots/Project tasks - dark.jpeg" width="45%">
</p>
<p align="center">
<img src="/resources/docs/screenshots/Task - light.jpeg" width="45%">
<img src="/resources/docs/screenshots/Task - dark.jpeg" width="45%">
</p>
<p align="center">
<img src="/resources/docs/screenshots/My tasks - light.jpeg" width="45%">
<img src="/resources/docs/screenshots/My tasks - dark.jpeg" width="45%">
</p>
<p align="center">
<img src="/resources/docs/screenshots/Activity - light.jpeg" width="45%">
<img src="/resources/docs/screenshots/Activity - dark.jpeg" width="45%">
</p>
<p align="center">
<img src="/resources/docs/screenshots/Invoice - light.jpeg" width="45%">
<img src="/resources/docs/screenshots/Invoice - dark.jpeg" width="45%">
</p>

## Tech Stack

We built CollabX using modern, proven technologies:

- **Backend:** [Laravel](https://laravel.com) – The most elegant PHP framework
- **Frontend:** [React](https://react.dev) – Powerful and flexible JavaScript library
- **Connector:** [Inertia.js](https://inertiajs.com) – The perfect bridge between Laravel and React
- **UI Components:** [Mantine](https://mantine.dev) – Beautiful, accessible React components
- **Database:** MySQL/MariaDB
- **Real-time:** WebSockets for live updates

## 📦 Quick Start Guide

### Prerequisites

- **PHP** 8.1+ (tested with 8.4)
- **Node.js** 16+
- **Composer**
- **MySQL** 5.7+ or **MariaDB** 10.3+

### Installation (3 Easy Steps)

**Step 1: Clone & Setup**

```bash
# Clone the repository
git clone https://github.com/vstruhar/collab-x.git
cd collab-x

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate
```

**Step 2: Database Configuration**

```bash
# Edit .env and add your database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=collabx
DB_USERNAME=root
DB_PASSWORD=

# Run migrations and seed demo data
php artisan migrate:fresh --seed
```

**Step 3: Install Dependencies & Run**

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# For Development
npm run dev

# For Production
npm run build
php artisan optimize
php artisan storage:link
```

### Default Admin Account

After running migrations, a default admin user is created:

```
Email:    admin@mail.com
Password: password
```

**IMPORTANT:** Change this password immediately in production!

You may use [Pusher](https://pusher.com) for web sockets, since number of free messages should be enough for the use case. Or you can use [open source alternatives](https://laravel.com/docs/10.x/broadcasting#open-source-alternatives).

To use Pusher, sign up, then create a project and copy paste app keys to `.env` (variables with `PUSHER_` prefix).

### Social login (Google)

1. Setup "OAuth consent screen" on Google Console ([link](https://console.cloud.google.com/apis/credentials/consent)).
2. Create "OAuth Client ID", select Web application when asked for type ([link](https://console.cloud.google.com/apis/credentials)).
3. Use generated "Client ID" and "Client secret" in the `.env` (`GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET`).

## Roadmap

- [x] Kanban view.
- [x] Report that will calculate expense and profit per user.
- [ ] Add project notes section.
- [ ] Multiple users should be able to log time on a task
- [ ] Add history of changes to the task.
- [ ] Change specific permission per user.
- [ ] Make it responsive.
- [ ] Add emojis to rich text editor.
- [ ] Write tests.
- [ ] Optimize frontend and backend.
- [ ] Consider moving to TypeScript.
