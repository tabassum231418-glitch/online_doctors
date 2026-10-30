ONLINE DOCTOR APPOINTMENT SYSTEM (PHP + MySQL)

REQUIREMENTS
- XAMPP (Apache and MySQL)
- PHP with PDO MySQL enabled
- Web browser

INSTALLATION
1. Extract this folder into: C:\xampp\htdocs\
2. Open XAMPP Control Panel and start Apache and MySQL.
3. Open http://localhost/phpmyadmin
4. Select Import and import database.sql.
5. Open config/db.php and update database username/password if needed.
6. Visit http://localhost/online_doctor_appointment_system/
7. Register a patient account, log in, choose a doctor and book an appointment.
8. To create an admin account, visit http://localhost/online_doctor_appointment_system/create_admin.php ONCE.
   Admin login: admin@example.com
   Password: Admin@12345
9. IMPORTANT: Delete create_admin.php after creating the admin account.
10. Admin dashboard: log in using the admin account, then click Admin.

MAIN PAGES
index.php             Home page
register.php          Patient registration
login.php             Login
doctors.php           Doctor list
book.php              Create appointment
my_appointments.php   Read and cancel own appointments
admin.php             Admin read and update appointment status
logout.php            Logout

CRUD
Create: book.php inserts a new appointment.
Read: my_appointments.php and admin.php display appointments.
Update: admin.php changes appointment status.
Delete/cancel: my_appointments.php changes a pending appointment to Cancelled.
This is a classroom/demo project, not a production healthcare service. It does not provide
real medical advice, verified doctor credentials, payment processing, or emergency services.
