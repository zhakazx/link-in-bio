# Link-in-Bio Lite

Aplikasi yang dibuat untuk menyelesaikan tugas besar mata kuliah Pemrograman Web.

## Features

- ✅ User Registration & Authentication
- ✅ Profile Management (name, bio, avatar)
- ✅ Link Management (add, edit, delete)
- ✅ Public Profile Pages
- ✅ Account Settings (change password, delete account)
- ✅ Session & Cookie-based Authentication

## Tech Stack

- PHP Native (MVC Pattern)
- MySQL Database
- PDO for database operations
- HTML/CSS for frontend
- Password hashing with bcrypt

## Project Structure

```
link-in-bio/
├── config/
│   └── database.php          # Database configuration
├── controllers/
│   ├── AuthController.php    # Authentication logic
│   ├── DashboardController.php # Dashboard & profile management
│   ├── LinkController.php    # Link CRUD operations
│   └── ProfileController.php # Public profile display
├── models/
│   ├── User.php             # User model
│   └── Link.php             # Link model
├── views/
│   ├── login.php            # Login page
│   ├── register.php         # Registration page
│   ├── dashboard.php        # User dashboard
│   ├── edit-profile.php     # Profile editor
│   ├── account.php          # Account settings
│   └── profile.php          # Public profile
├── public/
│   ├── assets/
│   │   ├── style.css        # Styles
│   │   └── script.js        # JavaScript
│   ├── uploads/             # User uploaded files
│   └── .htaccess            # URL rewriting rules
├── index.php                # Application entry point & router

```

## Usage

### 1. Register an Account
- Go to `/register`
- Fill in your name, username, email, and password
- Username will be your public URL slug

### 2. Login
- Go to `/login` or `/`
- Enter your email and password
- Check "Remember me" to stay logged in

### 3. Add Links
- After login, you'll see the dashboard
- Use the "Configure New Link" form to add links
- Each link needs a title and valid URL

### 4. Edit Profile
- Click "PROFILE" in the navigation
- Upload a profile photo
- Update your name and bio

### 5. Share Your Profile
- Your public profile URL: `/u/your-username`
- Click "OPEN PUBLIC VIEW" from dashboard
- Share this link with others

### 6. Account Settings
- Change password
- Delete account (permanent action)

## Routes

| Route | Method | Description |
|-------|--------|-------------|
| `/` or `/login` | GET/POST | Login page |
| `/register` | GET/POST | Registration page |
| `/logout` | GET | Logout user |
| `/dashboard` | GET | User dashboard |
| `/edit-profile` | GET/POST | Edit profile |
| `/account` | GET | Account settings |
| `/change-password` | POST | Change password |
| `/delete-account` | POST | Delete account |
| `/link/create` | POST | Create new link |
| `/link/update` | POST | Update link |
| `/link/delete` | POST | Delete link |
| `/u/{username}` | GET | Public profile |
|-------|--------|-------------|