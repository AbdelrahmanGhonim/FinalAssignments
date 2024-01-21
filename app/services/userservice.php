<?php


namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;

class UserService{

    private $userRepository;
    public function __construct()
    {
        $this->userRepository=new UserRepository();
    }

    public function getUserByUserName($userName)
    {
        return $this->userRepository->getUserByUserName($userName);
    }

  

    public function updateUser(array $userData)
    {
        try {
            $user = $this->convertArrayToUser($userData);
        
            $this->userRepository->updateUserInfo($user);
            $this->updateSessions($userData);
          
          
        } catch (\Exception $e) {
            // Handle the exception (log, show an error message, etc.)
            throw new \Exception('Error updating user information: ' . $e->getMessage());      
          }
   }

    public function deleteUser(array $userData)
    {
        try {
            $user = $this->convertArrayToUser($userData);
        
            // Now you can pass $user to the repository layer for updating
            $this->userRepository->deleteUser($user);
          
          
        } catch (\Exception $e) {
            // Handle the exception (log, show an error message, etc.)
            throw new \Exception('Error deleting user information: ' . $e->getMessage());
        }
    }
    
    private function convertArrayToUser(array $userData): User
    {
        // Ensure that all required keys are present in the array
        $requiredKeys = ['username', 'password', 'age', 'gender', 'weight', 'height', 'goal', 'user-id'];
    
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $userData)) {
                throw new \Exception("Missing key in user data: $key");
            }
        }
        // Create a User instance and set additional properties
        $user = new User(
            $userData['username'], // Correct key is 'username'
            $userData['password'],
            $userData['age'],
            $userData['gender'],
            $userData['weight'],
            $userData['height'],
            $userData['goal'],
            
        );
       $_SESSION["caloriesIntake"]=htmlspecialchars($user->getCaloriesIntake());      
        

        TODO: //check if the password is the same as the one in the database. if it is, then don't hash it again. This WRONG.
        // if (!password_verify($userData['password'], $userData['password'])) {
        //   $user->setPassword($userData['password']);
        // }
        // if (!password_verify($userData['password'], $user->getPassword())) {
        //     $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
        //     $user->setPassword($hashedPassword);
        // }
        // session_start();
        // if (isset($userData['caloriesIntake'])) {
        //     $user->setCalculateCaloriesIntake($userData['caloriesIntake']);
        // }
        // if(isset($user->getCaloriesIntake())){
        //     $user->setCaloriesIntake($userData['caloriesIntake']);
        // }
  
        //can you set the id??
        $user->setUserId($userData['user-id']);

    
        return $user;
    }

    private function updateSessions($data){
        try{

        $_SESSION["user_name"] = htmlspecialchars($data['username']);// for displaying in the nav bar.
        $_SESSION["goal"] =htmlspecialchars($data['goal']);
        $_SESSION["weight"] =htmlspecialchars($data['weight']);
        
        }
        catch (\Exception $e) {
            // Handle the exception (log, show an error message, etc.)
            echo 'Error upgrading session data: ' . $e->getMessage();
        }

     }
    
    
    
} 