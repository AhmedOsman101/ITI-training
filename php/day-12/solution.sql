-- 10. Display the Department id, name and id and the name of its manager.
SELECT
  d.dnum,
  d.dname,
  e.ssn,
  CONCAT (e.fname, ' ', e.lname) AS "Name"
FROM
  department d
  JOIN employee e ON e.ssn = d.mgrssn;

-- 11. Display the name of the departments and the name of the projects under its control.
SELECT d.dname, p.pname
FROM department d
JOIN project p ON p.dnum = d.dnum;

-- 12. Display the full data about all the dependence associated with the name of the employee they depend on him/her.
SELECT
  CONCAT (e.fname, ' ', e.lname) AS "Name",
  d.*
FROM
  dependent d
  JOIN employee e ON d.essn = e.ssn;

-- 13. Display:
-- a. The name and the gender of the dependence that's gender is Female and depending on Female Employee.
SELECT
  CONCAT (e.fname, ' ', e.lname) AS "Name",
  d.dependent_name,
  d.gender
FROM
  dependent d
  JOIN employee e ON d.essn = e.ssn
WHERE
  d.gender = "f"
  AND e.gender = "f"; -- There is none btw.

-- b. And the male dependence that depends on Male Employee.
SELECT
  CONCAT (e.fname, ' ', e.lname) AS Name,
  d.dependent_name,
  d.gender
FROM
  dependent d
  JOIN employee e ON d.essn = e.ssn
WHERE
  d.gender = "m"
  AND e.gender = "m";

-- 18. Retrieve the names of all employees in department 10 who works more than or equal 10 hours on "AL Rabwah" project.
SELECT
  CONCAT (e.fname, ' ', e.lname) AS Name
FROM
  employee e
  JOIN works_for w ON w.essn = e.ssn
WHERE
  e.dno = 10
  AND w.pno = (
    SELECT
      project.pnumber
    FROM
      project
    WHERE
      project.pname = 'AL rabwah'
  )AND w.hours >= 10; -- There is none also

-- 19. Find the names of the employees who directly supervised with Kamel Mohamed.
-- NOTE: Kamel was deleted in the last lab, I will replace him with another employee
SELECT CONCAT (fname, ' ', lname) AS Name
FROM employee
WHERE superssn = (
  SELECT ssn FROM employee
  WHERE fname = 'Ahmad' AND lname = 'Othman'
);

-- 20. For each project, list the project name and the total hours (for all employees) spent on that project.
SELECT
  p.pname,
  SUM(w.hours) AS "Total Hours"
FROM works_for w
JOIN project p ON w.pno = p.pnumber
GROUP BY p.pnumber;

-- 21. Retrieve the names of all employees who work in every project sorted.
SELECT DISTINCT CONCAT(e.fname, ' ', e.lname) AS Name
FROM employee e
JOIN works_for w ON w.essn = e.ssn
ORDER BY Name;


-- 24. List the name of all managers who have no dependents.
SELECT CONCAT(e.fname, ' ', e.lname) AS Name
FROM employee e
JOIN department d ON e.ssn = d.mgrssn
LEFT JOIN dependent dep ON dep.essn = e.ssn
WHERE dep.essn IS NULL
ORDER BY Name;

-- 25. Retrieve a list of employees and the projects they are working on ordered by department and within each department ordered alphabetically by last name, first name.
SELECT
  d.dname AS Department,
  CONCAT (e.fname, ' ', e.lname) AS Employee,
  p.pname AS Project
FROM employee e
JOIN department d ON e.dno = d.dnum
JOIN works_for w ON e.ssn = w.essn
JOIN project p ON w.pno = p.pnumber
ORDER BY d.dname, e.lname, e.fname;

-- 26. For each project located in Cairo City, find the project number, project name the controlling department name, the department manager last name, address and birthdate.
SELECT
  p.pnumber AS ProjectNumber,
  p.pname AS ProjectName,
  d.dname AS DepartmentName,
  m.lname AS ManagerLastName,
  m.address AS ManagerAddress,
  m.bdate AS ManagerBirthdate
FROM project p
JOIN department d ON p.dnum = d.dnum
JOIN employee m ON d.mgrssn = m.ssn
WHERE p.city = 'cairo';
