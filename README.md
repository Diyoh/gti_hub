# GTI-Hub (Global Talent & Innovation Hub)

GTI-Hub is a professional networking and project-management platform designed for Innovators. It allows students to move beyond static pages and create a "living" digital identity where they can submit projects, track technical skills, and interact with a backend server.

## Project Structure

- `nexus.php`: The main dashboard (Home).
- `sprints.php`: Interaction layer for launching new innovation sprints.
- `vault.php`: Persistence layer showing all archived projects.
- `db.php`: Secure PDO database connection.
- `process-sprint.php`: Backend logic for form handling and data persistence.
- `header.php` / `footer.php`: Reusable UI components.

## Setup Instructions

1. **Database**: Import the provided `setup.sql` file into your MySQL server (via phpMyAdmin or CLI).
2. **Environment**: Ensure you are running a PHP-enabled server (like XAMPP).
3. **Configuration**: Update `db.php` with your local database credentials if they differ from the defaults.
4. **Access**: Navigate to `http://localhost/gti-hub/nexus.php` to begin.

## Core Technologies
- PHP (Server-Side Logic)
- MySQL (Relational Database)
- HTML5 & CSS3 (Structure & Styling)
- PDO (Security & Persistence)
