<!-- src/Views/recipe_json.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Page - JSON Data</title>
</head>

<body>
    <h1>Liste des Recettes depuis JSON</h1>
    <ul>
        <?php foreach ($data['recipes'] as $recipe) : ?>
            <li>
                <h2><?php echo $recipe['name']; ?></h2>
                <p>Ingrédients: <?php echo implode(', ', $recipe['ingredients']); ?></p>
                <p>Instructions: <?php echo $recipe['instructions']; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>