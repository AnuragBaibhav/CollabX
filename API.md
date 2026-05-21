# CollabX API Documentation

## Overview

CollabX is a comprehensive project management and team collaboration platform. All API endpoints follow RESTful conventions and require authentication.

## Authentication

All API endpoints require authentication via Bearer token in the Authorization header.

```
Authorization: Bearer {token}
```

## Base URL

```
http://127.0.0.1:8000/api
```

## Response Format

All responses are in JSON format with consistent structure:

```json
{
    "success": true,
    "data": {},
    "message": "Operation successful"
}
```

---

## Endpoints

### Users

User management endpoints for team members.

-   `GET /api/users` - List all users
    -   Query params: `?search={name}`, `?role={role}`, `?page={page}`
-   `GET /api/users/{id}` - Get user details
-   `POST /api/users` - Create new user
    -   Body: `{name, email, password, phone, rate, job_title}`
-   `PUT /api/users/{id}` - Update user
    -   Body: `{name, email, phone, rate, job_title}`
-   `DELETE /api/users/{id}` - Delete user

---

### Projects

Project management with team assignments and client associations.

-   `GET /api/projects` - List all projects
    -   Query params: `?client_id={id}`, `?status={status}`, `?page={page}`
-   `GET /api/projects/{id}` - Get project details with team and tasks
-   `POST /api/projects` - Create new project
    -   Body: `{name, description, client_company_id, start_date, end_date}`
-   `PUT /api/projects/{id}` - Update project
    -   Body: `{name, description, client_company_id, start_date, end_date}`
-   `DELETE /api/projects/{id}` - Delete project
-   `POST /api/projects/{id}/assign-user` - Assign user to project
    -   Body: `{user_id}`
-   `DELETE /api/projects/{id}/remove-user/{user_id}` - Remove user from project

---

### Tasks

Task management with assignments, labels, and workflow states.

-   `GET /api/tasks` - List all tasks
    -   Query params: `?project_id={id}`, `?status={status}`, `?assignee_id={id}`, `?page={page}`
-   `GET /api/tasks/{id}` - Get task details with comments and time logs
-   `POST /api/tasks` - Create new task
    -   Body: `{name, description, project_id, task_group_id, assigned_to, priority, due_date, time_estimate}`
-   `PUT /api/tasks/{id}` - Update task
    -   Body: `{name, description, task_group_id, assigned_to, priority, due_date, time_estimate}`
-   `DELETE /api/tasks/{id}` - Delete task
-   `PUT /api/tasks/{id}/status` - Update task status/group
    -   Body: `{task_group_id}`
-   `POST /api/tasks/{id}/add-label` - Add label to task
    -   Body: `{label_id}`
-   `DELETE /api/tasks/{id}/remove-label/{label_id}` - Remove label from task

---

### Task Groups

Kanban board workflow stages.

-   `GET /api/task-groups` - List all task groups (Backlog, Todo, In progress, QA, Done, Deployed)
-   `GET /api/task-groups/{id}` - Get task group details
-   `POST /api/task-groups` - Create new task group
    -   Body: `{name, order}`
-   `PUT /api/task-groups/{id}` - Update task group
    -   Body: `{name, order}`
-   `DELETE /api/task-groups/{id}` - Delete task group

---

### Comments

Collaboration through task comments.

-   `GET /api/tasks/{task_id}/comments` - List task comments
-   `POST /api/tasks/{task_id}/comments` - Add comment to task
    -   Body: `{content}`
-   `PUT /api/comments/{id}` - Edit comment
    -   Body: `{content}`
-   `DELETE /api/comments/{id}` - Delete comment

---

### Time Logs

Track time spent on tasks.

-   `GET /api/tasks/{task_id}/time-logs` - List time logs for task
-   `GET /api/projects/{project_id}/time-logs` - List time logs for project
-   `POST /api/tasks/{task_id}/time-logs` - Log time on task
    -   Body: `{hours, date, description}`
-   `PUT /api/time-logs/{id}` - Update time log
    -   Body: `{hours, date, description}`
-   `DELETE /api/time-logs/{id}` - Delete time log

---

### Labels

Task categorization and organization.

-   `GET /api/labels` - List all labels
-   `GET /api/labels/{id}` - Get label details
-   `POST /api/labels` - Create new label
    -   Body: `{name, color}`
-   `PUT /api/labels/{id}` - Update label
    -   Body: `{name, color}`
-   `DELETE /api/labels/{id}` - Delete label

---

### Invoices

Invoice generation and management.

-   `GET /api/invoices` - List all invoices
    -   Query params: `?client_id={id}`, `?status={status}`, `?page={page}`
-   `GET /api/invoices/{id}` - Get invoice details
-   `POST /api/invoices` - Create new invoice
    -   Body: `{project_id, client_company_id, invoice_date, due_date, note}`
-   `PUT /api/invoices/{id}` - Update invoice
    -   Body: `{status, note}`
-   `DELETE /api/invoices/{id}` - Delete invoice
-   `POST /api/invoices/{id}/send` - Send invoice via email
-   `GET /api/invoices/{id}/pdf` - Download invoice as PDF

---

### Clients/Companies

Client company management.

-   `GET /api/clients/companies` - List all client companies
    -   Query params: `?search={name}`, `?page={page}`
-   `GET /api/clients/companies/{id}` - Get company details
-   `POST /api/clients/companies` - Create new client company
    -   Body: `{name, email, phone, address, city, postal_code, country_id}`
-   `PUT /api/clients/companies/{id}` - Update client company
    -   Body: `{name, email, phone, address, city, postal_code, country_id}`
-   `DELETE /api/clients/companies/{id}` - Delete client company

---

### Reports

Analytics and reporting endpoints.

-   `GET /api/reports/logged-time` - Get logged time summary
    -   Query params: `?project_id={id}`, `?user_id={id}`, `?from={date}`, `?to={date}`
-   `GET /api/reports/project-summary` - Get project summary statistics
    -   Query params: `?project_id={id}`
-   `GET /api/reports/user-performance` - Get user performance metrics
    -   Query params: `?user_id={id}`, `?from={date}`, `?to={date}`
-   `GET /api/reports/invoice-summary` - Get invoice statistics
    -   Query params: `?from={date}`, `?to={date}`, `?status={status}`
-   `GET /api/reports/task-completion` - Get task completion rates
    -   Query params: `?project_id={id}`, `?from={date}`, `?to={date}`

---

### Settings

System configuration and preferences.

-   `GET /api/settings` - Get all settings
-   `PUT /api/settings` - Update settings
    -   Body: `{app_name, timezone, currency, default_language}`

---

## Error Handling

API errors follow standard HTTP status codes:

-   `200 OK` - Successful GET, PUT request
-   `201 Created` - Successful POST request
-   `204 No Content` - Successful DELETE request
-   `400 Bad Request` - Invalid request data
-   `401 Unauthorized` - Missing or invalid authentication
-   `403 Forbidden` - Insufficient permissions
-   `404 Not Found` - Resource not found
-   `422 Unprocessable Entity` - Validation error
-   `500 Internal Server Error` - Server error

Error response format:

```json
{
    "success": false,
    "message": "Error message",
    "errors": {
        "field": ["Error detail"]
    }
}
```

---

## Rate Limiting

API requests are rate limited to prevent abuse:

-   1000 requests per hour per authenticated user
-   100 requests per hour per IP for unauthenticated requests

---

## Pagination

List endpoints support pagination with the following parameters:

-   `page` - Page number (default: 1)
-   `per_page` - Items per page (default: 15, max: 100)

Response includes pagination metadata:

```json
{
    "data": [],
    "pagination": {
        "total": 100,
        "per_page": 15,
        "current_page": 1,
        "last_page": 7
    }
}
```

---

## Sorting & Filtering

Most list endpoints support filtering and sorting:

-   `sort_by` - Field to sort by (e.g., `created_at`, `name`)
-   `sort_order` - `asc` or `desc` (default: `desc`)
-   `filter[field]` - Filter by field value

Example:

```
GET /api/tasks?sort_by=due_date&sort_order=asc&filter[status]=open
```
