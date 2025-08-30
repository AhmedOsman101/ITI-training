<?php declare(strict_types=1);

require_once __DIR__ . '/../src/utils.php';

use App\DB;

$css = <<<CSS
main {
  padding: 1.2rem !important;
}

a {
  text-decoration: none;
  font-size: 1.2rem;
}

.head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 1rem;
}
CSS;

bodyStart(title: "Day 15 - Show", useWater: false, styles: $css);

$sql = <<<SQL
SELECT s.id, s.name, s.email, s.image, d.name AS department
FROM students s
JOIN departments d
ON s.department_id = d.id
SQL;

$students = DB::readQuery($sql);

?>

<main>
  <section class="head">
    <h1>Students CRUD</h1>
    <button type="button" onclick="window.location.href='/create.php'">
      Create Student
    </button>
  </section>
  <section class="overflow-auto">
    <table class="striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Department</th>
          <th scope="col">Image</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($students as $student): ?>
          <tr>
            <th scope="row"><?= $student->id ?></th>
            <td><?= $student->name ?></td>
            <td><?= $student->email ?></td>
            <td><?= $student->department ?></td>
            <td>
              <img class="fixed-img" src="<?= $student->image ?>" alt="<?= $student->image ? "Loading..." : "None" ?>">
            </td>
            <td>
              <div class="grid">
                <a href="edit.php?id=<?= $student->id ?>">  </a>
                <a href="delete.php?id=<?= $student->id ?>" style="color: #964a50;"> 󰆴 </a>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </section>
</main>

<?php
bodyEnd();
?>
