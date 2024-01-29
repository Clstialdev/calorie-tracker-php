<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>list des recette</title>
</head>
<body>
<table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>calories number</th>
            <th>image url</th>
            
        </tr>

        </thead>
        <tbody>
        <?php foreach ($recipes as $recipe): ?>
            <tr>
                <td><?= $recipe->id ?></td>
                <td><?= $recipe->name?></td>
                <td><?= $recipe->calories?></td>
                <td><?= $recipe->image_url?></td>
              
               
              
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </body>