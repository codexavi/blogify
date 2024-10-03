
### README.md:

# Laravel Blog & Admin Dashboard

This is a Laravel project that includes a **Blog System** with an **Admin Dashboard** functionality. It allows users to create, view, and manage blog posts, and provides admins with additional control to manage users and posts.

## Features

- **Authentication** system with role-based access (Admin and Regular User).
- **Blog Post Management** (Create, Edit, Delete, Restore).
- **Admin Dashboard** to manage users and posts.
- Soft Delete and Restore features for posts.
- Comments CRUD with user authorization.
- **Social Media Authentication** (Google, Facebook).

## Requirements

- PHP >= 8.1
- Composer
- MySQL (or any supported database)
- Node.js & NPM (for frontend assets)
- Laravel >= 11.x
- Google API and Facebook API credentials

## Installation Guide

Follow these steps to set up the project:

### Step 1: Clone the Repository

```bash
git clone https://github.com/your-username/laravel-blog-admin-dashboard.git
cd laravel-blog-admin-dashboard
```

### Step 2: Install Composer Dependencies

```bash
composer install
```

### Step 3: Install NPM Dependencies

```bash
npm install
npm run dev
```

### Step 4: Set Up the `.env` File

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials and API keys:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Google and Facebook API tokens
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URL=http://127.0.0.1:8000/auth/google/callback

FACEBOOK_CLIENT_ID=your-facebook-client-id
FACEBOOK_CLIENT_SECRET=your-facebook-client-secret
FACEBOOK_REDIRECT_URL=http://127.0.0.1:8000/auth/facebook/callback
```

### Step 5: Generate Application Key

Generate the Laravel application key:

```bash
php artisan key:generate
```

### Step 6: Run Migrations

Run the database migrations to create the necessary tables:

```bash
php artisan migrate
```

### Step 7: Seed the Database

Seed the database with default **admin** and **regular user** credentials:

```bash
php artisan db:seed
```

This will create the following users:

- **Admin User**
  - Email: `admin@example.com`
  - Password: `password`

- **Regular User**
  - Email: `user@example.com`
  - Password: `password`

### Step 8: Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

Visit the application at `http://127.0.0.1:8000`.

### Step 9: Default Login Credentials

You can log in using the following default credentials:

- **Admin User**:
  - Email: `admin@example.com`
  - Password: `password`

- **Regular User**:
  - Email: `user@example.com`
  - Password: `password`

### Step 10: Access Admin Dashboard

Only admins have access to the **Admin Dashboard** where they can manage posts and users.

- **Admin Dashboard**: `/admin/dashboard`

### Step 11: Set Up Google and Facebook Authentication

To enable **Google** and **Facebook** logins, you must set up OAuth credentials:

#### Google OAuth:
1. Visit the [Google Developer Console](https://console.cloud.google.com/).
2. Create a new project and enable the **Google+ API**.
3. Generate your **OAuth 2.0 Client IDs** and set the redirect URL to:
   ```
   http://127.0.0.1:8000/auth/google/callback
   ```
4. Add your **Google Client ID** and **Client Secret** to the `.env` file.

#### Facebook OAuth:
1. Visit the [Facebook Developer Console](https://developers.facebook.com/).
2. Create a new app and enable **Facebook Login**.
3. Set the redirect URL to:
   ```
   http://127.0.0.1:8000/auth/facebook/callback
   ```
4. Add your **Facebook App ID** and **App Secret** to the `.env` file.

## Additional Commands

### Rebuild Frontend Assets

If you modify any of the frontend files, you may need to rebuild the assets:

```bash
npm run dev
```

For production, run:

```bash
npm run prod
```

### Run Tests

To run tests, you can use the following command:

```bash
php artisan test
```

### Important Notes:
- You need to replace the placeholders (`your-google-client-id`, `your-google-client-secret`, `your-facebook-client-id`, `your-facebook-client-secret`) with the actual **Google** and **Facebook** API credentials that you obtain from their respective developer consoles.
- The **Google** and **Facebook** login routes and callback URLs are configured in the `.env` file.

To include Google and Facebook login credentials (API tokens) in your **README.md**, you will need to update the `.env` file with your respective OAuth credentials. Here’s an updated version of the **README.md** including steps for setting up **Google** and **Facebook** login tokens.

Let me know if you need any further customization or clarification!