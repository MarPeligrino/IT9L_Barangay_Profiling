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

05/07

@ 0958 - Working now to continue BARANGAYEMPLOYEECONTROLLER
@ 1055 - Finishing up EMPLOYEE BLADES
@ 1110 - Fixing EMPLOYEE BLADES while testing
@ 1125 - Done fixing EMPLOYEES controller and BLADES now doing BUSINESS
@ 1155 - Updating database for ADDRESS, will have to edit the rest involved on that database.
@ 1219 - Still updating the database for ADDRESS, trying to fix the rest
@ 1247 - Still fixing the rest, now trying to fix HOUSEHOLD CONTROLLER after doing the BLADES
@ 1304 - Done with the HOUSEHOLDS everything fix, completed BUSINESS CONTROLLER now creating BLADES
@ 1329 - FInishing up with the blades Done with index blades
@ 1345 - Done with all the blades, will now add routes and then test
@ 1350 - Still needs testing and edit seeders for familyroles so I can add head and then need data for businessType as well. Will now commit and push changes
@ 2200 - Will now continue with editing
@ 2223 - Done with blades and creating blades and testing now moving on to CURRENTADDRESSCONTROLLER 
@ 2238 - omfg I have to edit household table to generalized address table and somehow link it to residents and permit to normalize, I will commit this first to a seaprate branch just in case I want to go back

05/08

@ 0916 - Working now to change HOUSEHOLD to ADDRESSES
@ 0931 - ALready edited HOUSEHOL and RESIDENT now moving on to model for ADDRESS and controller (deleted anything related to currentAdrress)
@ 1001 - Creating not CONTROLLERS for ADDRESS
@ 1016 - Still fixing things around for ADDRESS
@ 1031 - Im still FUCKING FIXING THIS SHIT
@ 1101 - I think I'm almost done fixing JUST cleaning up a few things like the residents getting an error when added
@ 1116 - Fixed RESIDENT and ADDRESSES everything. I think it's just BUSINESS now that I need fixed
@ 1131 - Almost done fixing BUSINESS, just testing blades now
@ 1146 - Very much almost done with testing just a little bit more and can move on to next
@ 1216 - DONE with BUSINESS everything and BUSINESSTYPES everything, trying to TEST now
@ 1246 - Doing the PERMIT TRANSACTIONS TABLE
@ 1258 - Finished CONTROLLER havent tested yet need to create BLADES then ROUTE then TEST. Will commit changes now and continue later.

05/09

@ 1118 - FOCUS ON CONTROLLERS EVERYTHING TESTING LATER USING CHATGPT
@ 1151 - Raw dogging the controller now on INCIDENT PARTY CONTROLLER
@ 1158 - Done INCIDENT PARTY CONTROLLER 
@ 1226 - Done WITH COMPLAINT AND COMPLAINT PARTY Now creating CERT TYPES fixing models first
@ 1252 - Finished ALL CONTROLLERS havent tested anything yet WILL HAVE TO USE main, will commit now and push changes on separate branch

//THINGS TO EDIT 
- Notification bar which updates along with recent activity
- Add charts for residents (age, sex) distribution

05/12

@ 1656 - Will now continue to work on completing the UI

//Things to EDIT

- Will need to change address search bar add address button
- Will need to move address address from residents index to the left so modified and created on the right

php artisan storage:link
npm run dev