# API Documentation

## Authentication

All API endpoints require authentication via Bearer token in the Authorization header.

```
Authorization: Bearer {token}
```

## Endpoints

### Users

-   `GET /api/users` - List all users
-   `GET /api/users/{id}` - Get user details
-   `POST /api/users` - Create new user
-   `PUT /api/users/{id}` - Update user
-   `DELETE /api/users/{id}` - Delete user

### Projects

-   `GET /api/projects` - List all projects
-   `GET /api/projects/{id}` - Get project details
-   `POST /api/projects` - Create new project
-   `PUT /api/projects/{id}` - Update project
-   `DELETE /api/projects/{id}` - Delete project

### Tasks

-   `GET /api/tasks` - List all tasks
-   `GET /api/tasks/{id}` - Get task details
-   `POST /api/tasks` - Create new task
-   `PUT /api/tasks/{id}` - Update task
-   `DELETE /api/tasks/{id}` - Delete task
