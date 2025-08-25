<?php declare(strict_types=1);

require_once __DIR__ . '/../utils.php';

bodyStart("Day 13 - Task 1");

echo '<button><a href="form.php" target="_blank">Form</a></button>';

$arr = ["PHP", "Open Source", "ITI", "Day-13", "Arrays"];

heading(3, "method 1 (for loop)");
preStart();
for ($i = 0; $i < sizeof($arr); $i++) echo "'{$arr[$i]}' ";
preEnd();

heading(3, "method 2 (for-each loop)");
preStart();
foreach ($arr as $item) echo "'$item' ";
preEnd();

$info = [
  "Name"    => "Ahmad Othman",
  "Age"     => 20,
  "Email"   => 'ahmad.ali.othman@outlook.com',
  "College" => 'NCTU',
];

heading(3, "info - not sorted");
println($info);

heading(3, "info - using asort() -> asc by value");
asort($info);
println($info);

heading(3, "info - using arsort() -> desc by value");
arsort($info);
println($info);

heading(3, "info - using ksort() -> asc by key");
ksort($info);
println($info);

heading(3, "info - using krsort() -> desc by key");
krsort($info);
println($info);

heading(3, 'using array_keys($info) -> only keys');
println(array_keys($info));

bodyEnd();
