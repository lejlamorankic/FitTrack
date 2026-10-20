
# AGENTS.md – FitTrack

## Project Overview

FitTrack is a fitness tracking web application developed
for the Web Programming course at International Burch University.

The application helps users track workouts, exercises,
meals, hydration, and fitness progress.

## Technology Stack

### Frontend
- HTML5
- CSS3
- JavaScript
- Bootstrap 5
- SB Admin template
- Single Page Application (SPA)

### Backend
- PHP
- FlightPHP
- REST API
- PDO

### Database
- MySQL

### Authentication
- JWT
- Role-based access control

### External API
- TheMealDB

## Project Architecture

The project follows a layered architecture.

### Frontend
Contains the user interface, SPA navigation,
and JavaScript services.

### Routes
Define REST API endpoints and HTTP methods.

### Services
Contain business logic and input validation.

### DAO
Handle database queries using PDO
and prepared statements.

### Middleware
Handles authentication, authorization,
and request logging.

### Config
Contains application configuration.

## AI Development Rules

1. AI-generated code must be reviewed before use.
2. AI suggestions must follow the existing project structure.
3. AI must not introduce unnecessary dependencies.
4. Database queries must use prepared statements.
5. Passwords must be securely hashed.
6. Sensitive information must never be committed to GitHub.
7. Backend API responses should use JSON.
8. Frontend code should communicate with the backend
   through JavaScript service files.
9. AI-generated code must be tested before submission.
10. Identified AI mistakes and their corrections
    must be documented in docs/AI_LOG.md.

## Coding Conventions

- Use descriptive variable and function names.
- Keep code readable and consistently formatted.
- Separate frontend and backend responsibilities.
- Avoid duplicating business logic.
- Validate input on both client and server.
- Use appropriate HTTP status codes.
- Keep configuration and secrets outside version control.

## Milestone 1 Scope

Milestone 1 includes:

- Initial project structure
- Responsive static frontend
- SPA navigation
- Dashboard and entity pages
- Login and registration interfaces
- External API placeholder
- Database ERD

Database connectivity and authentication
will be implemented in later milestones.

## AI Usage Documentation

AI assistance and verified corrections
should be documented in docs/AI_LOG.md.

The student is responsible for reviewing,
testing, and understanding submitted code.
