<?php
namespace App\Controllers;

use App\Services\WorkoutService;

class WorkoutController
{
  private $workoutService;

  // initialize services
  function __construct()
  {
    $this->workoutService = new WorkoutService();
  }

  public function index()
  {
    try {
      header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
      header("Access-Control-Allow-Headers: Content-Type");
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
      header("Content-Type: application/json");
      session_start();
      if (isset($_SESSION["id"])) {
        $userId = $_SESSION['id'];
        $workouts = $this->workoutService->getUserWorkout($userId);
        echo json_encode($workouts);
      } else {
        echo json_encode(['error' => 'wrong user id']);
      }
    } catch (\Exception $e) {
      echo json_encode(['error' => 'An error occurred while fetching workouts.']);
    }
  }




  public function addWorkout()
  {
    header('Content-Type: application/json');
    $jsonData = file_get_contents('php://input');
    if (empty($jsonData)) {
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
    try {
      $sanitizedData = $this->sanitizeWorkoutData($decodedData);

      $this->workoutService->addWorkout($sanitizedData);
      // echo json_encode(['message' => 'Workout added successfully']);
    } catch (\Exception $e) {
      http_response_code(500); // Internal server error
      echo json_encode(['error' => 'Failed to add workout']);
    }

  }

  public function deleteWorkout()
  {
    header('Content-Type: application/json');
    $jsonData = file_get_contents('php://input');
    if (empty($jsonData)) {
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

    try {
      $userId = $decodedData['userId'];
      $workoutName = $decodedData['workoutName'];
      $duration = $decodedData['duration'];
      $this->workoutService->deleteWorkout($userId, $workoutName, $duration);
      echo json_encode(['message' => 'Workout deleted successfully']);
    } catch (\Exception $e) {
      http_response_code(500); // Internal server error
      echo json_encode(['error' => 'Failed to delete workout']);
    }
  }





  private function sanitizeWorkoutData($data)
  {
    // Example: Sanitize string inputs
    $data['userId'] = filter_var($data['userId'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $data['workoutName'] = filter_var($data['workoutName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $data['duration'] = filter_var($data['duration'], FILTER_SANITIZE_NUMBER_INT);
    return $data;
  }



}

