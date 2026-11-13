# 📝 Quiz Management System

## 📌 About

This is a web application developed in Laravel and MySQL. This application will allow users to take an online quiz and submit answers. The user will also be able to see their quiz score and see the questions they attempted.

Admin will also have an admin panel to manage users, quiz categories, quizzes, topics and questions.

## 🚀 Features

### 👨‍💼 Admin

Manage Users
Manage Quiz Categories
Create, Update & Delete Quizzes
Manage Quiz Topics
Add, Update & Delete Questions
Manage Question Options
Monitor User Activity
### 👨‍🎓 Users

Register / Login

Email Verification
See Available Quizzes
Take Online Quizzes
Submit Answers to Quizzes
See Results & Scores
See Questions Attempted
## 🛠️ Tech Stack
| Tech | Description |
|---|---|
| HTML | Structure |
| CSS | Styling |
| Bootstrap | Responsive |
| jQuery | DOM Manipulation |
| AJAX | Asynchronous Calls |
| PHP | Back End Programming |

| Laravel | PHP Framework |
| MySQL | Database |
| Brevo SMTP | Email |
| Git | Version Control |
| GitHub | Hosting |
## ⚙️ Installation
To run the project on your local machine please complete the below steps.
### 1. Clone the repository
```bash
git clone YOUR_GITHUB_REPOSITORY_URL
```
### 2. Enter the Project Directory
```bash
cd YOUR_PROJECT_FOLDER
```
### 3. Install composer packages
```bash
composer install
```
### 4. Create .env file
Windows CMD:
```cmd
copy .env.example .env
```
Git Bash / Linux:
```bash
cp .env.example .env
```
### 5. Generate Application Key
```bash
php artisan key:generate
```
### 6. Database Setup
Open the .env file and complete the MySQL details.
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quiz_management
DB_USERNAME=root
DB_PASSWORD=
```
Change the database name and the details to match your local setup.
### 7. Run migrations
```bash
php artisan migrate
```
### 8. Create storage link (if using laravel public storage)
```bash
php artisan storage:link
```
### 9. Clear config cache
```bash
php artisan config:clear
```
## 📧 Brevo SMTP Email Setup
This project uses Brevo SMTP to send emails for verification.
### 1. Create a Brevo Account
Go to https://www.brevo.com/
Create a new account or login.
Complete the verification.
### 2. Verify email address
Login to your Brevo account.
Go to Settings.
Click on Senders, Domains & Dedicated IPs.
Add your email address or domain.
Complete the verification.
### 3. Get SMTP details
Go to Settings > SMTP & API.
Click on SMTP.
Copy the SMTP details.
SMTP Server
SMTP Port
SMTP Login
SMTP Key
### 4. Setup SMTP in Laravel
Open your .env file and add the following.
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=YOUR_BREVO_SMTP_LOGIN
MAIL_PASSWORD=YOUR_BREVO_SMTP_KEY
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_verified_email@example.com
MAIL_FROM_NAME="${APP_NAME}"
```
Replace the details with your Brevo SMTP details.
### 5. Clear Laravel config cache
Run:
```bash
php artisan config:clear
```
### 6. Test emails
Launch your Laravel app and test the register and email verification.
Make sure you have valid Brevo SMTP details.
Make sure your email address/domain is verified.
Never push your .env file on GitHub.
Do NOT share your SMTP details.
Add the .env file to your .gitignore.
## ▶️ Launch
Run the laravel server:
```bash
php artisan serve
```
Open your browser:
```text
http://127.0.0.1:8000
```
## 👨‍💻 My Role
I mainly worked on this project as a Backend Developer.
I was responsible for:
Designing the database table and relationships.
Creating the backend functionality using Laravel.
Adding logic, CRUD functionality.
Implementing AJAX calls to backend.
Implementing email verification using Brevo SMTP.
Creating functionality to view quiz results and questions attempted.
Connecting the front-end pages to backend.
## 📚 What I learned
Used Laravel MVC.
Learned how to use Eloquent ORM and relationships.
Used Laravel migrations and validation.
Implemented AJAX.
Used SMTP and email verification.
Built dynamic websites.
Understood how to use Git for version control.
## 👤 Developer
Golu Kumar
Future PHP / Laravel Developer