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

  <?php include __DIR__. '/../templates/header.php' ?>

  <div>
    <?php echo $content; ?>
  </div>

  <?php echo $script ?? ''; ?>
</body>
</html>