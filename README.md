# IT9L Barangay Profiling Laravel Project

This is a Laravel-based web application for barangay profiling, built for IT9L.

=== Setup Instructions ===

1. Clone the Repository
   git clone https://github.com/yourusername/IT9L_Barangay_Profiling.git
   cd IT9L_Barangay_Profiling

2. Install Composer Dependencies
   composer install

3. Copy .env File
   On Windows:
     copy .env.example .env
   On macOS/Linux:
     cp .env.example .env

4. Generate Application Key
   php artisan key:generate

5. Configure .env File
   Edit the `.env` file with your database credentials:

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_db_name
   DB_USERNAME=root
   DB_PASSWORD=your_password

6. Run Migrations
   php artisan migrate

7. (Optional) Seed the Database
   php artisan db:seed

8. (Optional) Install Node Modules and Build Assets
   If you're using Laravel Mix or Vite:
     npm install
     npm run dev

9. Run the Development Server
   php artisan serve

=== Notes ===
- Do NOT commit your `.env` file or `vendor/` folder to GitHub.
- Make sure you have PHP, Composer, MySQL, and Node.js installed.
