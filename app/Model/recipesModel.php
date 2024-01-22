<?php 
class RecipesModel{

function getRecipesList()
{
    $pdo = new PDO("mysql:host=localhost;dbname=ntierprojet","root", "");
    return $pdo->query('SELECT * FROM recipes')->fetchAll(PDO::FETCH_OBJ);
    
}

}