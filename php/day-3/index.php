<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Day 3</title>
  <link rel="stylesheet" href="assets/index.css">
</head>

<body class="grid place-items-center mx-auto">
  <?php
  include_once __DIR__ . "/components/navbar.php";
  include_once __DIR__ . "/components/hero.php";
  ?>

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

  <p class="bg-image bg-center bg-cover text-9xl uppercase font-extrabold py-40 w-full text-center my-5 text-white">
    very tasty fruits
  </p>

  <section class="flex flex-col space-y-16 mt-10 px-20 py-5 justify-center items-center">
    <div class="flex justify-center flex-col items-center gap-5">
      <h2 class="capitalize font-extrabold text-4xl">
        Testimonial
      </h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam repellat esse ea? Non, eius!</p>
    </div>

    <div class="flex flex-col items-center justify-center gap-5">
      <img src="assets/imgs/client.png" alt="client">
      <p class="text-center text-3xl">Johnhex</p>
      <p class="text-center">
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem quod officiis
        ducimus illum adipisci, sunt odit molestias earum iure tempora labore repudiandae nisi delectus nihil
        necessitatibus enim vel modi! Illum.
      </p>
    </div>
  </section>

  <section class="flex space-y-16 mt-10 pl-20 pr-0 py-5 justify-between items-center w-full">
    <div class="flex flex-col gap-10 w-1/2">
      <h2 class="text-4xl font-semibold capitalize">Contact Us</h2>
      <form class="flex flex-col gap-5">
        <input type="text" placeholder="Name" class="outline-0 ring-0 border-b-black border-b">
        <input type="text" placeholder="Phone Number" class="outline-0 ring-0 border-b-black border-b">
        <input type="text" placeholder="Email" class="outline-0 ring-0 border-b-black border-b">
        <textarea name="message" id="message" placeholder="Message"
          class="outline-0 ring-0 border-b-black border-b"></textarea>
        <button type="submit" class="bg-amber-600 px-14 py-3 font-semibold w-fit text-white">SEND</button>
      </form>
    </div>
    <img src="assets/imgs/orange-dish.png" alt="orange-dish">
  </section>
  <?php
  include_once __DIR__ . "/components/footer.php";
  ?>
</body>

</html>
