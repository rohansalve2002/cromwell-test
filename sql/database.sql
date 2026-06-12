-- Create Database
CREATE DATABASE cromwell_test;

-- Connect to database before running below queries
-- \c cromwell_test;

-- Users Table
CREATE TABLE users (
    id SERIAL PRIMARY KEY,

    forename VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    title VARCHAR(50),

    dob DATE,

    mobile VARCHAR(20),
    other_phone VARCHAR(20),

    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optional sample data
INSERT INTO users (
    forename,
    surname,
    title,
    dob,
    mobile,
    other_phone,
    email,
    password
)
VALUES (
    'Test',
    'User',
    'Mr',
    '1998-01-15',
    '9876543210',
    '9876543211',
    'test@example.com',
    '$2y$10$examplehashedpassword'
);