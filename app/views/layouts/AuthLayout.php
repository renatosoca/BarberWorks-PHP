<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title . ' | Title' ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
  <!-- <link rel="stylesheet" href="/src/css/app.css"> -->
  <?= vite("main.ts") ?>
</head>
<body>
  <div class="grid grid-cols-12 min-h-screen animate-fadeIn">
    <div class="col-span-6 h-full">
      <img
        class="h-full w-full object-cover"
        src="/images/1.jpg"
        alt="Image Hero Login"
      >
    </div>
  
    <div class="col-span-6 h-full bg-black text-white flex flex-col justify-center items-center ">
      <?php echo $content; ?>
    </div>
  </div>

  <?php echo $script ?? ''; ?>
</body>
</html>