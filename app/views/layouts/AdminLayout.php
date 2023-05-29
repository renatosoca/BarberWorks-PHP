<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title . ' | Administración' ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
  <link rel="icon" href="/favicon.svg">
  
  <?= vite("main.ts") ?>
</head>
<body>
  <div class="flex flex-col min-h-screen animate-fadeIn bg-gray-950">
    <?php include_once __DIR__.'/../templates/header.php' ?>
  
    <div class="max-w-[80rem] w-full mx-auto flex-1 flex h-full">
      <?php echo $content; ?>
    </div>
  </div>
    
  <?php echo $script ?? ''; ?>
</body>
</html>