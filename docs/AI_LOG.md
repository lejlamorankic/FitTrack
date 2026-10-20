# AI Usage Log – FitTrack

## Project Information

**Project:** FitTrack – Fitness Tracking Web Application  
**Course:** Web Programming  
**University:** International Burch University  
**Milestone:** Milestone 1  
**AI Tool:** ChatGPT

## 1. Purpose of AI Usage

ChatGPT was used as a development assistant during Milestone 1 of the FitTrack project.

AI assistance included:

- Planning the frontend and backend folder structure.
- Implementing Single Page Application (SPA) navigation.
- Creating responsive Bootstrap page layouts.
- Designing the initial database schema and ERD.
- Preparing project documentation.
- Explaining Git commands and troubleshooting development issues.

All AI-generated suggestions were reviewed and tested during development.

## 2. AI-Assisted Development

### Example 1 – SPA Navigation

**Task:** Implement navigation between frontend pages without full page reloads.

**AI Assistance:** ChatGPT suggested using JavaScript, URL hashes, and the Fetch API to dynamically load HTML views.

**Implementation:** A `spa.js` file was created to load individual HTML templates from `frontend/views/` into the main application container.

**Verification:** All nine application pages were opened successfully through SPA navigation. The sidebar and main layout remained in place while the page content changed.

### Example 2 – Frontend Development

**Task:** Create a static frontend customized for a fitness tracking application.

**AI Assistance:** ChatGPT generated Bootstrap layouts for the Dashboard, Exercises, Workouts, Meals, Hydration, Progress, Profile, Login, and Register pages.

**Implementation:** The page templates were placed in `frontend/views/` and connected through the SPA navigation system.

**Verification:** All nine pages were tested in the browser. Mobile navigation was also tested using Microsoft Edge Developer Tools at a viewport width of 400 pixels. The sidebar could be opened and closed successfully.

### Example 3 – Database Planning

**Task:** Design a relational database containing at least five entities.

**AI Assistance:** ChatGPT suggested six entities and their relationships.

**Implementation:** A Mermaid Entity-Relationship Diagram was created in `docs/erd.md`.

The six entities are:

1. users
2. exercises
3. workouts
4. meals
5. hydration_entries
6. progress_entries

**Verification:** The diagram was rendered successfully in VS Code Markdown Preview. All six entities, their primary keys, foreign keys, and five relationships were visible.

## 3. Important AI Prompts

The following are representative prompts used during development:

**Prompt 1 – Project Structure**

"Help me organize the FitTrack project into frontend and backend folders according to the Milestone 1 requirements."

**Prompt 2 – SPA Navigation**

"Create a Single Page Application using JavaScript so that navigation between HTML pages works without reloading the entire application."

**Prompt 3 – Frontend Pages**

"Create Bootstrap pages for exercises, workouts, meals, hydration, progress, profile, login, and registration."

**Prompt 4 – Database Design**

"Create an ERD for FitTrack with at least five related database entities, including primary and foreign keys."

**Prompt 5 – Project Verification**

"Check the Milestone 1 requirements one by one and help me verify that nothing is missing."

These prompts summarize the development requests rather than reproduce every conversation message verbatim.

## 4. AI Mistakes and Corrections

### Issue 1 – Incorrect Live Server URL Assumption

**AI suggestion:**

ChatGPT initially provided a Live Server URL without accounting for the actual workspace root.

**Problem:**

The suggested URL did not match the path used by the local Live Server setup. The application could not initially be opened through that address.

**How it was detected:**

The browser displayed a connection error during testing. The local server setup and browser URL were then checked.

**Correction:**

Live Server was started using VS Code, and the correct application URL was identified:

`http://127.0.0.1:5500/FitTrack/frontend/index.html#dashboard`

**Result:**

The Dashboard loaded successfully, and SPA navigation was subsequently tested.

### Issue 2 – Incomplete .gitignore Rule for the Logs Folder

**AI suggestion:**

An earlier `.gitignore` configuration included the following rule:

`backend/logs/`

**Problem:**

This rule ignored the entire logs directory, including the `.gitkeep` file intended to preserve the folder structure in Git.

**How it was detected:**

The `.gitignore` configuration was reviewed while preparing the required backend folder structure.

**Correction:**

The rule was replaced with:

```gitignore
backend/logs/*
!backend/logs/.gitkeep
*.log
```

A `.gitkeep` file was added to the logs directory.

**Result:**

The revised configuration was checked using:

`git check-ignore -v backend/logs/.gitkeep`

The command showed that the `.gitkeep` exception rule was being applied. The file still needs to be included in the final Git commit.

## 5. Student Responsibilities

The student is responsible for:

- Reviewing and understanding AI-generated code.
- Testing the application in the browser.
- Identifying and correcting unsuitable AI suggestions.
- Verifying that project requirements are satisfied.
- Keeping the AI usage documentation accurate.
- Preventing sensitive information from being committed.
- Submitting the project through the required GitHub workflow.

## 6. Milestone 1 Status

- Project folder structure: verified locally.
- Backend folders: created with `.gitkeep` files.
- Frontend SPA navigation: tested.
- Nine frontend pages: tested for navigation.
- Mobile sidebar navigation: tested.
- Database ERD: created and rendered successfully.
- README draft: prepared.
- AGENTS.md: prepared.
- AI usage documentation: updated.
- Git commit and push: pending.
- New Pull Request: pending.

## 7. Conclusion

AI assistance supported the initial development of FitTrack, particularly frontend implementation, database planning, documentation, and debugging.

The identified issues demonstrate why AI-generated instructions must be reviewed and tested rather than accepted without verification.

Milestone 1 implementation has been prepared locally. Final submission requires committing the project changes and opening the required GitHub Pull Request.