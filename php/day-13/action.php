<?php declare(strict_types=1);

require __DIR__ . '/../utils.php';

bodyStart("Day 13 - Task 2 - Result");

$errors = [];

// Validation rules
$rules = [
  'firstName'  => ['required' => true, 'type' => 'string'],
  'lastName'   => ['required' => true, 'type' => 'string'],
  'address'    => ['required' => false, 'type' => 'string'],
  'country'    => ['required' => true, 'type' => 'string'],
  'gender'     => ['required' => true, 'type' => 'string', 'in' => ['f', 'm']],
  'skills'     => ['required' => false, 'type' => 'array'],
  'username'   => ['required' => true, 'type' => 'string'],
  'password'   => ['required' => true, 'type' => 'string', 'min' => 8],
  'department' => ['required' => true, 'type' => 'string'],
];

function validate(array $rules, array &$errors): void {
  // Validation loop
  foreach ($rules as $field => $rule) {
    $value = $_POST[$field] ?? null;

    if ($rule['required'] && empty($value)) {
      $errors[$field] = 'This field is required.';
      continue;
    }

    if ($value !== null) {
      switch ($rule['type']) {
        case 'string':
          if (!is_string($value)) {
            $errors[$field] = 'Must be a string.';
            break;
          }
          if (isset($rule['min']) && strlen($value) < $rule['min']) {
            $errors[$field] = "Must be at least {$rule['min']} characters.";
            break;
          }
          break;

        case 'array':
          if (!is_array($value)) {
            $errors[$field] = 'Must be an array.';
          }
          break;
      }

      if (isset($rule['in']) && !in_array($value, $rule['in'], true)) {
        $errors[$field] = 'Invalid value.';
        continue;
      }
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  validate($rules, $errors);

  if ($errors) {
    println($errors);
  } else {
    ?>
    <h2>
      Thanks
      <?= $_POST['gender'] === 'm' ? 'Mr.' : 'Miss' ?>
      <?= htmlspecialchars($_POST['firstName']) . ' ' . htmlspecialchars($_POST['lastName']) ?>
    </h2>

    <h3>Please Review Your Information:</h3>
    <p>Name: <?= htmlspecialchars($_POST['firstName']) . ' ' . htmlspecialchars($_POST['lastName']) ?></p>
    <p>Address: <?= htmlspecialchars($_POST['address'] ?? '') ?></p>

    <p>Your Skills: </p>
    <?php if (!empty($_POST['skills']) && is_array($_POST['skills'])): ?>
      <ul>
        <?php foreach ($_POST['skills'] as $skill): ?>
          <li><?= htmlspecialchars($skill) ?></li>
        <?php endforeach ?>
      </ul>
    <?php else: ?>
      <p>No skills selected.</p>
    <?php endif ?>

    <p>Department: <?= htmlspecialchars($_POST['department']) ?></p>
    <?php
  }
}

bodyEnd();
