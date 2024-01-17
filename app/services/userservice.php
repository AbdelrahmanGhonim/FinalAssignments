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
        // Call the repository method to get the user by username
        return $this->userRepository->getUserByUserName($userName);
    }

    public function getUserById($userId)
    {
        return $this->userRepository->getUserById($userId);
    }
    public function getUserPassword($userId){

        return $this->userRepository->getUserPassword($userId);
    }

    public function updateUser(array $userData)
    {
        try {
            $user = $this->convertArrayToUser($userData);
            
            // Now you can pass $user to the repository layer for updating
            $this->userRepository->updateUserInfo($user);
        } catch (\Exception $e) {
            // Handle the exception (log, show an error message, etc.)
            echo 'Error updating user information: ' . $e->getMessage();
            return false;
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
          //  $userData['caloriesIntake'],
            //$userData['bmrInfo']
        );

        if (!password_verify($userData['password'], $userData['password'])) {
          $user->setPassword($userData['password']);
        }
  
        //can you set the id??
        $user->setUserId($userData['user-id']);

    
        return $user;
    }
    
    
    
} 