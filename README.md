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



CHANGELOG

04/29
@ 1300 - Creating ResidentsController
@ 1314 - Finished ResidentsController V1
@ 1319 - Starting to create blades for simple views for residents
@ 1324 - Created create,edit,index blades and added routes for residents // FIRST TEST FOR RESIDENTS
@ 1335 - Editing create blade and adding dummy values for household, current address, familyrole. Still testing
@ 1344 - Still testing, adding NATIONALITY and RELIGION to residents. Fixing CREATE BLADE.
@ 1355 - Testing still for BLADE. Not saving?
@ 1415 - Saved RESIDENT sucessfully, fixed INDEX, trying to fix now EDIT
@ 1425 - Committed to repository, fixed EDIT and DELETE, will now try to add controller for HOUSEHOLD
@ 1435 - Currently editing HOUSECONTROLLER, added it into routes.
@ 1445 - Still editing HOUSEHOLDCONTROLLER, will now commit this.

@ 1505 - Done editing HOUSEHOLDCONTROLLER, trying to create INDEX BLADE.
@ 1515 - Done creating INDEX BLADE for household and updated LAYOUT for navbar. Editing now edit blade
@ 1525 - Done editing EDIT BLADE, will now try to create CREATE BLADE.

05/05
@ 1527 - Doing FAMILYROLE CONTROLLER
@ 1545 - Done doing CONTROLLER now making INDEX BLADE
@ 1600 - Done index now doing EDIT and CREATE BLADE also edited familyRole into enum since it's limited (needs more thought)
@ 1615 - Testing things. Returned role to STRING since it's the HEAD, etc.
@ 1630 - Finishing BARANGAYPOSITION CONTROLLER
@ 1635 - Doing INDEX BLADE now will continue later

05/06
@ 0520 - Continuing the BLADEs now 
@ 0542 - Finished creating blades and BarangayPositions moving on to barangayEmployees
