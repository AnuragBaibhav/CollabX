# CollabX - Open-Source Project Management Platform

A powerful, open-source project management and collaboration platform designed for developers and teams. CollabX provides comprehensive tools for managing clients, projects, tasks, time tracking, and invoicing in one intuitive interface.

## 🌟 Key Features

### Core Functionality

-   **User Management** – Role-based access control with granular permissions
-   **Client Management** – Organize and manage all clients with project associations
-   **Project Management** – Full project oversight with team collaboration
-   **Task Management** – Smart task organization with customizable workflows
-   **Time Tracking** – Log hours and generate time reports
-   **Invoice Management** – Create professional invoices from billable tasks
-   **Activity Audit Trail** – Track all project changes and user actions

### Collaboration Features

-   **Real-time Notifications** – WebSocket-powered live updates
-   **Task Comments** – Threaded comments on tasks
-   **User Mentions** – Tag team members in descriptions and comments
-   **Task Subscribers** – Track relevant tasks with automatic notifications
-   **Activity Dashboard** – View project history and team activity

### Advanced Capabilities

-   **Advanced Filtering** – Powerful search and filtering on tasks
-   **Custom Labels** – Organize tasks with custom labeling
-   **Task Attachments** – Upload files directly to tasks
-   **Dark Mode** – Built-in dark theme support
-   **Export Options** – Print or download reports and invoices
-   **RESTful API** – Full API endpoints for programmatic access

## 🛠️ Technology Stack

| Component        | Technology                       |
| ---------------- | -------------------------------- |
| **Backend**      | Laravel 11+                      |
| **Frontend**     | React 18+                        |
| **UI Framework** | Mantine Components               |
| **Bridge**       | Inertia.js                       |
| **Database**     | MySQL 8.0+ / MariaDB 10.5+       |
| **Real-time**    | WebSockets (Pusher/Laravel Echo) |
| **Build Tool**   | Vite                             |

## 📋 Prerequisites

Before installation, ensure you have:

-   **PHP** 8.2 or higher
-   **Node.js** 18 or higher
-   **Composer** (latest version)
-   **MySQL** 8.0+ or **MariaDB** 10.5+
-   **Git**

## 🚀 Installation & Setup

### Step 1: Clone the Repository

```bash
git clone https://github.com/AnuragBaibhav/CollabX.git
cd CollabX
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

-   [x] Kanban view
-   [x] Financial reports with expense and profit calculations
-   [ ] Project notes section
-   [ ] Multi-user time logging on single task
-   [ ] Complete task change history
-   [ ] Per-user permission customization
-   [ ] Mobile responsive design
-   [ ] Rich text editor enhancements
-   [ ] Comprehensive test suite
-   [ ] Frontend and backend optimization
-   [ ] TypeScript migration

## 📁 Project Structure

```
CollabX/
├── app/                    # Laravel application code
│   ├── Actions/           # Business logic actions
│   ├── Http/              # Controllers, requests, middleware
│   ├── Models/            # Eloquent models
│   ├── Services/          # Service layer
│   ├── Events/            # Event classes
│   ├── Listeners/         # Event listeners
│   └── Notifications/     # Email notifications
├── config/                # Configuration files
├── database/              # Migrations, factories, seeders
├── resources/
│   ├── css/              # Stylesheets
│   ├── js/               # React components
│   └── views/            # Blade templates
├── routes/               # API and web routes
├── storage/              # File uploads and logs
└── vendor/               # Composer dependencies
```

## ⚙️ Environment Configuration

Key environment variables to configure:

```env
# Application
APP_NAME=CollabX
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=collabx
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@collabx.com

# Broadcasting (WebSockets)
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https

# OAuth (Google)
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
```

## 🔧 Common Tasks

### Start Development Server

```bash
# Terminal 1: Run Laravel development server
php artisan serve

# Terminal 2: Run Vite development server
npm run dev
```

### Run Database Migrations

```bash
# Run all pending migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh database (careful in production!)
php artisan migrate:fresh --seed
```

### Create an Admin User

```bash
php artisan tinker
>>> App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role_id' => 1
]);
```

### Cache Optimization

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Clear all caches
php artisan cache:clear
```

## 📚 API Documentation

The application provides a comprehensive RESTful API. See [API.md](API.md) for complete endpoint documentation.

### API Features

-   Bearer token authentication
-   Comprehensive error handling
-   Pagination support
-   Advanced filtering
-   Request validation

## 🐛 Troubleshooting

### Database Connection Error

```bash
# Verify database configuration in .env
# Check MySQL is running
# Ensure database exists: CREATE DATABASE collabx;
```

### Laravel Not Found / 404 Errors

```bash
php artisan cache:clear
php artisan route:cache
php artisan config:cache
```

### WebSocket Connection Issues

```bash
# Check Pusher credentials in .env
# Verify BROADCAST_DRIVER is set correctly
# Test Pusher connection in Laravel logs
```

### File Upload Issues

```bash
# Create storage link
php artisan storage:link

# Check permissions
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

## 📖 Documentation

-   **Setup Guide**: See [SETUP.md](SETUP.md)
-   **Contributing**: See [CONTRIBUTING.md](CONTRIBUTING.md)
-   **API Docs**: See [API.md](API.md)
-   **Changelog**: See [CHANGELOG.md](CHANGELOG.md)

## 🤝 Contributing

We welcome contributions! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines on:

-   Code standards (PSR-12)
-   Submitting pull requests
-   Reporting issues
-   Feature requests

### Development Workflow

```bash
# Create a feature branch
git checkout -b feature/your-feature

# Make your changes and commit
git add .
git commit -m "Add your feature"

# Push and create a pull request
git push origin feature/your-feature
```

## 📄 License

CollabX is open-source software licensed under the MIT License. See [LICENSE.md](LICENSE.md) for details.

## 👥 Support

-   **Report Issues**: [GitHub Issues](https://github.com/AnuragBaibhav/CollabX/issues)
-   **Discussions**: [GitHub Discussions](https://github.com/AnuragBaibhav/CollabX/discussions)
-   **Email**: support@collabx.dev

## 🙏 Acknowledgments

CollabX is built with modern open-source technologies:

-   [Laravel](https://laravel.com)
-   [React](https://react.dev)
-   [Inertia.js](https://inertiajs.com)
-   [Mantine](https://mantine.dev)
-   And many other wonderful open-source projects

---

**Made with ❤️ by developers, for developers**
