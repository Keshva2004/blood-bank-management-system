CREATE TABLE admin ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(100), 
    email VARCHAR(100) UNIQUE, 
    password VARCHAR(255), 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

-- Create an initial admin user (password: admin123)
INSERT INTO admin (name, email, password) VALUES
('Admin', 'admin@example.com', '$2y$10$YourHashedPasswordHere');