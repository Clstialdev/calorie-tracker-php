<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Page</title>
</head>
<body>
    <h1>Liste des Recettes</h1>
    <ul>
        <?php foreach ($data as $recipe): ?>
            <li><?php echo $recipe; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
