<?php declare(strict_types=1);

require_once __DIR__ . '/../utils.php';

$styles = <<<EOF
label {
  display: flex;
  align-items: center;
  gap: 10px;
  justify-content: space-between;
}

label p {
  width: 15%;
}

input, select, textarea {
  width: 100%;
}
EOF;

bodyStart("Day 13 - Task 2", $styles);
?>


<form action="action.php" method="POST">
  <label>
    <p>
      First Name
    </p>
    <input type="text" name="firstName">
  </label>

  <label>
    <p>Last Name</p>
    <input type="text" name="lastName">
  </label>

  <label>
    <p>Address</p>
    <textarea name="address"></textarea>
  </label>

  <label>
    <p>Country</p>
    <select name="country">
      <option value="">Select Country</option>
      <option value="eg">Egypt</option>
      <option value="us">USA</option>
      <option value="jp">Japan</option>
    </select>
  </label>

  <label>
    <p>Gender</p>
    <p>
      <input type="radio" name="gender" value="m">
      Male
    </p>
    <p>
      <input type="radio" name="gender" value="f">
      Female
    </p>
  </label>

  <label>
    <p>skills</p>
    <p>
      <input type="checkbox" name="skills[]" value="PHP">
      PHP
    </p>
    <p>
      <input type="checkbox" name="skills[]" value="JS">
      JS
    </p>
    <p>
      <input type="checkbox" name="skills[]" value="MySQL">
      MySQL
    </p>
    <p>
      <input type="checkbox" name="skills[]" value="Postgres">
      Postgres
    </p>
  </label>

  <label>
    <p>
      Username
    </p>
    <input type="text" name="username">
  </label>

  <label>
    <p>
      Password
    </p>
    <input type="password" name="password">
  </label>

  <label>
    <p>
      Department
    </p>
    <input type="text" name="department" placeholder="OpenSource">
  </label>


  <button type="submit">Submit</button>
  <button type="reset">Reset</button>
</form>

<?php bodyEnd();
