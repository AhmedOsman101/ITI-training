
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `department` (
  `dname` varchar(50) NOT NULL,
  `dnum` tinyint(3) UNSIGNED NOT NULL,
  `mgrssn` int(10) UNSIGNED NOT NULL,
  `mgrstartdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `department` (`dname`, `dnum`, `mgrssn`, `mgrstartdate`) VALUES
('dp1', 10, 223344, '2005-01-01'),
('dp2', 20, 968574, '2006-03-01'),
('dp3', 30, 512463, '2006-06-01');

CREATE TABLE `dependent` (
  `essn` int(10) UNSIGNED NOT NULL,
  `dependent_name` varchar(50) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `bdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `dependent` (`essn`, `dependent_name`, `gender`, `bdate`) VALUES
(112233, 'Hala Saied Ali', 'f', '1970-10-18'),
(223344, 'Ahmed Kamel Shawki', 'm', '1998-03-27'),
(223344, 'Mona Adel Mohamed', 'f', '1975-04-25'),
(321654, 'Omar Amr Omran', 'm', '1993-03-30'),
(321654, 'Ramy Amr Omran', 'm', '1990-01-26'),
(321654, 'Sanaa Gawish', 'f', '1973-05-16'),
(512463, 'Nora Ghaly', 'f', '1976-06-22'),
(512463, 'Sara Edward ', 'f', '2001-09-15');

CREATE TABLE `employee` (
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `ssn` int(10) UNSIGNED NOT NULL,
  `bdate` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `salary` decimal(7,2) DEFAULT NULL,
  `superssn` int(10) UNSIGNED DEFAULT NULL,
  `dno` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `employee` (`fname`, `lname`, `ssn`, `bdate`, `address`, `gender`, `salary`, `superssn`, `dno`) VALUES
('ahmed', 'ali', 112233, '1965-01-01', '15 Ali fahmy St.Giza', 'm', '1300.00', 223344, 10),
('hanaa', 'sobhy', 123456, '1973-03-18', '38 Abdel Khalik Tharwat St. Downtown.Cairo', 'f', '800.00', 321654, 10),
('kamel', 'mohamed', 223344, '1970-10-15', '38 Mohy el dien abo el Ezz  St.Cairo', 'm', '1800.00', 223344, 10),
('amr', 'omran', 321654, '1963-09-14', '44 Hilopolis.Cairo', 'm', '2500.00', 112233, 10),
('edward', 'hanna', 512463, '1972-08-19', '18 Abaas El 3akaad St. Nasr City.Cairo', 'm', '1500.00', 321654, 20),
('maged', 'raoof', 521634, '1980-04-06', '18 Kholosi st.Shobra.Cairo', 'm', '1000.00', 321654, 30),
('mariam', 'adel', 669955, '1982-06-12', '269 El-Haram st. Giza', 'f', '750.00', 512463, 20),
('noha', 'mohamed', 968574, '1975-02-01', '55 Orabi St. El Mohandiseen .Cairo', 'f', '1600.00', 968574, 30);

CREATE TABLE `project` (
  `pname` varchar(50) NOT NULL,
  `pnumber` smallint(5) UNSIGNED NOT NULL,
  `plocation` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dnum` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `project` (`pname`, `pnumber`, `plocation`, `city`, `dnum`) VALUES
('AL Solimaniah', 100, 'Cairo_Alex Road', 'alex', 10),
('AL rabwah', 200, '6th of October City', 'giza', 10),
('AL rawdah', 300, 'Zaied City', 'giza', 10),
('AL rowad', 400, 'Cairo_Faiyom Road', 'giza', 20),
('AL rehab', 500, 'Nasr City', 'cairo', 30),
('Pitcho american', 600, 'maady', 'cairo', 30),
('Ebad El Rahman', 700, 'ring Road', 'cairo', 20);

CREATE TABLE `works_for` (
  `essn` int(10) UNSIGNED NOT NULL,
  `pno` smallint(5) UNSIGNED NOT NULL,
  `hours` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `works_for` (`essn`, `pno`, `hours`) VALUES
(112233, 100, 40),
(223344, 100, 10),
(223344, 200, 10),
(223344, 300, 10),
(223344, 500, 10),
(512463, 500, 10),
(512463, 600, 25),
(521634, 300, 6),
(521634, 400, 4),
(521634, 500, 10),
(521634, 600, 20),
(669955, 300, 10),
(669955, 400, 20),
(669955, 700, 7),
(968574, 300, 10),
(968574, 400, 15),
(968574, 700, 15);

ALTER TABLE `department`
  ADD PRIMARY KEY (`dnum`),
  ADD UNIQUE KEY `mgrssn` (`mgrssn`);

ALTER TABLE `dependent`
  ADD PRIMARY KEY (`essn`,`dependent_name`),
  ADD UNIQUE KEY `dependent_name` (`dependent_name`);

ALTER TABLE `employee`
  ADD PRIMARY KEY (`ssn`),
  ADD KEY `fk_superssn_employee` (`superssn`),
  ADD KEY `fk_dno_employee` (`dno`);

ALTER TABLE `project`
  ADD PRIMARY KEY (`pnumber`),
  ADD KEY `fk_dnum_project` (`dnum`);

ALTER TABLE `works_for`
  ADD PRIMARY KEY (`essn`,`pno`),
  ADD KEY `fk_pno_works_for` (`pno`);


ALTER TABLE `department`
  ADD CONSTRAINT `fk_mgrssn_department` FOREIGN KEY (`mgrssn`) REFERENCES `employee` (`ssn`);

ALTER TABLE `dependent`
  ADD CONSTRAINT `fk_essn_dependent` FOREIGN KEY (`essn`) REFERENCES `employee` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `employee`
  ADD CONSTRAINT `fk_dno_employee` FOREIGN KEY (`dno`) REFERENCES `department` (`dnum`),
  ADD CONSTRAINT `fk_superssn_employee` FOREIGN KEY (`superssn`) REFERENCES `employee` (`ssn`);

ALTER TABLE `project`
  ADD CONSTRAINT `fk_dnum_project` FOREIGN KEY (`dnum`) REFERENCES `department` (`dnum`);

ALTER TABLE `works_for`
  ADD CONSTRAINT `fk_essn_works_for` FOREIGN KEY (`essn`) REFERENCES `employee` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pno_works_for` FOREIGN KEY (`pno`) REFERENCES `project` (`pnumber`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

-- Later changes --

INSERT INTO `employee` ( `fname`, `lname`, `ssn`, `bdate`, `address`, `gender`, `salary`, `superssn`, `dno` )
VALUES ( 'Ahmad', 'Othman', 102672, '2005-12-15', 'Nasr City, Cairo', 'm', '9999.00', 112233, 30 );

INSERT INTO employee (fname, lname, ssn, bdate, address, gender, dno)
VALUES ('besto', 'friendo', 102660, '2005-12-15', 'Nasr City, Cairo', 'm', 30);

INSERT INTO
  department (dname, dnum, mgrssn, mgrstartdate)
VALUES
  ('DEPT IT', 100, 112233, '2006-11-01');

UPDATE employee SET dno = 100 WHERE ssn = (SELECT ssn FROM employee WHERE fname = 'noha' AND lname = 'mohamed'); -- Set department number for Noha
UPDATE employee SET dno = 20 WHERE ssn = (SELECT ssn FROM employee WHERE fname = 'besto' AND lname = 'friendo'); -- Set department number for my friend

UPDATE department SET mgrssn = (SELECT ssn FROM employee WHERE fname = 'besto' AND lname = 'friendo') WHERE dnum = 20;

UPDATE department SET mgrssn = (SELECT ssn FROM employee WHERE fname = 'noha' AND lname = 'mohamed') WHERE dnum = 100;

UPDATE department SET mgrssn = (SELECT ssn FROM employee WHERE fname = 'Ahmad' AND lname = 'Othman') WHERE mgrssn = (SELECT ssn FROM employee WHERE fname = 'kamel' AND lname = 'mohamed');

UPDATE employee SET superssn = (SELECT ssn FROM employee WHERE fname = 'Ahmad' AND lname = 'Othman') WHERE superssn = (SELECT ssn FROM employee WHERE fname = 'kamel' AND lname = 'mohamed');

DELETE FROM employee
WHERE
  fname = 'kamel'
  AND lname = 'mohamed';

UPDATE employee SET dno = 10, salary = salary * 1.20 WHERE fname = 'Ahmad' AND lname = 'Othman';
