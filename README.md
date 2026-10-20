
# FitTrack – Fitness Tracking Web Application

**GitHub Repository:** https://github.com/lejlamorankic/FitTrack

**Course:** Web Programming  
**University:** International Burch University  
**Project:** Semester Project  
**Current Milestone:** Milestone 1

---

## 1. Project Overview

FitTrack is a fitness tracking web application designed to help users monitor their physical activities, nutrition, hydration, and personal fitness progress in one centralized platform.

The application provides interfaces for managing exercises, recording workouts, tracking meals and nutritional information, monitoring daily water intake, and following changes in body weight.

FitTrack is developed as a semester project for the Web Programming course at International Burch University.

The project is developed incrementally across five milestones, beginning with a static Single Page Application (SPA) and progressing toward a fully functional web application with a database, REST API, authentication, and deployment.

## 2. Project Objectives

The main objectives of FitTrack are to:

- Provide a centralized fitness tracking platform.
- Allow users to view and manage exercises.
- Record workouts, including exercises, sets, repetitions, and duration.
- Track meals, calories, and protein intake.
- Monitor daily hydration and water consumption goals.
- Track body weight and fitness progress over time.
- Provide recipe inspiration using an external API.
- Support user registration, login, and account management.
- Implement secure authentication and role-based authorization in later milestones.

## 3. Technologies

### Frontend

- HTML5
- CSS3
- JavaScript
- Bootstrap 5
- Start Bootstrap SB Admin Template
- Font Awesome Icons
- Fetch API
- Hash-based Single Page Application (SPA) navigation

### Backend (Planned)

- PHP
- FlightPHP Framework
- REST API
- PDO for database access
- JWT authentication
- Role-based access control (RBAC)

### Database (Planned)

- MySQL

### External API (Planned)

- TheMealDB API – Recipe inspiration and meal discovery

### Development Tools

- Visual Studio Code
- Live Server Extension
- XAMPP
- Git
- GitHub
- Microsoft Edge Developer Tools

## 4. Project Structure

```text
FitTrack/
│
├── frontend/
│   ├── assets/
│   ├── css/
│   │   └── styles.css
│   ├── js/
│   │   ├── scripts.js
│   │   └── spa.js
│   ├── views/
│   │   ├── dashboard.html
│   │   ├── exercises.html
│   │   ├── workouts.html
│   │   ├── meals.html
│   │   ├── hydration.html
│   │   ├── progress.html
│   │   ├── profile.html
│   │   ├── login.html
│   │   └── register.html
│   └── index.html
│
├── backend/
│   ├── config/
│   │   └── .gitkeep
│   ├── dao/
│   │   └── .gitkeep
│   ├── logs/
│   │   └── .gitkeep
│   ├── middleware/
│   │   └── .gitkeep
│   ├── routes/
│   │   └── .gitkeep
│   └── services/
│       └── .gitkeep
│
├── docs/
│   ├── erd.md
│   └── AI_LOG.md
│
├── .gitignore
├── AGENTS.md
└── README.md
```

The frontend directory contains the user interface, static assets, page templates, and JavaScript navigation.

The backend directory contains the planned structure for the PHP application. Its folders are currently placeholders and will be implemented in later milestones.

The docs directory contains database planning and AI usage documentation.

The frontend also retains supporting files from the original SB Admin template. The FitTrack SPA uses `frontend/index.html` as its main entry point.

## 5. Single Page Application Architecture

FitTrack uses a hash-based Single Page Application architecture.

The main entry point is:

`frontend/index.html`

Individual page templates are stored in:

`frontend/views/`

The JavaScript navigation logic is implemented in:

`frontend/js/spa.js`

### How SPA Navigation Works

1. The user opens `frontend/index.html`.
2. The application displays the main navigation layout.
3. The user selects a page from the sidebar.
4. The URL hash changes, for example from `#dashboard` to `#meals`.
5. JavaScript loads the corresponding HTML template using the Fetch API.
6. The content is displayed inside the main application container.
7. The main page layout remains loaded without a full browser page refresh.

### Example Routes

- `#dashboard`
- `#exercises`
- `#workouts`
- `#meals`
- `#hydration`
- `#progress`
- `#profile`
- `#login`
- `#register`

The navigation system has been tested locally in the browser.

## 6. Application Pages

### 6.1 Dashboard

The Dashboard provides an overview of the user's fitness activity.

It includes:

- Workout summary
- Calorie tracking summary
- Hydration summary
- Exercise statistics
- Daily goals
- Quick navigation actions

### 6.2 Exercises

The Exercises page displays an exercise catalog.

It includes:

- Exercise list
- Exercise names
- Muscle groups
- Difficulty levels
- Add Exercise interface
- Edit and Delete buttons

The management controls are currently part of the static frontend prototype.

### 6.3 Workouts

The Workouts page provides an interface for tracking completed workouts.

Planned workout information includes:

- Exercise
- Workout date
- Sets
- Repetitions
- Duration

### 6.4 Meals

The Meals page provides an interface for recording food consumption.

It includes or plans to support:

- Meal names
- Meal categories
- Calorie information
- Protein information
- Meal history
- Recipe inspiration

The recipe inspiration feature is reserved for the planned external API integration.

### 6.5 Hydration

The Hydration page provides an interface for monitoring water consumption.

Planned functionality includes:

- Daily water intake
- Hydration history
- Water intake entries
- Daily hydration goals

### 6.6 Progress

The Progress page provides an interface for monitoring fitness development over time.

Planned functionality includes:

- Weight history
- Progress entries
- Weight goals
- Fitness progress information

### 6.7 My Profile

The Profile page contains interfaces for:

- Personal information
- Email address
- Fitness information
- Height and weight
- Activity level
- Fitness goals
- Account security settings

### 6.8 Login

The Login page includes:

- Email input
- Password input
- Remember Me checkbox
- Login button
- Navigation to registration

Authentication is not yet connected to a backend.

### 6.9 Register

The Register page includes:

- Full name
- Email address
- Password
- Password confirmation
- Primary fitness goal
- Registration button
- Navigation to login

Account creation will be implemented in a later milestone.

## 7. Responsive Design

FitTrack uses Bootstrap 5 and the SB Admin template to provide a consistent and responsive user interface.

The application includes:

- Responsive page layouts
- Bootstrap cards and forms
- Responsive navigation
- Collapsible sidebar
- Mobile-friendly navigation controls

The application was tested locally using Microsoft Edge Developer Tools with a mobile viewport width of 400 pixels.

The sidebar was successfully opened and closed in the mobile view.

Additional responsive testing will continue as the project develops.

## 8. Database Design

The planned database uses MySQL and contains six main entities.

| Entity | Description |
|---|---|
| users | Stores user accounts and roles |
| exercises | Stores the exercise catalog |
| workouts | Stores workout records |
| meals | Stores recorded meals and nutritional information |
| hydration_entries | Stores water consumption records |
| progress_entries | Stores body weight and progress records |

### Entity Relationships

- One user can have multiple workout records.
- One user can have multiple meal records.
- One user can have multiple hydration entries.
- One user can have multiple progress entries.
- One exercise can be referenced by multiple workout records.

Each entity has a primary key.

Related entities use foreign keys to define their relationships.

### Entity Relationship Diagram

The initial ERD is available here:

[View Database ERD](docs/erd.md)

The ERD was created using Mermaid and successfully rendered in VS Code Markdown Preview.

The database will be implemented in MySQL during Milestone 2.

## 9. External API Integration

FitTrack plans to integrate the public TheMealDB API.

**API Website:** https://www.themealdb.com/api.php

### Purpose

The external API will provide recipe inspiration for users interested in discovering meal ideas.

### Planned Features

- Search for recipes.
- Display recipe names and images.
- View ingredients.
- View recipe preparation instructions.
- Explore meal ideas from an external source.

### API Placement

The external API feature will appear in the Meals section of FitTrack.

### Current Status

The frontend location for recipe inspiration is planned.

Actual API requests and error handling will be implemented in a later milestone.

TheMealDB provides recipe information but is not used as a verified source of calorie or protein values.

## 10. How to Run the Frontend

### Requirements

- Visual Studio Code
- Live Server extension
- Modern web browser

### Installation and Setup

1. Clone the GitHub repository:

```bash
git clone https://github.com/lejlamorankic/FitTrack.git
```

2. Open the project in Visual Studio Code.

3. Navigate to the `frontend` directory.

4. Open `index.html` using the Live Server extension.

5. Use the FitTrack sidebar to navigate between application pages.

### Local Development URL

When Live Server is started from the parent workspace, the application can be accessed at:

`http://127.0.0.1:5500/FitTrack/frontend/index.html#dashboard`

The exact URL depends on the Live Server workspace root and configuration.

### Important Note

The application should be opened through a local web server rather than directly using a `file://` URL because the SPA uses the Fetch API to load HTML templates.

A running PHP backend or MySQL database is not required for Milestone 1.

## 11. Current Implementation – Milestone 1

Milestone 1 focuses on initial project setup, static frontend development, and database planning.

### Completed Locally

- Frontend folder structure
- Backend folder structure
- `.gitignore` configuration
- Responsive Bootstrap interface
- SPA navigation using JavaScript
- Dashboard page
- Exercises page
- Workouts page
- Meals page
- Hydration page
- Progress page
- Profile page
- Login page
- Register page
- External API feature placement
- Initial database ERD with six entities
- README documentation
- AGENTS.md development guidelines
- AI usage documentation

### Testing Performed

- Dashboard loaded successfully in the browser.
- All nine SPA pages were opened through navigation.
- Navigation between pages worked without full page reloads.
- Mobile sidebar opening and closing was tested.
- The Mermaid ERD was rendered successfully.
- Git repository and branch were checked locally.

## 12. Current Limitations

Milestone 1 contains a static frontend prototype.

The following functionality is not yet implemented:

- Database persistence
- Backend REST API
- Real user authentication
- JWT authorization
- Functional database CRUD operations
- Persistent user profile changes
- Real workout, meal, hydration, and progress tracking
- External API requests

The application currently uses demonstration data.

Add, Edit, Delete, and Save actions are not yet connected to persistent storage.

These features will be implemented in future milestones.

## 13. Planned Milestones

### Milestone 2 – Database and DAO Layer

Planned tasks:

- Create the MySQL database.
- Implement at least five related tables.
- Define primary and foreign keys.
- Insert sample data.
- Implement PDO database connectivity.
- Create a BaseDao class.
- Implement DAO classes and CRUD operations.
- Provide an SQL export.
- Keep sensitive database configuration out of Git.

### Milestone 3 – Services and REST API

Planned tasks:

- Implement service classes.
- Add business logic and validation.
- Create REST API endpoints using FlightPHP.
- Implement CRUD operations.
- Return JSON responses and appropriate HTTP status codes.
- Document endpoints using Swagger/OpenAPI.
- Implement the external API service and endpoint.
- Handle external API errors and timeouts.

### Milestone 4 – Authentication and Frontend Integration

Planned tasks:

- Implement user registration and login.
- Hash passwords securely.
- Implement JWT authentication.
- Implement role-based access control.
- Add authentication and authorization middleware.
- Implement request and error logging.
- Connect frontend pages to backend REST endpoints.
- Replace demonstration data with real database data.
- Implement AJAX-based CRUD operations.
- Display external API results in the frontend.

### Milestone 5 – Finalization and Deployment

Planned tasks:

- Organize frontend JavaScript using an MVC-style structure.
- Implement client-side and server-side validation.
- Complete integration testing.
- Deploy the application.
- Configure the production database.
- Document test accounts.
- Provide the live application URL.
- Complete the final README and documentation.

## 14. Security and Git Configuration

The project includes a `.gitignore` file to prevent sensitive and unnecessary files from being committed.

Ignored files include:

- Environment files containing secrets
- Private PHP configuration files
- Dependency directories
- Runtime logs
- Temporary files
- Local editor configuration

Empty backend folders are preserved using `.gitkeep` files.

Real database credentials and JWT secrets must not be committed to GitHub.

## 15. AI Usage

ChatGPT was used as a development assistant during Milestone 1.

AI assistance included:

- Project structure planning
- SPA navigation
- Bootstrap page development
- Database ERD planning
- Documentation
- Debugging and troubleshooting

AI-generated suggestions were reviewed and tested during development.

Identified AI issues and corrections are documented in:

[AI Usage Log](docs/AI_LOG.md)

Development guidelines are documented in:

[AGENTS.md](AGENTS.md)

## 16. Author

**Lejla Morankic**  
International Burch University  
Web Programming – Semester Project

---

**Project Status:** Milestone 1 implementation prepared locally. GitHub submission and Pull Request verification pending.
