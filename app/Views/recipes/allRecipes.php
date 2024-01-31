
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
        <?php foreach ($Recipes as $recipe): ?>
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