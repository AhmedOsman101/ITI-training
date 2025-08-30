<?php declare(strict_types=1);

require_once __DIR__ . '/../src/utils.php';

use App\DB;

$studentModel = new DB("students");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    $student = $studentModel->find($id);

    if (isset($student) && $student->image !== null) {
      $image = __DIR__ . $student->image;
      if (file_exists($image)) unlink($image);
    }

    $studentModel->delete($id);
  } else {
    tag("script", "alert('Invalid ID')");
    die;
  }

  header("Location: /");
  die;
}
