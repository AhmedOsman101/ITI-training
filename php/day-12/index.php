<?php declare(strict_types=1); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Day 12</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css" />
  <style>
    body {
      min-height: 100vh;
      max-width: 1000px;
    }

    pre>code {
      font-size: 1rem;
      padding-left: 1.2rem;
    }

    td {
      border-bottom: 1px solid #526980;
    }
  </style>
</head>

<body>


  <?php

  require 'vendor/autoload.php';
  require_once __DIR__ . '/../utils.php';

  heading(3, "1. Print 'Welcome to php'");
  println("Welcome to php");

  $x = 5;
  $y = 'Welcome';
  $z = true;

  heading(3, "2, 3, 6. Display the type of each variable");
  println(
    gettype($x),
    gettype($y),
    gettype($z),
  );

  heading(3, "method 1 (for loop)");
  preStart();
  for ($i = 0; $i <= 15; $i++) echo "$i ";
  preEnd();

  heading(3, "method 2 (while loop)");
  preStart();

  $i = 0;
  while ($i <= 15) {
    echo "$i ";
    $i++;
  }
  preEnd();

  // 5. define a constant
  const INSTITUTE = 'ITI';

  // 7. isset
  println(
    isset($x),
    isset($y),
    isset($z),
  );

  // 8. empty
  println(
    empty($x),
    empty($y),
    empty($z),
  );

  // 9. add m and n
  $result = 5 + 6;
  println($result > 50 ? 'Accepted' : 'Not accepted');

  // 11. number to string
  function numberToString(int|float $number): string {
    return (string) $number;
    // or return strval($number)
    // or return "$number"
  }
  ?>

  <?php $data = [
    ["name" => "A", "salary" => 1000],
    ["name" => "B", "salary" => 1200],
    ["name" => "C", "salary" => 1400],
  ] ?>

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Salary</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i = 0; $i < count($data); $i++): ?>
        <?php $user = $data[$i] ?>
        <tr>
          <td>Salary for Mr. <?= $user["name"] ?></td>
          <td><?= $user["salary"] ?>$</td>
        </tr>
      <?php endfor; ?>
    </tbody>
  </table>
</body>

</html>
