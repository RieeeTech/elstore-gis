<?php
require 'vendor/autoload.php';
$db = \Config\Database::connect();
$sql = "CREATE TABLE IF NOT EXISTS `app_ratings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `rating` int(1) NOT NULL,
  `ulasan` text,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `app_ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
$db->query($sql);
echo "Table created successfully.";
