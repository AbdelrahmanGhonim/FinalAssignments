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

      public function addFood()
      {
        header('Content-Type: application/json');
        $jsonData = file_get_contents('php://input');
        if(empty($jsonData)) {
            http_response_code(400); // Bad request
            echo json_encode(['error' => 'Empty request body']);
            return;
        }
        $decodedData = json_decode($jsonData, true);
        if ($decodedData === null && json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400); // Bad request
            echo json_encode(['error' => 'Error decoding JSON data']);
            return;
        }
        try{
        $sanitizedData = $this->sanitizeFoodData($decodedData);
        $this->nutritionFactService->addUserFood($sanitizedData);
        echo json_encode(['message' => 'Food added successfully']);
        } catch (\Exception $e) {
            http_response_code(500); // Internal server error
            echo json_encode(['error' => 'Failed to add food']);
        }
      }

      private function sanitizeFoodData($data)
      {
        // Example: Sanitize string inputs
        $data['userId'] = filter_var($data['userId'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['foodname'] = filter_var($data['foodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['carbs'] = filter_var($data['carbs'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data['proteins'] = filter_var($data['proteins'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data['fats'] = filter_var($data['fats'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data['fibers'] = filter_var($data['fibers'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        return $data;
      }
     
}