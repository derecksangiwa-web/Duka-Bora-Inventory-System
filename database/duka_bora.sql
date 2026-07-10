-- ==========================================
-- DUKA BORA INVENTORY MANAGEMENT SYSTEM
-- Database Script
-- ==========================================

-- Create Database
CREATE DATABASE IF NOT EXISTS duka_bora;

-- Use Database
USE duka_bora;

-- ==========================================
-- TABLE 1: Categories
-- ==========================================

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE
);

-- ==========================================
-- TABLE 2: Suppliers
-- ==========================================

CREATE TABLE suppliers (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    location VARCHAR(100) NOT NULL
);

-- ==========================================
-- TABLE 3: Products
-- ==========================================

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category_id INT NOT NULL,
    supplier_id INT NOT NULL,
    price DECIMAL(10,2) NOT NULL CHECK (price > 0),
    stock_qty INT NOT NULL DEFAULT 0 CHECK (stock_qty >= 0),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (category_id)
        REFERENCES categories(category_id),

    FOREIGN KEY (supplier_id)
        REFERENCES suppliers(supplier_id)
);

-- ==========================================
-- TABLE 4: Sales
-- ==========================================

CREATE TABLE sales (
    sale_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    qty_sold INT NOT NULL CHECK (qty_sold > 0),
    sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (product_id)
        REFERENCES products(product_id)
);

-- ==========================================
-- SAMPLE DATA
-- ==========================================

-- Categories

INSERT INTO categories(category_name)
VALUES
('Electronics'),
('Clothing'),
('Food');

-- Suppliers

INSERT INTO suppliers(supplier_name, phone, location)
VALUES
('Tech Suppliers Ltd','0712345678','Dar es Salaam'),
('Fashion Hub','0745678912','Arusha'),
('Fresh Foods Ltd','0751234567','Mwanza');

-- Products

INSERT INTO products
(name, category_id, supplier_id, price, stock_qty)
VALUES

('HP Laptop',1,1,1200000,15),

('Wireless Mouse',1,1,30000,40),

('Keyboard',1,1,45000,25),

('Men T-Shirt',2,2,25000,50),

('Ladies Dress',2,2,45000,18),

('Jeans',2,2,55000,20),

('Rice 5kg',3,3,18000,60),

('Sugar 2kg',3,3,8500,70),

('Cooking Oil 1L',3,3,12000,35),

('Milk 500ml',3,3,2500,80);