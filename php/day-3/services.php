<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" href="assets/app.css">
</head>

<body class="grid place-items-center mx-auto">
  <?php include_once __DIR__ . "/components/navbar.php" ?>

  <section class="flex flex-col space-y-10 mt-10 px-20 py-5 justify-center items-center">
    <h2 class="capitalize font-extrabold text-4xl">our services</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam repellat esse ea? Non, eius!</p>

    <div class="flex gap-5 justify-evenly">
      <?php
      $name = "Orange";
      $index = 1;
      include __DIR__ . "/components/card.php";
      ?>
      <?php
      $name = "Grapes";
      $index = 2;
      include __DIR__ . "/components/card.php";
      ?>
      <?php
      $name = "Guava";
      $index = 3;
      include __DIR__ . "/components/card.php";
      ?>
    </div>
  </section>

  <button
    class="mx-auto bg-black text-white hover:text-black hover:bg-white transition-colors px-6 py-3 border font-semibold my-7 mt-9">
    Read More
  </button>


  <?php include_once __DIR__ . "/components/footer.php" ?>
</body>

</html>
