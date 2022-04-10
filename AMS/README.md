
//This is a Test Application described as Appointment Management System

This app is having three user types: admin, doctor, patient

The operations for each usertype is limited

Users/admin/doctor can create appointments (Also the availability of the doctor for the selected timeslot is checked on the front end itself)
only admin can manage users


This app is having the most basic UI and is mostly using the laravel's default ui since it is more focused on the functionality

Some validations like selecting start and end time of the appointment are already implemented


○ Tech stack used, including specific libraries / versions.
    Laravel Framework : 8.75 and other related dependancies (Please refere Composer.json)
    jquery:3.6.0 (CDN IN USE)
    Bootstrap: 4.3.1 (CDN IN USE)
    Mysql Database 5.7 
    php 7.4
    
○ Estimated time to complete your test.
Because of the laravel's in build feautures like authentication this project was developed in minimum time span approximately 3-4 hours.
Authentication and other functionalities are fully functional and can be utilized.


What is pending by your side?
1. Design Ehancementes
2. Edit Functinality for both Appointments and Users
3. Some minor Validations
4. Reusabel code and functions


○ A quick paragraph with how you approached the project, what you liked

 This application is desigend and developed with keeping the end requirements in mind. The architecture is straight forward to meet the requirement. The scalability of this app with respect to both UI design and Backend Functionality is very high. Current implimentation as the most basic one to save time but can be be inhanced over time easily.
 
 
○ Project setup guidelines

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






