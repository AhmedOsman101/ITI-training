CREATE TABLE `patients` (
  `id` integer PRIMARY KEY,
  `consultant_id` integer,
  `ward_id` integer,
  `name` varchar(255),
  `birth_date` date
);

CREATE TABLE `consultants` (
  `id` integer PRIMARY KEY,
  `name` varchar(255)
);

CREATE TABLE `drugs` (
  `id` integer PRIMARY KEY,
  `dosage` varchar(255)
);

CREATE TABLE `drugs_brands` (
  `drug_id` integer,
  `brand_name` varchar(255),
  PRIMARY KEY (`drug_id`, `brand_name`)
);

CREATE TABLE `nurses` (
  `id` integer PRIMARY KEY,
  `ward_id` integer,
  `name` varchar(255),
  `address` varchar(255)
);

CREATE TABLE `wards` (
  `id` integer PRIMARY KEY,
  `supervisor_id` integer UNIQUE NOT NULL,
  `name` varchar(255)
);

CREATE TABLE `patients_consultants` (
  `patient_id` integer,
  `consultant_id` integer,
  `examine_at` datetime
);

CREATE TABLE `administrations` (
  `nurse_id` integer,
  `patient_id` integer,
  `drug_id` integer,
  `dosage` varchar(255),
  `administered_at` datetime
);

ALTER TABLE `patients` ADD CONSTRAINT `Assigned to` FOREIGN KEY (`consultant_id`) REFERENCES `consultants` (`id`);

ALTER TABLE `patients` ADD CONSTRAINT `Hosts` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`);

ALTER TABLE `nurses` ADD CONSTRAINT `Serves In` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`);

ALTER TABLE `nurses` ADD CONSTRAINT `Supervises` FOREIGN KEY (`id`) REFERENCES `wards` (`supervisor_id`);

ALTER TABLE `patients_consultants` ADD CONSTRAINT `Examines` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

ALTER TABLE `patients_consultants` ADD CONSTRAINT `Examines` FOREIGN KEY (`consultant_id`) REFERENCES `consultants` (`id`);

ALTER TABLE `administrations` ADD CONSTRAINT `Admin` FOREIGN KEY (`nurse_id`) REFERENCES `nurses` (`id`);

ALTER TABLE `administrations` ADD CONSTRAINT `Admin` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

ALTER TABLE `administrations` ADD CONSTRAINT `Admin` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`);

ALTER TABLE `drugs_brands` ADD FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`);
