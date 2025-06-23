-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2025 a las 06:28:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ds6-2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(1, 'Computadoras y Laptops', 'Equipos de cómputo portátiles y de escritorio, estaciones de trabajo y accesorios relacionados', 'https://blog.bestbuy.ca/wp-content/uploads/2017/11/versussas20.jpg', '2025-05-30 19:17:20'),
(2, 'Smartphones y Tablets', 'Dispositivos móviles, tablets, e-readers y accesorios para dispositivos móviles', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0yWL_QR10XlWg3oSbqD15gxWDl54fGsTu_g&amp;s', '2025-05-30 19:17:20'),
(3, 'Audio y Video', 'Auriculares, bocinas, equipos de sonido, cámaras, televisores y equipos de video', 'https://img.freepik.com/vector-premium/12-instrumentos-musicales-establecidos-produccion-musical-contornos-negros-ilustraciones-vectoriales_636653-485.jpg', '2025-05-30 19:17:20'),
(4, 'Gaming', 'Consolas de videojuegos, accesorios gaming, sillas gamer, teclados y mouse gaming', 'https://www.timeoutdoha.com/cloud/timeoutdoha/2021/08/17/s3TzLVrP-gaming-gear-1200x800.jpg', '2025-05-30 19:17:20'),
(5, 'Redes y Conectividad', 'Routers, switches, cables, adaptadores WiFi, equipos de red y telecomunicaciones', 'https://i.blogs.es/76b3bd/asus-rog-rapture-gt-ax11000-pro/650_1200.png', '2025-05-30 19:17:20'),
(6, 'Almacenamiento', 'Discos duros externos, SSD, USB, tarjetas de memoria y soluciones de respaldo', 'https://pcoutlet.com/wp-content/uploads/ssd-vs-hdd-1024x589.webp', '2025-05-30 19:17:20'),
(7, 'Componentes de PC', 'Procesadores, tarjetas gráficas, memoria RAM, motherboards, fuentes de poder', 'https://img.pccomponentes.com/pcblog/6505/componentes-ordenador.jpg', '2025-05-30 19:17:20'),
(8, 'Accesorios y Periféricos', 'Teclados, mouse, monitores, webcams, bases para laptop, hubs USB', 'https://megatecno.com.ve/wp-content/uploads/2025/04/Comprar-Perifericos-para-PC-en-Venezuela-%E2%80%93-Accesorios-y-Dispositivos-Externos.png', '2025-05-30 19:17:20'),
(9, 'Smart Home', 'Dispositivos inteligentes para el hogar, asistentes de voz, cámaras de seguridad, domótica', 'https://www.beachesliving.ca/beacheslife/wp-content/uploads/2018/03/apple-homepod-google-home-amazon-echo.png', '2025-05-30 19:17:20'),
(10, 'Wearables y Fitness', 'Smartwatches, fitness trackers, auriculares deportivos, dispositivos de salud', 'https://dy6o3vurind23.cloudfront.net/img/developerimg/choco_life_20161214074908_db/mebase/CustomSectionStyle/Images/smart_wearabldsses.webp', '2025-05-30 19:17:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_id`, `created_at`) VALUES
(1, 'MacBook Air M2', 'Laptop ultradelgada con chip M2, pantalla de 13.6 pulgadas, 8GB RAM, 256GB SSD', 1199.99, 'macbook-air-m2.jpg', 1, '2025-05-30 19:20:55'),
(2, 'Dell XPS 13', 'Laptop premium con procesador Intel Core i7, 16GB RAM, 512GB SSD, pantalla InfinityEdge', 1299.99, 'dell-xps-13.jpg', 1, '2025-05-30 19:20:55'),
(3, 'HP Pavilion Desktop', 'PC de escritorio con AMD Ryzen 5, 8GB RAM, 1TB HDD, tarjeta gráfica integrada', 649.99, 'hp-pavilion-desktop.jpg', 1, '2025-05-30 19:20:55'),
(4, 'Lenovo ThinkPad X1 Carbon', 'Laptop empresarial con Intel Core i5, 16GB RAM, 512GB SSD, pantalla 14 pulgadas', 1399.99, 'thinkpad-x1-carbon.jpg', 1, '2025-05-30 19:20:55'),
(5, 'ASUS ROG Strix Desktop', 'PC Gaming con Intel Core i7, 32GB RAM, RTX 4060, 1TB SSD', 1899.99, 'asus-rog-strix.jpg', 1, '2025-05-30 19:20:55'),
(6, 'iPhone 15 Pro', 'Smartphone con chip A17 Pro, cámara de 48MP, pantalla de 6.1 pulgadas, 128GB', 999.99, 'iphone-15-pro.jpg', 2, '2025-05-30 19:20:55'),
(7, 'Samsung Galaxy S24', 'Android flagship con Snapdragon 8 Gen 3, 8GB RAM, 256GB almacenamiento', 899.99, 'galaxy-s24.jpg', 2, '2025-05-30 19:20:55'),
(8, 'iPad Air', 'Tablet con chip M1, pantalla de 10.9 pulgadas, 64GB WiFi, compatible con Apple Pencil', 599.99, 'ipad-air.jpg', 2, '2025-05-30 19:20:55'),
(9, 'Google Pixel 8', 'Smartphone Android puro con cámara avanzada con IA, 8GB RAM, 128GB', 699.99, 'pixel-8.jpg', 2, '2025-05-30 19:20:55'),
(10, 'Samsung Galaxy Tab S9', 'Tablet Android premium con S Pen incluido, pantalla AMOLED de 11 pulgadas', 799.99, 'galaxy-tab-s9.jpg', 2, '2025-05-30 19:20:55'),
(11, 'Sony WH-1000XM5', 'Auriculares inalámbricos con cancelación de ruido premium, 30h de batería', 399.99, 'sony-wh1000xm5.jpg', 3, '2025-05-30 19:20:55'),
(12, 'JBL Flip 6', 'Bocina portátil Bluetooth resistente al agua, sonido potente y graves profundos', 129.99, 'jbl-flip-6.jpg', 3, '2025-05-30 19:20:55'),
(13, 'Canon EOS R50', 'Cámara mirrorless para creadores de contenido, 24.2MP, grabación 4K', 679.99, 'canon-eos-r50.jpg', 3, '2025-05-30 19:20:55'),
(14, 'Samsung 55\" QLED 4K', 'Smart TV QLED de 55 pulgadas con tecnología Quantum Dot, HDR10+', 899.99, 'samsung-qled-55.jpg', 3, '2025-05-30 19:20:55'),
(15, 'Bose SoundLink Mini', 'Bocina Bluetooth compacta con sonido premium y 12 horas de reproducción', 199.99, 'bose-soundlink-mini.jpg', 3, '2025-05-30 19:20:55'),
(16, 'PlayStation 5', 'Consola de videojuegos de nueva generación con SSD ultrarrápido y gráficos 4K', 499.99, 'playstation-5.jpg', 4, '2025-05-30 19:20:55'),
(17, 'Xbox Series X', 'Consola Xbox más potente con 12 TFLOPS, compatibilidad 4K/120fps', 499.99, 'xbox-series-x.jpg', 4, '2025-05-30 19:20:55'),
(18, 'Razer DeathAdder V3', 'Mouse gaming ergonómico con sensor Focus Pro 30K, switches ópticos', 99.99, 'razer-deathadder-v3.jpg', 4, '2025-05-30 19:20:55'),
(19, 'Corsair K95 RGB', 'Teclado mecánico gaming con switches Cherry MX, iluminación RGB personalizable', 199.99, 'corsair-k95-rgb.jpg', 4, '2025-05-30 19:20:55'),
(20, 'Secretlab Titan Evo', 'Silla gaming ergonómica con soporte lumbar ajustable y materiales premium', 449.99, 'secretlab-titan-evo.jpg', 4, '2025-05-30 19:20:55'),
(21, 'ASUS AX6000 Router', 'Router WiFi 6 de doble banda con velocidades hasta 6000 Mbps', 299.99, 'asus-ax6000.jpg', 5, '2025-05-30 19:20:55'),
(22, 'TP-Link Deco M5', 'Sistema mesh WiFi para hogar completo, cobertura hasta 500m², pack de 3', 179.99, 'tp-link-deco-m5.jpg', 5, '2025-05-30 19:20:55'),
(23, 'Netgear 24-Port Switch', 'Switch Gigabit no administrado de 24 puertos para redes empresariales', 149.99, 'netgear-24port-switch.jpg', 5, '2025-05-30 19:20:55'),
(24, 'USB-C to Ethernet Adapter', 'Adaptador USB-C a Ethernet Gigabit para laptops sin puerto RJ45', 29.99, 'usb-c-ethernet-adapter.jpg', 5, '2025-05-30 19:20:55'),
(25, 'Cat 6 Ethernet Cable 10ft', 'Cable de red categoría 6 de 3 metros, alta velocidad y baja latencia', 15.99, 'cat6-cable-10ft.jpg', 5, '2025-05-30 19:20:55'),
(26, 'Samsung T7 Portable SSD 1TB', 'SSD externo portátil con velocidades hasta 1,050 MB/s, USB-C', 129.99, 'samsung-t7-1tb.jpg', 6, '2025-05-30 19:20:55'),
(27, 'WD Black 2TB External HDD', 'Disco duro externo para gaming con 2TB de capacidad, USB 3.2', 89.99, 'wd-black-2tb.jpg', 6, '2025-05-30 19:20:55'),
(28, 'SanDisk Ultra 128GB USB', 'Memoria USB 3.0 de alta velocidad con 128GB de capacidad', 24.99, 'sandisk-ultra-128gb.jpg', 6, '2025-05-30 19:20:55'),
(29, 'Kingston 64GB MicroSD', 'Tarjeta MicroSD Clase 10 UHS-I de 64GB para smartphones y cámaras', 19.99, 'kingston-microsd-64gb.jpg', 6, '2025-05-30 19:20:55'),
(30, 'Seagate Backup Plus 5TB', 'Disco duro externo de escritorio con 5TB, ideal para respaldos masivos', 139.99, 'seagate-backup-5tb.jpg', 6, '2025-05-30 19:20:55'),
(31, 'AMD Ryzen 7 7700X', 'Procesador de 8 núcleos y 16 hilos, frecuencia base 4.5GHz, socket AM5.', 350.00, 'https://m.media-amazon.com/images/I/51lXCYo7GkL._AC_SX466_.jpg', 7, '2025-05-30 19:20:55'),
(32, 'NVIDIA RTX 4070', 'Tarjeta gráfica para gaming 1440p con 12GB GDDR6X y tecnología DLSS 3', 599.99, 'https://m.media-amazon.com/images/I/71Sqt8X-MfL._AC_SX466_.jpg', 7, '2025-05-30 19:20:55'),
(33, 'Corsair Vengeance 32GB DDR4', 'Kit de memoria RAM DDR4-3200 de 32GB (2x16GB) para gaming y trabajo', 119.99, 'corsair-vengeance-32gb.jpg', 7, '2025-05-30 19:20:55'),
(34, 'ASUS ROG Strix B650', 'Motherboard ATX para AMD AM5 con WiFi 6E, múltiples slots PCIe', 229.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxojtDyXYAyg1GqrMnIrFqAxUlUprEYQ8JxQ&amp;s', 7, '2025-05-30 19:20:55'),
(35, 'EVGA 750W Gold PSU', 'Fuente de poder modular 80+ Gold de 750W, certificada y eficiente', 149.99, 'evga-750w-gold.jpg', 7, '2025-05-30 19:20:55'),
(36, 'Logitech MX Master 3S', 'Mouse inalámbrico de precisión con desplazamiento MagSpeed y 8K DPI', 99.99, 'logitech-mx-master-3s.jpg', 8, '2025-05-30 19:20:55'),
(37, 'Keychron K8 Mechanical', 'Teclado mecánico inalámbrico 75% con switches Gateron, retroiluminado', 89.99, 'keychron-k8.jpg', 8, '2025-05-30 19:20:55'),
(38, 'LG 27\" 4K Monitor', 'Monitor IPS 4K de 27 pulgadas con USB-C, HDR10 y ajuste de altura', 399.99, 'lg-27-4k-monitor.jpg', 8, '2025-05-30 19:20:55'),
(39, 'Logitech C920 HD Webcam', 'Cámara web Full HD 1080p con micrófono integrado y enfoque automático', 79.99, 'logitech-c920.jpg', 8, '2025-05-30 19:20:55'),
(40, 'Anker USB-C Hub 7-in-1', 'Hub USB-C con HDMI 4K, puertos USB 3.0, lector SD y carga PD', 59.99, 'anker-usb-c-hub.jpg', 8, '2025-05-30 19:20:55'),
(41, 'Amazon Echo Dot 5ta Gen', 'Asistente de voz inteligente con Alexa, sonido mejorado y hub Zigbee', 49.99, 'echo-dot-5gen.jpg', 9, '2025-05-30 19:20:55'),
(42, 'Philips Hue Starter Kit', 'Kit de iluminación inteligente con 3 bombillas LED y puente Hue', 199.99, 'philips-hue-starter.jpg', 9, '2025-05-30 19:20:55'),
(43, 'Ring Video Doorbell', 'Timbre inteligente con cámara HD, detección de movimiento y audio bidireccional', 179.99, 'ring-video-doorbell.jpg', 9, '2025-05-30 19:20:55'),
(44, 'Google Nest Thermostat', 'Termostato inteligente programable con control desde smartphone', 129.99, 'nest-thermostat.jpg', 9, '2025-05-30 19:20:55'),
(45, 'TP-Link Kasa Smart Plug', 'Enchufe inteligente WiFi con control remoto y programación de horarios', 14.99, 'kasa-smart-plug.jpg', 9, '2025-05-30 19:20:55'),
(46, 'Apple Watch Series 9', 'Smartwatch con pantalla Always-On, GPS, monitor de salud avanzado', 399.99, 'apple-watch-series-9.jpg', 10, '2025-05-30 19:20:55'),
(47, 'Fitbit Charge 6', 'Pulsera de actividad con GPS, monitor de frecuencia cardíaca y 6 días de batería', 159.99, 'fitbit-charge-6.jpg', 10, '2025-05-30 19:20:55'),
(48, 'Samsung Galaxy Watch 6', 'Smartwatch Android con pantalla AMOLED, Wear OS y sensores de salud', 329.99, 'galaxy-watch-6.jpg', 10, '2025-05-30 19:20:55'),
(49, 'Garmin Forerunner 255', 'Reloj GPS para running con métricas avanzadas y autonomía de 14 días', 349.99, 'garmin-forerunner-255.jpg', 10, '2025-05-30 19:20:55'),
(50, 'Jabra Elite 85t', 'Earbuds inalámbricos con cancelación de ruido adaptativa y 31h de batería', 179.99, 'jabra-elite-85t.jpg', 10, '2025-05-30 19:20:55'),
(51, 'ROG Xbox Ally | 1T', '¡Descubre la ROG Ally, tu puerta de entrada a la élite del gaming portátil! Con la potencia de un PC y la versatilidad de una consola, juega tus títulos favoritos de Xbox y más, donde sea y cuando sea. ¡Rendimiento inigualable en tus manos', 649.99, 'https://cms-assets.xboxservices.com/assets/8b/26/8b26b482-20a7-4182-a64a-c97f2a221f59.png?n=9856321_Hero-Gallery-0_V01-01_1400x800.png', 4, '2025-06-13 20:02:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','consultor') DEFAULT 'consultor',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin_tech', 'admin@codecorp.com', 'admin123', 'admin', '2025-05-30 19:37:03'),
(2, 'consultor_ventas', 'consultor@codecorp.com', 'con123', 'consultor', '2025-05-30 19:37:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
