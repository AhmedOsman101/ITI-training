<?php declare(strict_types=1);

require_once __DIR__ . '/../src/utils.php';

$styles = <<<CSS
label {
  display: flex;
  align-items: center;
  gap: 10px;
  justify-content: space-between;
}

label p {
  width: 15%;
}

input, select {
  width: 100%;
}
CSS;

bodyStart("Day 14 - Task 2", $styles);
?>

<h1>Add User</h1>

<form action="action.php" method="POST" enctype="multipart/form-data" novalidate>

  <label>
    <p>Name</p>
    <input type="text" name="name">
  </label>

  <label>
    <p>Email</p>
    <input type="email" name="email">
  </label>

  <label>
    <p> Password </p>
    <input type="password" name="password">
  </label>

  <label>
    <p> Confirm password </p>
    <input type="password" name="confirmPass">
  </label>

  <label>
    <p>Room No.</p>
    <select name="room">
      <option value="">Select a room</option>
      <option value="Application1">Application1</option>
      <option value="Application2">Application2</option>
      <option value="Cloud">Cloud</option>
    </select>
  </label>

  <label>
    <p> Profile picture </p>
    <input type="file" name="image" />
  </label>


  <button type=" submit">Save</button>
  <button type="reset">Reset</button>
</form>

<?php bodyEnd();
