<?php

namespace App\Repositories;

use PDO;
use App\Models\User;
class LoginRepository extends Repository{

     public function authenticateUser($username, $password) // loginMethod
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->connection->prepare("
                SELECT * FROM users
                WHERE userName = :username
            ");

            // Bind parameters
            $stmt->bindParam(':username', $username);

            // Execute the statement
            $stmt->execute();
        

            // Fetch the user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if the user exists
            if ($user && password_verify($password, $user['password'])) {
                // User is authenticated
                return true;
            } else {
                // User authentication failed
                return false;
            }
        } catch (\PDOException $e) {
            // Handle the exception (log, show an error message, etc.)
            echo 'Error authenticating user: ' . $e->getMessage();
            return false;
        }
    }
   
    
}