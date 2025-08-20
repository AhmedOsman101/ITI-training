CREATE TABLE `offices` (
  `id` integer PRIMARY KEY,
  `manager_id` integer,
  `location` varchar(255)
);

CREATE TABLE `employees` (
  `id` integer PRIMARY KEY,
  `office_id` integer,
  `name` varchar(255)
);

CREATE TABLE `properties` (
  `id` integer PRIMARY KEY,
  `owner_id` integer,
  `office_id` integer,
  `address` varchar(255),
  `city` varchar(255),
  `state` varchar(255),
  `zip_code` varchar(255)
);

CREATE TABLE `owners` (
  `id` integer PRIMARY KEY,
  `name` varchar(255)
);

CREATE TABLE `properties_owners` (
  `id` integer PRIMARY KEY,
  `owner_id` integer,
  `property_id` integer,
  `percent_owned` float
);

ALTER TABLE `employees` ADD CONSTRAINT `Work` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`);

ALTER TABLE `offices` ADD CONSTRAINT `Manage` FOREIGN KEY (`manager_id`) REFERENCES `employees` (`id`);

ALTER TABLE `properties` ADD CONSTRAINT `List` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`);

ALTER TABLE `properties_owners` ADD CONSTRAINT `Has` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

ALTER TABLE `properties_owners` ADD CONSTRAINT `Has` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`);
