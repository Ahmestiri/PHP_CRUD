SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `products` (
  `id` int(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(2048) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products` (`id`, `title`, `description`, `price`, `image`, `create_date`) VALUES
(1, ' MSI GF75 THIN 9SC', 'Newest Laptop ', 1980, 'images/test.jpg', '2022-06-07'),
(2, 'REDMI NOTE 10S', 'Product bought last year', 800, 'images/telephone-portable-xiaomi-redmi-note-10-s-6-go-128-go-gris.jpg', '2022-06-07'),
(3, 'Asus X550JX', '', 1200, 'images/asus_laptop__model_x550jx_blackred_edition_1574142718_7870f648.jpg', '2022-06-07'),
(4, 'Galaxy S6', 'Older Phone I used', 600, 'images/samsung-galaxy-s6-1.png', '2022-06-07');

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;