CREATE DATABASE IF NOT EXISTS doctor_appointment_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE doctor_appointment_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  phone VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('patient','admin') NOT NULL DEFAULT 'patient',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS doctors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  specialization VARCHAR(120) NOT NULL,
  fee DECIMAL(10,2) NOT NULL DEFAULT 500,
  available_days VARCHAR(150) NOT NULL,
  available_time VARCHAR(100) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS appointments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  doctor_id INT NOT NULL,
  appointment_date DATE NOT NULL,
  appointment_time TIME NOT NULL,
  reason TEXT,
  status ENUM('Pending','Approved','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_appointment_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_appointment_doctor FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE RESTRICT
);

INSERT INTO doctors (name, specialization, fee, available_days, available_time) VALUES
('Dr. Ayesha Rahman','Cardiologist',800,'Sunday, Tuesday, Thursday','10:00 AM - 2:00 PM'),
('Dr. Mahmud Hasan','Medicine Specialist',600,'Saturday, Monday, Wednesday','4:00 PM - 8:00 PM'),
('Dr. Nusrat Jahan','Dermatologist',700,'Sunday, Monday, Thursday','11:00 AM - 3:00 PM'),
('Dr. Samiul Islam','Child Specialist',650,'Saturday, Tuesday, Wednesday','5:00 PM - 9:00 PM');
