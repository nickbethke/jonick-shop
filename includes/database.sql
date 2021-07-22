CREATE TABLE `options` (
    `id_options` int(10) unsigned NOT NULL auto_increment,
    `name` varchar(64) NOT NULL,
    `value` longtext,
    PRIMARY KEY (`id_options`)
) DEFAULT CHARSET = utf8;
CREATE TABLE `users` (
    `id_user` int(10) unsigned NOT NULL auto_increment,
    `login` varchar(60) NOT NULL,
    `pass` varchar(255) NOT NULL,
    `nicename` varchar(50) NOT NULL,
    `displayname` varchar(250) NOT NULL,
    `email` varchar(100) DEFAULT NULL,
    `date_created` datetime NOT NULL DEFAULT CURRENT_TIME,
    `activision_key` varchar(250) NOT NULL,
    PRIMARY KEY (`id_user`)
) DEFAULT CHARSET = utf8;
CREATE TABLE `products` (
    `id_product` int(10) unsigned NOT NULL auto_increment,
    `name` varchar(100) DEFAULT NULL,
    `slug` varchar(100) DEFAULT NULL,
    `date_created` datetime NOT NULL,
    `date_modified` datetime NOT NULL,
    `status` enum('publish', 'draft', 'trash') NOT NULL DEFAULT 'publish',
    `featured` tinyint(1) NOT NULL DEFAULT 0,
    `catalog_visibility` enum('visible', 'hidden') NOT NULL DEFAULT 'visible',
    `description` LONGTEXT DEFAULT '',
    `short_description` LONGTEXT DEFAULT '',
    `sku` varchar(12) DEFAULT NULL,
    `price` decimal(20, 6) NOT NULL DEFAULT '0.000000',
    `regular_price` decimal(20, 6) NOT NULL DEFAULT '0.000000',
    `sale_price` decimal(20, 6) NOT NULL DEFAULT '0.000000',
    `quantity` int(10) NOT NULL DEFAULT '0',
    `image` LONGTEXT DEFAULT '',
    PRIMARY KEY (`id_product`)
) DEFAULT CHARSET = utf8;
CREATE TABLE `categories` (
    `id_category` int(10) unsigned NOT NULL auto_increment,
    `id_parent` int(10) unsigned NOT NULL,
    `name` varchar(100) DEFAULT NULL,
    `slug` varchar(100) DEFAULT NULL,
    `description` text,
    `meta_title` varchar(255) DEFAULT NULL,
    `meta_keywords` varchar(255) DEFAULT NULL,
    `meta_description` varchar(512) DEFAULT NULL,
    `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
    `date_created` datetime NOT NULL,
    `date_modified` datetime NOT NULL,
    `position` int(10) unsigned NOT NULL DEFAULT '0',
    `is_root_category` tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id_category`)
) DEFAULT CHARSET = utf8;
CREATE TABLE `category_product` (
    `id_category` int(10) unsigned NOT NULL,
    `id_product` int(10) unsigned NOT NULL,
    `position` int(10) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id_category`, `id_product`),
    INDEX (`id_product`),
    INDEX (`id_category`, `position`)
) DEFAULT CHARSET = utf8;
ALTER TABLE `category_product`
ADD CONSTRAINT `product_has_category` FOREIGN KEY (`id_product`) REFERENCES `products`(`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `category_product`
ADD CONSTRAINT `category_has_product` FOREIGN KEY (`id_category`) REFERENCES `categories`(`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION;
CREATE TABLE `cms_pages` (
    `id_cms_page` int(10) unsigned NOT NULL auto_increment,
    `id_parent_page` int(10) unsigned NOT NULL,
    `author` int(10) unsigned NOT NULL,
    `slug` varchar(100) DEFAULT NULL,
    `content` longtext,
    `title` varchar(255) DEFAULT NULL,
    `meta_title` varchar(255) DEFAULT NULL,
    `meta_keywords` varchar(255) DEFAULT NULL,
    `meta_description` varchar(512) DEFAULT NULL,
    `status` varchar(20) NOT NULL DEFAULT 'publish',
    `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `date_modified` datetime NOT NULL,
    PRIMARY KEY (`id_cms_page`)
) DEFAULT CHARSET = utf8;
ALTER TABLE `cms_pages`
ADD CONSTRAINT `page_has_author` FOREIGN KEY (`author`) REFERENCES `users`(`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;