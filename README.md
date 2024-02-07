# BATU University Management System

## Project Overview

This project contains the backend and frontend components for the BATU University Management System. The backend is developed using Laravel and MySQL, while the frontend is built with Vue.js and Tailwind CSS.

### Project Structure

- **back-end:** Laravel backend, handling API routes and database operations.
- **front-end:** Vue.js frontend, responsible for the user interface.

## Git Workflow

### Clone the Repository

```bash
git clone https://github.com/Ziad-Abaza/BATU-LARAVEL-VUE.git
```

### Navigate to the Project

```bash
cd BATU-LARAVEL-VUE
```

### Backend Setup

1. **Install Laravel Dependencies:**

   ```bash
   cd back-end
   composer install
   ```

2. **Copy the .env File:**

   ```bash
   cp .env.example .env
   ```

3. **Generate Laravel Key:**

   ```bash
   php artisan key:generate
   ```

4. **Configure the Database:**

   - Open the `.env` file and update the database connection settings.

5. **Run Migrations and Seed:**

   ```bash
   php artisan migrate --seed
   ```

6. **Start Laravel Development Server:**

   ```bash
   php artisan serve
   ```

   The backend API will be accessible at `http://127.0.0.1:8000`.

### Frontend Setup

1. **Install Vue.js Dependencies:**

   ```bash
   cd front-end
   npm install
   ```

2. **Start Vue Development Server:**

   ```bash
   npm run serve
   ```

   The frontend will be accessible at `http://localhost:5173`.

### Git Workflow

#### Branches

- **main:** Represents the stable version of the project.
- **feature/{feature-name}:** Used for developing new features.
- **bugfix/{bug-name}:** Used for fixing bugs.

#### Typical Workflow

1. **Pull the Latest Changes:**

   ```bash
   git pull origin main
   ```

2. **Create a New Branch:**

   ```bash
   git checkout -b feature/new-feature
   ```

3. **Make Changes and Commit:**

   ```bash
   git add .
   git commit -m "Add new feature"
   ```

4. **Push Changes to Remote:**

   ```bash
   git push origin feature/new-feature
   ```

5. **Open a Pull Request:**

   - Open a pull request on GitHub for code review.

6. **Merge Changes to main:**

   - After the code review, merge the changes to the main branch.

### Collaboration

- **Create Issues:**
  - Use GitHub Issues to report bugs or suggest new features.

- **Collaborate in Teams:**
  - Create feature branches for specific tasks.

- **Code Review:**
  - Perform code reviews on pull requests.

- **Documentation:**
  - Keep the README.md and code comments updated.

Feel free to contribute and make this project better! 🚀
