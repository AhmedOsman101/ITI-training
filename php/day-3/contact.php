<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" href="assets/index.css">
</head>

<body class="grid place-items-center mx-auto">
  <?php include_once __DIR__ . "/components/navbar.php" ?>

  <section class="flex space-y-16 mt-10 px-20 pr-0 py-5 justify-between items-center w-full" id="contact-us">
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

  <?php include_once __DIR__ . "/components/footer.php" ?>
</body>

</html>
