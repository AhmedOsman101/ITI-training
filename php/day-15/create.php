<?php declare(strict_types=1);

require_once __DIR__ . '/../src/utils.php';

use App\DB;

$css = <<<CSS
main {
  padding-top: 2rem !important;
}

.head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 1rem;
}
CSS;

bodyStart(title: "Day 15 - Create", useWater: false, styles: $css);

$studentModel = new DB("students");

$departments = (new DB("departments"))->all();

$departmentIds = array_map(fn($dep): int => $dep->id, $departments);

$errors = [];

// Validation rules
$fields = [
  'name',
  'email',
  'department_id',
];

function validate(array $data, array &$errors, array $departmentIds) {
  foreach ($data as $field => $value) {
    if ($value === null || empty($value)) {
      $errors[$field] = "$field is required";
      continue;
    }

    if ($field === "email" && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $errors[$field] = "You must enter a valid email";
    }

    if ($field === "department_id") {
      if (!filter_var($value, FILTER_VALIDATE_INT) || !in_array($value, $departmentIds, strict: false)) {
        $errors[$field] = "Invalid department";
      }
    }
  }
}

function old(string $key, mixed $default = '') {
  if (isset($_REQUEST[$key])) return $_REQUEST[$key];
  return $default;
}

function validateImage(array $file, array &$errors): array|bool {
  $name = $file['name'];
  $size = $file['size'];
  $tempName = $file['tmp_name'];
  $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

  if ($file['error'] === UPLOAD_ERR_NO_FILE) return false;


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

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $data = [];
  foreach ($fields as $key) {
    if (isset($_REQUEST[$key])) $data[$key] = trim($_REQUEST[$key]);
  }

  validate($data, $errors, $departmentIds);

  if (isset($_FILES['image'])) {
    $image = validateImage($_FILES['image'], $errors);

    if (is_array($image)) {
      $uploadDir = __DIR__ . "/uploads";
      if (!is_dir($uploadDir)) mkdir($uploadDir);
      $safeName = time() . ".{$image['extension']}";
      move_uploaded_file($image['tempName'], "$uploadDir/$safeName");
      $data["image"] = "/uploads/$safeName";
    }
  } else $data["image"] = null;

  if (!sizeof($errors)) {
    $result = $studentModel->create($data);
    if ($result) {
      tag(
        "script",
        <<<JS
        Swal.fire({
          title: "Success",
          icon: "success"
        }).then(() => {
          window.location.href = "/";
        });
      JS
      );
    } else {
      println("Bad Request...");
      die();
    }
  }
}

?>

<main class="container">
  <section class="head">
    <h1>Create Student</h1>
    <button type="button" onclick="window.location.href='/'">
      Go back
    </button>
  </section>

  <section>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
      <label for="name">
        Name
        <input type="text" id="name" name="name" value="<?= old('name') ?>"
          aria-invalid="<?= isset($errors['name']) ? 'true' : '' ?>">
        <small><?= $errors['name'] ?? '' ?></small>
      </label>

      <label for="email">
        Email
        <input type="email" id="email" name="email" value="<?= old('email') ?>"
          aria-invalid="<?= isset($errors['email']) ? 'true' : '' ?>">
        <small><?= $errors['email'] ?? '' ?></small>
      </label>

      <label for="image">
        Image
        <input type="file" id="image" name="image" aria-invalid="<?= isset($errors['image']) ? 'true' : '' ?>">

        <small><?= $errors['image'] ?? '' ?></small>
      </label>

      <label for="department">
        Department
        <select id="department" name="department_id"
          aria-invalid="<?= isset($errors['department_id']) ? 'true' : '' ?>">
          <option value="">Select a department</option>

          <?php foreach ($departments as $dept): ?>
            <option value="<?= $dept->id ?>">
              <?= $dept->name ?>
            </option>
          <?php endforeach ?>
        </select>
        <small><?= $errors['department_id'] ?? '' ?></small>
      </label>

      <button type="submit">Create</button>
    </form>
  </section>
</main>

<?php
bodyEnd();
?>
