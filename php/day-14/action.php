<?php declare(strict_types=1);

require __DIR__ . '/../utils.php';

bodyStart("Day 14 - Task 2 - Result");

$errors = [];

// Validation rules
$fields = [
  'name',
  'email',
  'password',
  'confirmPass',
  'room',
];

$roomOptions = ["Application1", "Application2", "cloud"];

function validate(array $fields, array &$errors): void {
  global $roomOptions;

  // Validation loop
  foreach ($fields as $field) {
    $value = $_POST[$field] ?? null;

    if ($value === null || empty($value)) {
      $errors[$field] = "$field is required";
      continue;
    }

    if ($field === "email" && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $errors[$field] = "You must enter a valid email";
    }

    if ($field === "password" && strlen($value) < 8) {
      $errors[$field] = "Password must be at least 8 characters";
    }

    if ($field === "confirmPass" && $value !== $_POST["password"]) {
      $errors[$field] = "Passwords doesn't match";
    }

    if (
      $field === "room" &&
      !in_array($value, $roomOptions, strict: true)
    ) {
      $errors[$field] = "Room can only be one of " . implode(', ', $roomOptions);
    }
  }
}

function validateImage(array $file, array &$errors): array|bool {
  $name = $file['name'];
  $size = $file['size'];
  $tempName = $file['tmp_name'];
  $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

  if ($file['error'] !== UPLOAD_ERR_OK) {
    $errors["image"] = "Upload failed with error code {$file['error']}";
    return false;
  }

  if (
    !in_array(
      $extension,
      ['jpg', 'jpeg', 'png'],
      strict: true
    )
  ) {
    $errors["image"] = "Invalid file extension: '$extension'";
    return false;
  }

  // NOTE: size is in bytes, 2 * 1024 * 1024 = 2MBs
  if ($size > 2 * 1024 * 1024) {
    $errors['image'] = "File too large.";
    return false;
  }

  return compact("tempName", "extension");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['image'])) {
  validate($fields, $errors);

  $image = validateImage($_FILES['image'], $errors);

  if (is_array($image)) {
    $uploadDir = __DIR__ . "/uploads";
    $safeName = time() . ".{$image['extension']}";
    move_uploaded_file($image['tempName'], "$uploadDir/$safeName");
  }

  if ($errors) {
    println($errors);
    // foreach ($errors as $field => $error) tag("p", $error);
  } else {
    echo "<h2>User " . htmlspecialchars($_POST['name']) . " saved successfully</h2>";
    echo "<img src=\"uploads/$safeName\" />";
  }
}

bodyEnd();
