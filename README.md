# student_management

🎓 Student Management System — CRUD App with Laravel 10

A simple and clean Student Management System built using Laravel 10 + MySQL, allowing users to register, view, edit, and delete student information with image upload support.

✨ Features

•	🧾 Register new students

•	🖊️ Edit and update student information

•	🗑️ Delete student records

•	📷 Upload and display student image

•	📊 View all student data in table format

•	🎨 UI styled with Bootstrap (responsive)
________________________________________
🛠️ Tech Stack

•	Laravel 10 (Backend)

•	MySQL (Database)

•	Blade + Bootstrap 5 (Frontend)

•	HTML5/CSS3/Javascript

📋 Table Structure: students

Field	              Type	                Description

id	                bigint (auto)	        Primary Key

stu_name    	      varchar(255)	        Student Name

gender	            varchar(255)	        Gender

age	                varchar(255)	        Age

major	              varchar(50)	          Major

major_price	        decimal(8,2)        	Tuition Fee

enrollment_date	    date	                Enrollment Date

phone	              varchar(255)	        Phone Number

address            	varchar(255)	        Address

image	              varchar(255)	        Student Image Filename

created_at	        timestamp	            Created Time

updated_at	        timestamp	            Updated Time

🚀 How to Install and Run Locally

# 1. Clone this repo

git clone https://github.com/sansen168/student_management.git

# 2. Go to the project folder
cd student_management

# 3. Install PHP dependencies
composer install

# 4. create folder image 
php artisan storage:link

# 5. Copy .env and set up DB

cp .env.example .env

php artisan key:generate

# 7. Create database & migrate
php artisan migrate

# 8. Serve the app
php artisan serve

