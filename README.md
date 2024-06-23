# ICT HelpDesk Application

## Introduction

The **ICT HelpDesk Application** is a web-based solution designed to facilitate the management of technical issues within an organization. It provides a platform for clients to report issues and for HelpDesk officers to manage, assign, and resolve these issues effectively.

## Features

- **User Authentication**: Secure login and registration for clients and HelpDesk staff.
- **Role-Based Access Control**: Different functionalities for clients, General HelpDesk Officers, and HelpDesk Officers.
- **Issue Reporting**: Clients can report technical issues they encounter.
- **Issue Assignment**: General HelpDesk Officers can assign reported issues to specific HelpDesk Officers.
- **Issue Management**: HelpDesk Officers can view, manage, and resolve assigned issues.
- **Notifications**: Alerts for issue assignments and updates.

## Technologies Used

- **Backend**: [Laravel](https://laravel.com/)
- **Frontend**: [Blade](https://laravel.com/docs/blade), [Tailwind CSS](https://tailwindcss.com/)
- **Authentication**: [Laravel Breeze](https://laravel.com/docs/breeze)

## Getting Started

### Prerequisites

Ensure you have the following installed:

- [PHP](https://www.php.net/) >= 8.1
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) and [npm](https://www.npmjs.com/)
- [MySQL](https://www.mysql.com/) or other compatible database

### Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/ict-helpdesk.git
   cd ict-helpdesk
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Copy .env.example to .env**:
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Configure Database**:

   Update `.env` with your database credentials:
   ```plaintext
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ict_helpdesk
   DB_USERNAME=root
   DB_PASSWORD=yourpassword
   ```

6. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

7. **Install Tailwind CSS**:
   ```bash
   npm run dev
   ```

8. **Start the Development Server**:
   ```bash
   php artisan serve
   ```

9. **Access the Application**:

   Open your browser and navigate to `http://localhost:8000`.

### Usage

1. **Register Users**:

   - **Client**: Sign up through the registration form.
   - **General HelpDesk Officer & HelpDesk Officers**: Create their accounts via the registration form and update their roles in the database.

2. **Reporting Issues**:

   - Clients can log in and submit a new issue via the “Report Issue” form.

3. **Assigning Issues**:

   - General HelpDesk Officers can log in and assign pending issues to HelpDesk Officers.

4. **Managing Issues**:

   - HelpDesk Officers can view their assigned issues, update their status, and mark them as resolved.

### File Structure

- **`app/Models`**: Models such as `User`, `Issue`, and `Assignment`.
- **`app/Http/Controllers`**: Controllers like `IssueController`, `AssignmentController`.
- **`resources/views`**: Blade templates for the UI.
- **`database/migrations`**: Migration files for database schema.
- **`routes/web.php`**: Web routes for the application.

### Deployment

To deploy the application, follow standard Laravel deployment practices:

1. **Server Setup**: Configure a web server (e.g., Apache, Nginx) and set up the environment.
2. **Database Migration**: Run migrations on the production database.
3. **Optimize**: Run optimization commands:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
4. **Build Assets**:
   ```bash
   npm run production
   ```

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request.

1. Fork the repository
2. Create a new branch (`git checkout -b feature-branch`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature-branch`)
5. Create a new Pull Request

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Acknowledgements

- [Laravel](https://laravel.com/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Laravel Breeze](https://laravel.com/docs/breeze)

## Contact

For any inquiries or issues, please contact [tituskiptanuitum@gmail.com](mailto:tituskiptanuitum@gmail.com).
