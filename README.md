# To-Do List Application

A simple To-Do List app using Laravel

## Features

### User Authentication
- Secure login system with email and password
- Session management with logout functionality
- User-specific task isolation

### Task Management
- Create new tasks with title, description, status, and due date
- Edit existing tasks with pre-filled form data
- Delete tasks with confirmation dialog
- View all tasks in a clean, organized table

### Advanced Filtering and Sorting
- Filter tasks by status (To-Do, In Progress, Done, or All)
- Sort tasks by creation date, due date, or title
- Choose ascending or descending order
- Auto-apply filters for seamless user experience

### Task Status Management
- Three status types: To-Do, In Progress, Done
- Color-coded status badges for easy identification
- Status updates through edit form

### Due Date Features
- Optional due date setting for tasks
- Visual indicators for overdue tasks (red highlight)
- Due soon warnings (orange highlight for tasks due within 3 days)
- Smart date sorting with null dates placed at the end

## Technology Stack

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates with Vite
- **Styling**: Tailwind CSS 4.x with shadcn/ui components
- **JavaScript**: Vanilla JavaScript for interactive features
- **Database**: MySQL
- **Authentication**: Laravel's built-in authentication

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18.x or higher
- npm or yarn

## Installation and Setup

### Step 1: Clone the Repository

```bash
git clone <repository-url>
cd indoplat-todolist
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Install Node.js Dependencies

```bash
npm install
```

### Step 4: Environment Configuration

```bash
# Copy the environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 5: Database Setup

Edit the `.env` file and configure your database settings. For SQLite (default):

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

For MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todolist
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Create the database file (for SQLite):

```bash
touch database/database.sqlite
```

### Step 6: Run Database Migrations

```bash
php artisan migrate
```

### Step 7: Build Frontend Assets

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

### Step 8: Running Seeder For Initial User

```bash
php artisan db:seed
```

### Step 9: Start the Application

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## How to Use the Application

### Initial Setup

1. **Access the Application**: Open your browser and go to `http://localhost:8000`

2. **Login**: Navigate to `/login` and enter your credentials
   - Email: admin@indoplat.co.id
   - Password: indoplat123