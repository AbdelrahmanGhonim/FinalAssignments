<?php
namespace App\Controllers;

use App\Services\NutritionFactsService;

class NutritionFactController{

private $nutritionFactService;

    // initialize services
    function __construct()
    {
        $this->nutritionFactService = new NutritionFactsService();
    }
    
      public function index()
      {
              
        try {
          header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
          header("Access-Control-Allow-Headers: Content-Type");
          header("Access-Control-Allow-Methods: GET");
          header("Content-Type: application/json");

          session_start();

            if(isset($_SESSION["goal"])){
              $userGoal = $_SESSION["goal"];
             // echo $userGoal." in controller     ";
              $nutritionFacts = $this->nutritionFactService->processUserGoal($userGoal);
              echo json_encode($nutritionFacts);
            }
            else{
              echo json_encode(['error' => 'User not logged in.']);

            }
        }
        catch (\Exception $e) {
          echo json_encode(['error' => 'An error occurred while fetching nutrition facts.']);
        }

  }
}