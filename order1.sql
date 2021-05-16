CREATE DATABASE `order1`;

ALTER DATABASE `order1` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `products` (
	`id` int(10) primary key AUTO_INCREMENT not null,
	`name` varchar(200) NOT NULL,
	`desc` text NOT NULL,
	`price` decimal(7,2) NOT NULL,
	`rrp` decimal(7,2) NOT NULL DEFAULT '0.00',
	`quantity` int(11) NOT NULL,
	`img` text NOT NULL,
	`date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

insert into `products` (`id`, `name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(1, 'Vịt quay tứ xuyên', '<p>Tứ Xuyên là 1 trong 8 trường phái ẩm thực của Trung Quốc. Món vịt quay Tứ Xuyên tuy không được biết đến nhiều như Vịt quay Bắc Kinh, nhưng xét về độ thơm ngon, tinh tế thì không hề thua kém chút nào.</p>', '39.99', '0.00', 50, 'vitquay.jpg', '2021-03-13 17:55:22'),
(2, 'Bào ngư sốt dầu hào', '', '14.99', '19.99', 100, 'baongu.jpg', CURRENT_TIMESTAMP),
(3, 'Cua lột chiên sốt', '', '25.99', '29.99', 50, 'cualot.jpg', CURRENT_TIMESTAMP),
(4, 'Hàu đút lò', '', '16.99', '', 100, 'hau.jpg', CURRENT_TIMESTAMP),
(5, 'Mực chiên giòn', '', '19.99', '', 80, 'mucchien.jpg', CURRENT_TIMESTAMP),
(6, 'Mực ống nhồi', '', '14.99', '19.99', 80, 'mucong.jpg', CURRENT_TIMESTAMP),
(7, 'Tôm càng đút lò', '', '29.99', '', 80, 'tomcang.jpg', CURRENT_TIMESTAMP),
(8, 'Tôm sú ủ muối', '', '25.99', '', 50, 'tomsu.jpg', CURRENT_TIMESTAMP),
(9, 'Chả tôm hạt điều', '', '35.99', '', 100, 'chatom.jpg', CURRENT_TIMESTAMP),
(10, 'Cơm chiên hoàng bào', '', '24.99', '', 100, 'comchien.jpg', CURRENT_TIMESTAMP),
(11, 'Gà ta hấp cải', '', '29.99', '35.99', 100, 'gata.jpg', CURRENT_TIMESTAMP),
(12, 'Heo sữa quay', '', '59.99', '', 10, 'heosua.jpg', CURRENT_TIMESTAMP),
(13, 'Nước ép cam', '', '9.99', '', 100, 'camvat.jpg', CURRENT_TIMESTAMP),
(14, 'SAUVIGNON BLANC', '', '1500', '', 100, 'blanc.jpeg', CURRENT_TIMESTAMP),
(15, 'NOBILO', '', '2000', '', 100, 'nobilo.jpeg', CURRENT_TIMESTAMP),
(16, 'Trà đào chanh sả', '<p>Thức uống này không chỉ tốt cho thận, gan, da, tuyến tụy, duy trì cholesterol,... mà còn giải nhiệt rất hiệu quả.</p>\r\n<h3>Nguyên liệu</h3>\r\n<ul>\r\n<li>2 miếng đào tươi</li>\r\n<li>1 nửa cam tươi</li>\r\n<li>1 nửa quả chanh</li>\r\n<li>15 ml sirup đào</li>\r\n<li>3g trà thảo mộc</li>\r\n</ul>', '14.99', '19.99', 100, 'tradao.jpg', CURRENT_TIMESTAMP),
(17, 'Gỏi bò', '', '39.99', '', 100, 'goibo.jpg', CURRENT_TIMESTAMP),
(18, 'Bò cuộn phô mai', '', '39.99', '49.99', 100, 'bocuon.jpg', CURRENT_TIMESTAMP),
(19, 'Bò xào bắp', '<p>Món thịt bò xào bắp non thật đơn giản với thịt bò ngọt mềm, bắp non giòn giòn.</p>', '45.99', '', 100, 'boxao.jpg', CURRENT_TIMESTAMP),
(20, 'Súp hải sản', '', '34.99', '', 100, 'sup.jpg', CURRENT_TIMESTAMP);

CREATE TABLE `users` (
  `user_id` int(10) primary key not null auto_increment,
  `name` varchar(100) not null,
  `username` varchar(45) not null,
  `email` varchar(100) not null,
  `password` varchar(100) not null,
  `phone` varchar(13),
  `address1` varchar(300),
  `address2` varchar(200),
  `create_at` datetime default CURRENT_TIMESTAMP
);



alter table `users`
add constraint UQ_EMAIL
unique (`email`);
alter table `users`
add constraint UQ_USERNAME
unique (`username`);


insert into `users` (`user_id`, `name`, `username`, `email`, `password`, `phone`, `address1`, `address2`) VALUES 
(1, 'Thinh', 'thinhhaha', 'thinh@gmail.com', 'abc1234', '1368838679', '45 Nguyen Xi, Go Vap', 'Van Lang University cs3'), 
(2, 'Hung', 'hunghaha', 'hung@yahoo.com', 'def1234', '393979796968', '203 Binh Loi, Binh Thanh', 'Binh Thanh');

create table `orders` (
	`id` int(11) not null,
	`name_order` varchar(100) null,
	`datecreation` datetime not null,
	`status` tinyint(1) null,
	`username` varchar(20) null,
	`name` varchar(100) not null,
	`phone` varchar(10) not null,
	`email` varchar(100) null,
	`address` varchar(250) not null,
	`note` varchar(250) null,
	`payment_mode` varchar(20) not null
);

create table `ordersdetail` (
	`orderid` int(11) not null,
	`productid` int(10) not null,
	`price` decimal(7, 2) not null,
	`quantity` int(11) not null,
	`total` float not null
);


alter table `orders`
add constraint pk_orders
primary key (`id`);

alter table `ordersdetail`
add constraint pk_details
primary key (`productid`, `orderid`);

alter table `orders`
modify `id` int(11) not null auto_increment;

