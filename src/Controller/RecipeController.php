<?php

namespace Manger\Controller;

use Manger\Model\RecipeModel;

class RecipeController
{
    /**
     * showRecipes
     *
     * @return void
     */
    public function showRecipes()
    {
        // Instanciez le modèle
        $recipeModel = new RecipeModel();

        // Récupérez les données du modèle
        $data = $recipeModel->getData();

        // Affichez la vue avec les données
        include __DIR__ . '/../Views/recipe.php';
    }

    /**
     * showRecipesJSON
     *
     * @return void
     */
    public function showRecipesJSON()
    {

        // Chemin vers le fichier JSON
        $jsonFile = __DIR__ . '/../../database/recipes.json';

        // Lire le contenu du fichier JSON
        $jsonContent = file_get_contents($jsonFile);

        // Décoder le contenu JSON en tableau associatif
        $data = json_decode($jsonContent, true);

        // Inclure la vue avec les données
        include __DIR__ . '/../Views/recipe_json.php';
    }
}
