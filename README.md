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

### Step 8: Start the Application

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## How to Use the Application

### Initial Setup

1. **Access the Application**: Open your browser and go to `http://localhost:8000`

2. **Login**: Navigate to `/login` and enter your credentials
   - Email: Use any valid email format
   - Password: Enter your password
   - If you don't have an account, contact the administrator

### Managing Tasks

#### Creating a New Task

1. From the main dashboard, click the "Tambah Tugas" button
2. Fill in the task form:
   - **Judul Tugas** (required): Enter a descriptive title
   - **Deskripsi** (optional): Add detailed description
   - **Status** (optional): Choose from To-Do, In Progress, or Done
   - **Batas Waktu** (optional): Set a due date
3. Click "Simpan Tugas" to create the task
4. You'll be redirected to the task list with a success message

#### Viewing Tasks

1. The main dashboard shows all your tasks in a table format
2. Each task displays:
   - Title and description
   - Color-coded status badge
   - Due date with visual indicators
   - Action buttons for edit and delete

#### Filtering Tasks

1. Use the filter section at the top of the task list
2. **Status Filter**: Select "Semua Status" or specific status
3. **Sort Options**: Choose sorting criteria (creation date, due date, title)
4. **Sort Direction**: Select ascending or descending order
5. Filters apply automatically when changed
6. Click "Reset" to clear all filters

#### Editing Tasks

1. Click the pencil icon next to any task
2. The edit form will open with current values pre-filled
3. Modify any fields as needed
4. Click "Simpan Perubahan" to save changes
5. Click "Batal" to return without saving

#### Deleting Tasks

1. Click the trash icon next to any task
2. Confirm the deletion in the dialog that appears
3. The task will be permanently removed

### Navigation

- **Back Button**: Available on create and edit pages to return to task list
- **Logout**: Click the logout button in the header to end your session
- **Breadcrumb Navigation**: Clear navigation paths throughout the app

## Development

### File Structure

```
indoplat-todolist/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php
│   │   └── TaskController.php
│   └── Models/
│       ├── Task.php
│       └── User.php
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   ├── login.js
│   │   └── tasks.js
│   └── views/
│       ├── auth/
│       │   └── login.blade.php
│       └── tasks/
│           ├── index.blade.php
│           ├── create.blade.php
│           └── update.blade.php
├── routes/
│   └── web.php
└── database/
    └── migrations/
```

### Key Components

#### Controllers
- **AuthController**: Handles user authentication (login/logout)
- **TaskController**: Manages CRUD operations for tasks

#### Models
- **Task**: Eloquent model with status constants and date casting
- **User**: Standard Laravel user model

#### Views
- **login.blade.php**: Authentication form with shadcn/ui styling
- **index.blade.php**: Task list with filtering and sorting
- **create.blade.php**: Task creation form
- **update.blade.php**: Task editing form with pre-filled data

#### JavaScript
- **login.js**: Login form interactions and validation
- **tasks.js**: Task management interactions and auto-filtering

### Database Schema

#### Users Table
- id (primary key)
- name
- email (unique)
- password
- timestamps

#### Tasks Table
- id (primary key)
- user_id (foreign key)
- title (required, max 255 characters)
- description (nullable text)
- status (nullable, enum: To-Do, In Progress, Done)
- due_date (nullable date)
- timestamps