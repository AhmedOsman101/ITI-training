<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" href="assets/index.css">
</head>

<body class="grid place-items-center mx-auto">
  <?php include_once __DIR__ . "/components/navbar.php" ?>

  <section class="flex flex-col space-y-16 mt-10 px-20 py-5 justify-center items-center">
    <div class="flex justify-center flex-col items-center gap-5">
      <h2 class="capitalize font-extrabold text-4xl">fresh fruits</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam repellat esse ea? Non, eius!</p>
    </div>

    <?php
    $fruite = "orange";
    include __DIR__ . "/components/fruite.php";
    ?>

    <?php
    $fruite = "grapes";
    include __DIR__ . "/components/fruite.php";
    ?>

    <?php
    $fruite = "guava";
    include __DIR__ . "/components/fruite.php";
    ?>
  </section>

  <?php include_once __DIR__ . "/components/footer.php" ?>
</body>

</html>
