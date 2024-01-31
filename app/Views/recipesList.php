<?php
namespace Manger\Views;
class RecipesList
{
    function listRecipes($Recipes)
    { 
        ob_start();
        require VIEWSDIR.DS .'recipes'.DS.'allRecipes.php';
        $out = ob_get_contents();
        return $out;
    }
}