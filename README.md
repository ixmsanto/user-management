# User-Management Application

A Laravel-based web application for managing users with role-based access control. Built with Laravel 12.11.1, Livewire, Bootstrap, and Spatie Laravel Permission, this project provides a simple and intuitive interface for creating, editing, and deleting users, with admin and user roles.

## Features
- **User Management**: Create, read, update, and delete (CRUD) users with name, email, password, and role fields.
- **Role-Based Access**: Admins can manage users, while regular users have restricted access.
- **Livewire Interactivity**: Dynamic, real-time form updates without page reloads.
- **Bootstrap Styling**: Responsive and modern UI with Bootstrap 5.
- **Simplified Welcome Page**: Clean landing page with a "Welcome to User-Management Application" message and login/register navigation.

## Prerequisites
- **PHP**: 8.2.28 or higher
- **Composer**: 2.x
- **Node.js**: 16.x or higher (with npm)
- **MySQL**: 8.0 or higher (or another compatible database)
- **Git**: For cloning the repository

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/ixmsanto/user-management.git
   cd user-management
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript/CSS Dependencies**
   ```bash
   npm install
   ```

4. **Set Up Environment**
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update `.env` with your database credentials:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=user_management
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**
   - Run database migrations to create tables (includes Spatie Laravel Permission tables):
     ```bash
     php artisan migrate
     ```

7. **Seed the Database**
   - Seed the database to create roles (`admin`, `user`) and default users:
     - Admin user: `admin@example.com`, password: `password123`, role: `admin`
     - Regular user: `user@example.com`, password: `password123`, role: `user`
   - Run the seeder:
     ```bash
     php artisan db:seed
     ```
   - The `DatabaseSeeder` (`database/seeders/DatabaseSeeder.php`) creates these users and roles automatically.

8. **Compile Assets**
   - Build CSS and JavaScript assets using Vite:
     ```bash
     npm run build
     ```

9. **Start the Development Server**
   ```bash
   php artisan serve
   ```
   - Access the application at `http://127.0.0.1:8000`.

## Usage

1. **Welcome Page**
   - Visit `http://127.0.0.1:8000` to see the welcome page with a "Welcome to User-Management Application" message.
   - Use the navigation to log in, register, or access the dashboard (if authenticated).

2. **User Login**
   - Log in with the seeded users:
     - **Admin**: `admin@example.com`, password: `password123`
     - **Regular User**: `user@example.com`, password: `password123`
   - Alternatively, register a new user at `/register` and assign roles via the admin dashboard.

3. **Admin Dashboard**
   - Access `/admin/users` (requires `admin` role) to manage users.
   - Create, edit, or delete users with name, email, password, and role fields.
   - The interface uses Livewire for real-time updates.

4. **Dashboard**
   - Authenticated users can access `/dashboard` for user-specific features (configure as needed).

## Project Structure
- **`resources/views/welcome.blade.php`**: Simplified landing page with a welcome message and navigation.
- **`resources/views/admin/users.blade.php`**: Admin dashboard for user management, embedding the Livewire component.
- **`resources/views/livewire/user-management.blade.php`**: Livewire component view for user CRUD operations.
- **`app/Livewire/UserManagement.php`**: Livewire component handling user management logic.
- **`app/Models/User.php`**: User model with Spatie Laravel Permission’s `HasRoles` trait.
- **`database/seeders/DatabaseSeeder.php`**: Seeder for creating roles and default users.
- **`resources/sass/app.scss`**: Bootstrap-based styles.
- **`routes/web.php`**: Defines routes for welcome, auth, and admin pages.

## Troubleshooting

1. **"Attempt to read property 'name' on null" Error**
   - Occurs when a user has no roles. Ensure all users have roles:
     ```bash
     php artisan tinker
     $users = App\Models\User::doesntHave('roles')->get();
     foreach ($users as $user) {
         $user->assignRole('user');
     }
     exit
     ```
   - Verify `app/Livewire/UserManagement.php` handles missing roles in the `edit` method:
     ```php
     $this->role = optional($user->roles->first())->name ?? '';
     ```

2. **Assets Not Loading**
   - Rebuild assets:
     ```bash
     npm run build
     ```
   - Verify `public/build/manifest.json` exists and includes `resources/sass/app.scss`.

3. **Sass Deprecation Warnings**
   - Update Bootstrap and migrate Sass imports:
     ```bash
     npm install bootstrap@latest
     npm install -g sass-migrator
     sass-migrator migration --migrate-deps resources/sass/app.scss
     ```

4. **Access Denied to `/admin/users`**
   - Ensure the logged-in user has the `admin` role:
     ```bash
     php artisan tinker
     $user = App\Models\User::find(1);
     $user->assignRole('admin');
     exit
     ```
   - Verify `app/Http/Middleware/RoleMiddleware.php` uses Spatie’s `hasAnyRole`:
     ```php
     if (auth()->check() && auth()->user()->hasAnyRole($roles)) {
         return $next($request);
     }
     ```

5. **Livewire Errors**
   - Ensure Livewire is up-to-date:
     ```bash
     composer update livewire/livewire
     ```
   - Clear caches:
     ```bash
     php artisan cache:clear
     php artisan view:clear
     ```

## Dependencies
- **Laravel**: 12.11.1
- **PHP**: 8.2.28
- **Livewire**: 3.x
- **Spatie Laravel Permission**: For role-based access
- **Bootstrap**: 5.x (via `resources/sass/app.scss`)
- **Vite**: For asset compilation
- **Instrument Sans**: Font from Bunny Fonts

## Contributing
Feel free to submit issues or pull requests to improve the application. Ensure you test changes locally and follow Laravel coding standards.

## License
This project is open-source and licensed under the [MIT License](https://opensource.org/licenses/MIT).
