CREATE DATABASE IF NOT EXISTS `arcade_rental` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;
USE `arcade_rental`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `full_name` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `games`;
CREATE TABLE `games` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(150) NOT NULL,
    `category` ENUM('Board Game', 'Arcade Cabinet', 'Console') NOT NULL,
    `min_players` INT NOT NULL DEFAULT 1,
    `max_players` INT NOT NULL DEFAULT 4,
    `hourly_rate` DECIMAL(10, 2) NOT NULL,
    `condition_rating` ENUM('Mint', 'Good', 'Fair', 'Needs Repair') NOT NULL DEFAULT 'Good',
    `status` ENUM('Available', 'Rented', 'Maintenance') NOT NULL DEFAULT 'Available',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO `users` (`username`, `password`, `full_name`) VALUES
('admin', '$2y$10$NgYlLl6zbGZfT9nLKTy6H.6efPfirHsS.doe/BH6CevOfpJkrfgT6', 'System Administrator');

INSERT INTO `games` (`title`, `category`, `min_players`, `max_players`, `hourly_rate`, `condition_rating`, `status`) VALUES
('Settlers of Catan', 'Board Game', 3, 4, 25000.00, 'Good', 'Available'),
('Tekken 8 Arcade Unit', 'Arcade Cabinet', 1, 2, 45000.00, 'Mint', 'Available'),
('PlayStation 5 Lounge Station', 'Console', 1, 4, 60000.00, 'Mint', 'Rented'),
('Pandemic Legacy: Season 1', 'Board Game', 2, 4, 30000.00, 'Fair', 'Maintenance'),
('Time Crisis II Cabinet', 'Arcade Cabinet', 1, 2, 40000.00, 'Needs Repair', 'Maintenance');