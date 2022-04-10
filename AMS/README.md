
//This is a Test Application described as Appointment Management System

This app is having three user types: admin, doctor, patient

The operations for each usertype is limited

Users/admin/doctor can create appointments (Also the availability of the doctor for the selected timeslot is checked on the front end itself)
only admin can manage users


THis app is having the most basic UI and is mostly using the laravel's default ui since it is more focused on the functionality

Steps for Installation

1. Cone this repository // Open the terminal and follow the further steps
2. cd ams
3. composer install
4. npm install && npm run dev
5. cp .env.example .env
6. Set Database credentials into your .env file

    You can use the ams.sql File to import into your database it already contains a admin User:
    
    email : admin@admin.com
    password: admin123

    OR

    You can use the command
    1. php artisan migrate
    2. php artisan db:seed

Please clear the cache if required

7. php artisan config:clear
8. php artisan cache:clear

To run the application

php artisan serve


