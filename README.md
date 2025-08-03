
# 🩺 Laravel Pharmacy Prescription Management System

This is a web-based application built using **Laravel** that enables pharmacies to manage medical prescriptions submitted by patients. Pharmacists can view prescriptions, create quotations, and communicate with patients in an efficient and user-friendly manner.

---
## 📌 Key Features

- 🧾 Upload and manage medical prescriptions (images)
- 🔍 View prescription details in an AJAX-powered modal with image slider
- 💵 Create, edit, and submit quotations for prescribed medications
- 📬 Email notifications to patients with attached quotations
- 📊 Dashboard for tracking all submitted prescriptions and quotations
- 🔐 Authentication for pharmacists/admins

---

## 🛠️ Installation Guide
Make sure that you have setup the environment properly.
You will need minimum PHP 8.2,Laravel 11.0, MySQL/MariaDB, composer and Node.js.

### **. Clone the Repository

```bash
git https://gitlab.com/salitha123/pharmacy-system.git
cd Pharmacy-system
```


### 1. Install PHP Dependencies

```bash
composer install
```

### 2. Setup Environment
```bash
cp .env.example .env

```

### 3. Install Node Dependencies
```bash
npm install
```

### 4. Build Assets
```bash
npm run build
```
### 5. Update Environment Variables

Then update your `.env` file:

```env
APP_URL=http:your_host
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=secret
```

### 6. Generate Application Key
```bash
php artisan key:generate
```

### 7. Migrate and Seed the Database

```bash
php artisan migrate
php artisan db:seed

```
### 8. Create Storage Symlink

```bash
php artisan storage:link

```
### 9. Give Permissions
```bash
 chmod -R 775 storage
 chmod -R 775 bootstrap/cache

 chown -R www-data:www-data storage
 chown -R www-data:www-data bootstrap/cache

```
### 10. Email Configuration
Update your `.env` file:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email
MAIL_FROM_NAME="${APP_NAME}"

```

### 11.Enabling Email Notifications ( Optional )
```
If you're enabling email functionality, you must also update the notification channels in your Laravel app to send emails in addition to saving notifications to the database.

Update the following files as shown:

1. app/Notifications/QuotationPrepared.php
2. app/Notifications/QuotationStatusUpdated.php

Change the via() method:

public function via(object $notifiable): array
{
    // Enable both mail and database notifications
    return ['mail', 'database'];

    // If you want to use only database (disable emails), use:
    // return ['database'];
}

```

### 📝 Recommended After .env Changes

```bash
php artisan config:clear
php artisan cache:clear
```

## 🧪 Run the App
### Start Laravel Backend

```bash
php artisan serve
```

### 👤 Default Admin User Credentials

```bash
📧 Email:     pharmacy@gmail.com  
🔐 Password:  123

```


## 👤 Developed By

**R.M.S.N. Rathnayake**

---

## 📝 License

MIT License
