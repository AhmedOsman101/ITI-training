# Select and Aggregate Queries

## 1. Display all the employees Data.

```sql
SELECT * FROM employee;
```

## 2. Display the employee First name, last name, Salary and Department number.

```sql
SELECT fname,lname, salary, dno FROM employee;
```

## 3. Display all the projects names, locations and the department number which is responsible about it.

```sql
SELECT pname, plocation, dnum From project;
```

## 4. If you know that the company policy is to pay an annual commission for each employee which specific percent equals 10% of his/her annual salary.

Display each employee full name and his annual commission in an ANNUAL COMM column (alias).

```sql
SELECT
  CONCAT (fname, ' ', lname) AS "Full Name",
  TRUNCATE (salary * 1.10, 2) AS "ANNUAL COMM"
FROM
  employee;
```

## 5. Display the employees Id, name who earns more than 1000 LE monthly.

```sql
SELECT
  ssn,
  CONCAT (fname, ' ', lname) AS "Full Name",
  salary
FROM
  employee
WHERE
  salary > 1000;
```

## 6. Display the employees Id, name who earns more than 10000 LE annually.

```sql
SELECT
  ssn,
  CONCAT (fname, ' ', lname) AS "Full Name",
  salary * 12
FROM
  employee
WHERE
  (salary * 12) > 10000;
```

## 7. Display the names and salaries of the female employees.

```sql
SELECT
  CONCAT (fname, ' ', lname) AS "Full Name",
  salary
FROM
  employee
WHERE
  gender = 'f';
```

## 8. Display each department id, name which managed by a manager with id equals 968574.

```sql
SELECT dnum, dname
FROM department
WHERE department.mgrssn = 968574;
```

## 9. Display the ids, names and locations of the projects which controlled with department 10.

```sql
SELECT pnumber, pname, plocation
FROM project
WHERE dnum = 10;
```

## 14. Display the full data of the employees who is managing any of the company's departments.

```sql
SELECT
  e.ssn,
  CONCAT (fname, ' ', lname) AS "Full Name",
  d.dname,
  e.superssn,
  e.bdate,
  e.address,
  e.gender,
  e.salary,
  e.dno
FROM
  employee e
  JOIN department d ON e.ssn = d.mgrssn;
```

## 15. Display the Id, name and location of the projects in Cairo or Alex city.

```sql
SELECT pnumber, pname, plocation
FROM project
WHERE city IN ("cairo", "alex");
```

## 16. Display the Projects full data of the projects with a name starts with "a" letter.

```sql
SELECT *
FROM project
WHERE pname LIKE "a%";
```

## 17. Display all the employees in department 30 whose salary from 1000 to 2000 LE monthly.

```sql
SELECT *
FROM employee
WHERE dno = 30 AND salary BETWEEN 1000 AND 2000;
```

## 22. Display the data of the department which has the smallest employee ID over all employees' ID.

```sql
SELECT d.*
FROM department d
JOIN employee e ON d.dnum = e.dno
WHERE e.ssn = ( SELECT MIN(ssn) FROM employee );
```

## 23. For each department, retrieve the department name and the maximum, minimum and average salary of its employees.

```sql
SELECT
  d.dname,
  MIN(e.salary) AS "MIN Salary",
  MAX(e.salary) AS "MAX Salary",
  TRUNCATE (AVG(e.salary), 2) AS "AVG Salary"
FROM
  department d
  JOIN employee e ON e.dno = d.dnum
GROUP BY
  d.dname;
```

---

# Data Manipulating Language

## 1. Insert your personal data to the employee table as a new employee in department number 30, SSN = 102672, Superssn = 112233.

```sql
INSERT INTO
  employee ( fname, lname, ssn, bdate, address, gender, salary, superssn, dno )
VALUES
  ( 'Ahmad', 'Othman', 102672, '2005-12-15', 'Nasr City, Cairo', 'm', '9999.00', 112233, 30 );
```

## 2. Insert another employee with personal data your friend as new employee in department number 30, SSN = 102660 but don’t enter any value for salary or super number to him.

```sql
INSERT INTO
  employee (fname, lname, ssn, bdate, address, gender, dno)
VALUES
  ('besto', 'friendo', 102660, '2005-12-15', 'Nasr City, Cairo', 'm', 30);
```

## 3. In the department table insert new department called "DEPT IT" , with id 100, employee with SSN = 112233 as a manager for this department.

The start date for this manager is '2006-11-01'

```sql
INSERT INTO
  department (dname, dnum, mgrssn, mgrstartdate)
VALUES
  ('DEPT IT', 100, 112233, '2006-11-01');
```

## 4. Do what is required if you know that : Mrs.Noha Mohamed moved to be the manager of the new department (id = 100), and they give your friend her position

a. First try to update her record in your database.

```sql
-- Set department number for Noha
UPDATE employee
SET dno = 100
WHERE ssn = (SELECT ssn FROM employee WHERE fname = 'noha' AND lname = 'mohamed');

-- Set department number for my friend
UPDATE employee
SET dno = 20
WHERE ssn = (SELECT ssn FROM employee WHERE fname = 'besto' AND lname = 'friendo');
```

b. Update your friend record to be department 20 manager.

```sql
-- First make my friend the manager for department 20
UPDATE department
SET mgrssn = (SELECT ssn FROM employee WHERE fname = 'besto' AND lname = 'friendo')
WHERE dnum = 20;

-- Then make Noha the manager for department 100
UPDATE department
SET mgrssn = (SELECT ssn FROM employee WHERE fname = 'noha' AND lname = 'mohamed')
WHERE dnum = 100;
```

## 5. Unfortunately the company ended the contract with Mr.Kamel Mohamed so try to delete his data from your database in case you know that you will be temporary in his position.

```sql
-- First take Kamel's place
-- In department table
UPDATE department
SET mgrssn = (SELECT ssn FROM employee WHERE fname = 'Ahmad' AND lname = 'Othman')
WHERE mgrssn = (SELECT ssn FROM employee WHERE fname = 'kamel' AND lname = 'mohamed');

-- In employee table
UPDATE employee
SET superssn = (SELECT ssn FROM employee WHERE fname = 'Ahmad' AND lname = 'Othman')
WHERE superssn = (SELECT ssn FROM employee WHERE fname = 'kamel' AND lname = 'mohamed');

-- Then delete him
-- This will also delete his dependants (CASCADE ON DELETE)
DELETE FROM employee
WHERE
  fname = 'kamel'
  AND lname = 'mohamed';
```

## 6. And your salary has been upgraded by 20 precent of its last

```sql
UPDATE employee
SET dno = 10, salary = salary * 1.20
WHERE fname = 'Ahmad' AND lname = 'Othman';
```
