<?php

namespace App\Repositories;

use PDO;
class LoginRepository extends Repository{

    public function authenticateUser($username, $password) {
        try {
            // Prepare the SQL statement
            $stmt = $this->connection->prepare("
                SELECT id, userName, password, age, gender, weight, height, bmrInfo, goal, caloriesIntake
                FROM users
                WHERE BINARY userName = :username
            ");
    
            // Bind parameters
            $stmt->bindParam(':username', $username);
    
            // Execute the statement
            $stmt->execute();
    
            // Fetch the user data (including the password)
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if the user exists and the password is correct
            if ($user && password_verify($password, $user['password'])) {
                // User is authenticated
                return $user; 
            } else {
                // User authentication failed
                return false;
            }
        } catch (\PDOException $e) {
            throw new \Exception('Error authenticating user: ' . $e->getMessage());
        }
    }
    
   
    
}