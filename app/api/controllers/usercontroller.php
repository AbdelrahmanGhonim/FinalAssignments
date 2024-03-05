<?php
namespace App\Controllers;

use App\Services\UserService;

class UserController
{
  private $userService;

  // initialize services
  function __construct()
  {
      $this->userService = new UserService();
  }
  
  
  public function index()
  {
      try {
          header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
          header("Access-Control-Allow-Headers: Content-Type");
          header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
          header("Content-Type: application/json");
  
          session_start();
  
              if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] !== "Guest") {
                  $userName = $_SESSION["user_name"];
                  $user = $this->userService->getUserByUserName($userName);
                
                  echo json_encode($user);
                  
              } else {
                  echo json_encode(['error' => 'User not logged in.']);


              }
           
          
      } catch (\Exception $e) {
          // Debugging: Log any exceptions
          error_log('Exception: ' . $e->getMessage());
  
          echo json_encode(['error' => 'An error occurred while fetching user.']);
      }
  }

    public function update()
      {
        session_start();

          // Handle POST request for updating user information
          header('Content-Type: application/json');
          $jsonData = file_get_contents('php://input');
          $decodedData = json_decode($jsonData, true);

          // Validate and sanitize data before updating
          $sanitizedData = $this->sanitizeUserData($decodedData);
            
          error_log('Server Response: ' . json_encode($sanitizedData));
        
          echo json_encode($sanitizedData);

          // Now, $sanitizedData contains the sanitized form data
          $this->userService->updateUser($sanitizedData);
          
        
      }

        public function delete()
        {
            header('Content-Type: application/json');

            try {
               $jsonData = file_get_contents('php://input');
                $decodedData = json_decode($jsonData, true);
                    // Delete the user
                    $this->userService->deleteUser($decodedData);
    
                    // Clear session data
                    session_start();
                    session_unset();
                    session_destroy();
    
                
            } catch (\Exception $e) {
                // Debugging: Log any exceptions
                error_log('Exception: ' . $e->getMessage());
    
                echo json_encode(['error' => 'An error occurred while deleting user.']);
            }
    
        }

      private function sanitizeUserData($data)
      {
      // Example: Sanitize string inputs
      $data['username'] = filter_var($data['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $data['password'] = filter_var($data['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $data['age'] = filter_var($data['age'], FILTER_SANITIZE_NUMBER_INT);
      $data['height'] = filter_var($data['height'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $data['weight'] = filter_var($data['weight'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $data['goal'] = filter_var($data['goal'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    
      return $data;
    }
     

}