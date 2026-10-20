
# FitTrack - Entity Relationship Diagram

## Database Overview

FitTrack uses a relational database with six main entities:
users, exercises, workouts, meals, hydration_entries,
and progress_entries.

## ER Diagram

```mermaid
erDiagram
    USERS ||--o{ WORKOUTS : logs
    USERS ||--o{ MEALS : records
    USERS ||--o{ HYDRATION_ENTRIES : tracks
    USERS ||--o{ PROGRESS_ENTRIES : records
    EXERCISES ||--o{ WORKOUTS : used_in

    USERS {
        int id PK
        varchar full_name
        varchar email UK
        varchar password_hash
        varchar role
        datetime created_at
    }

    EXERCISES {
        int id PK
        varchar name
        varchar muscle_group
        varchar difficulty
    }

    WORKOUTS {
        int id PK
        int user_id FK
        int exercise_id FK
        date workout_date
        int sets
        int reps
        int duration_minutes
    }

    MEALS {
        int id PK
        int user_id FK
        varchar name
        varchar meal_type
        int calories
        decimal protein
        date meal_date
    }

    HYDRATION_ENTRIES {
        int id PK
        int user_id FK
        int amount_ml
        datetime logged_at
    }

    PROGRESS_ENTRIES {
        int id PK
        int user_id FK
        decimal weight_kg
        text notes
        datetime recorded_at
    }
```

## Relationships

1. One user can log multiple workouts.
2. One user can record multiple meals.
3. One user can track multiple hydration entries.
4. One user can record multiple progress entries.
5. One exercise can appear in multiple workout records.

## Primary Keys

Each entity has an `id` column as its primary key.

## Foreign Keys

- `workouts.user_id` references `users.id`
- `workouts.exercise_id` references `exercises.id`
- `meals.user_id` references `users.id`
- `hydration_entries.user_id` references `users.id`
- `progress_entries.user_id` references `users.id`

## Notes

This is the initial database design for Milestone 1.

The database will be implemented using MySQL in
Milestone 2. Foreign key constraints will ensure
referential integrity between related tables.
