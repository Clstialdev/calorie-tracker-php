<?php
namespace Manger\Controller;

use Manger\Model\RecipesModel; // fonctionnel
use Manger\Views\RecipesList;
 
class RecipesController{

    private $modelObj;
    private $viewObj;

    public function __construct()
    {
        $this->modelObj= New RecipesModel();
        $this->viewObj= New RecipesList ();
    }

function recipesCont()
{
  
    $Recipes = $this->modelObj->getRecipesList();

   
    
    require_once 'app/Views/recipesList.php';
    
   // require_once 'app/Views/addRecipe.php';
}

function addNewRecipe() {

    $name = filter_var(trim($_POST['name'] ?? ''), FILTER_SANITIZE_EMAIL);
    $calories= trim($_POST['calories'] ?? '');
    $image_url = trim($_POST['image_url'] ?? '');

    // Initialize data.............
    $data = [
        'name' => $name,
        'calories' => $calories,
        'image_url' => $image_url
    ];
   
   if($this->modelObj->addRecipe($data))
    {
        echo json_encode(['success' =>true]);
        exit;
    }
    else{
        echo json_encode(['success' =>false,'message'=>"there is a probleme to add"]);
        exit;
    };
}
}