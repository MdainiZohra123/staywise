# StayWise

A hotel booking platform inspired by Agoda that helps travelers find and compare hotels based on price, location, and comfort.

## The Problem

- **Too many choices**: Overwhelming number of hotel options across different platforms
- **Multiple booking platforms**: Users must check multiple websites to compare
- **Price inconsistency**: Hotels display different prices on booking platforms vs. their own websites
- **Hidden costs**: Final prices differ from initial quotes, creating confusion and frustration

## Our Solution

- **Single unified platform**: Wide variety of hotels in one place for easy comparison
- **Simple and intuitive**: User-friendly interface designed for ease of use
- **Transparent pricing**: Final price displayed upfront—no hidden fees or price changes
- **Smart recommendations**: Platform suggests the best hotels based on your preferences (price, ratings, comfort, location)

## Technology Stack

### Back-End
- **PHP**: Server-side scripting
- **MySQL**: Database management
- **SQL**: Data queries and management

### Front-End
- **HTML**: Page structure
- **CSS**: Styling and responsive design
- **JavaScript**: Interactive features and client-side logic
- **React.JS**: Dynamic UI components (optional)

## Getting Started

### Prerequisites
- PHP 7.0+
- MySQL 5.7+
- Web server (Apache, Nginx, or PHP built-in server)

### Installation

1. Clone the repository:
```bash
git clone https://github.com/MdainiZohra123/staywise.git
cd staywise
```

2. Set up the database:
   - Create a MySQL database named `staywise`
   - Import the database schema (tables for `users`, `contact`, `comments`, `searches`)

3. Configure database connection:
   - Update connection details in PHP files (currently set to `localhost:root` with no password)

4. Start the server:
```bash
php -S localhost:8000
```

5. Open your browser and navigate to:
```
http://localhost:8000/home.html
```

## Features

- **User Authentication**: Secure login and signup with role-based access (user/admin)
- **Hotel Search**: Filter hotels by city, price range, and ratings
- **Hotel Listings**: View detailed hotel information with images and reviews
- **Comments & Ratings**: Users can leave reviews and rate hotels
- **Admin Dashboard**: Manage users, messages, and monitor search history
- **Contact Form**: Users can send inquiries and feedback

## Project Structure

```
home.html              - Landing page with hotel gallery and search
login.html             - User login form
signup.html            - User registration form
travel.html            - Hotel listings and search results page
admin.html             - Admin dashboard
contact.html           - Contact form page

staywise login.php     - Login authentication backend
staywise signup.php    - User registration processing
staywise admin.php     - Admin dashboard with analytics
staywise contact.php   - Contact form submission handler
staywice travel.php    - Hotel search and listings backend
```

## Database Schema

The application uses the following main tables:
- **users**: Stores user account information and credentials
- **contact**: Stores contact form submissions
- **comments**: Stores hotel reviews and ratings
- **searches**: Logs user search history

## Security Features

- Password hashing with `password_verify()` for secure authentication
- Prepared statements to prevent SQL injection
- Email validation for user input
- Session-based user management
- Role-based access control (admin/user)

## License

This project is open source and available for personal and educational use.

## Author

Created by MdainiZohra123

---

**Note**: This project is a learning/portfolio project inspired by Agoda's booking platform design. It demonstrates hotel management, user authentication, and admin dashboard functionality.
