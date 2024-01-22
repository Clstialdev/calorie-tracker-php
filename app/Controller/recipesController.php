<?php
 require_once 'app/Model/recipesModel.php';
 
class RecipesController{



function recipesCont()
{
    $obj= New RecipesModel();
    $recipes = $obj->getRecipesList();
    require_once 'app/Views/recipesList.php';
    require_once 'app/views/addRecipe.php';
}
}