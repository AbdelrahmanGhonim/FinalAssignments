<?php
namespace App\Repositories;

use PDO;
use App\Models\User;

class UserRepository extends Repository{

  public function getUserByUserName($userName)
  {
      try {
          // Prepare the SQL statement
          $stmt = $this->connection->prepare("
              SELECT id, userName,password, age, gender, weight, height, bmrInfo, goal, caloriesIntake FROM users
              WHERE userName = :username
          ");

          // Bind parameters
          $stmt->bindParam(':username', $userName);

          // Execute the statement
          $stmt->execute();

          // Fetch the user data
          $user = $stmt->fetch(PDO::FETCH_ASSOC);      

          // Check if the user exists
          if ($user) {
              // User is authenticated
              return $user;
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

  public function getUserById($userId)
 {
      try {
          // Prepare the SQL statement
          $stmt = $this->connection->prepare("
              SELECT * FROM users
              WHERE id = :userId
          ");

          // Bind parameters
          $stmt->bindParam(':userId', $userId);

          // Execute the statement
          $stmt->execute();

          // Fetch the user data
          $user = $stmt->fetch(PDO::FETCH_ASSOC);

          // Check if the user exists
          if ($user) {
              // User is authenticated
              return $user;
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

  public function getUserPassword($userId)
  {
      try {
          $stmt = $this->connection->prepare("SELECT password FROM users WHERE id = :userId");
          $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
          $stmt->execute();

          $result = $stmt->fetch(PDO::FETCH_ASSOC);

          if ($result) {
              return $result['password'];
          } else {
              // Handle case when user with given ID is not found
              return null;
          }
      } catch (\PDOException $e) {
          // Handle database error
          error_log('Error getting user password: ' . $e->getMessage());
          return null;
      }
  }


  public function updateUserInfo(User $user)
{
  //can you display the user before return?
  //  echo $user->getUserName().  "  ";also the id?
    try {
    //   $oldPassword = $this->getUserPassword($user->getUserId()); // Assuming you have a method to retrieve the current hashed password from the database
    //  // error_log('Old Password: ' . $oldPassword);
    //   //error_log('Current Password: ' . $user->getPassword());
    //     // Check if the user is updating the password
    //     if ($user->getPassword() !== null) {
    //         $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
    //         $user->setPassword($hashedPassword);
    //     }

        // Recalculate BMR and Calories Intake
        $bmrInfo = $user->calculateBMR();
        $caloriesIntake = $user->calculateCaloriesIntake();
        $user->setBmrInfo($bmrInfo);
        $user->setCaloriesIntake($caloriesIntake);

        // Prepare the SQL statement
        $stmt = $this->connection->prepare("
            UPDATE users
            SET 
                password = :password, 
                age = :age, 
                gender = :gender, 
                weight = :weight, 
                height = :height, 
                goal = :goal, 
                username = :newUsername, 
                bmrInfo = :bmrInfo, 
                caloriesIntake = :caloriesIntake
            WHERE id = :userId
        ");

        $params = [
          ':password' => $user->getPassword(),
          ':age' => $user->getAge(),
          ':gender' => $user->getGender(),
          ':weight' => $user->getWeight(),
          ':height' => $user->getHeight(),
          ':goal' => $user->getGoal(),
          ':newUsername' => $user->getUserName(),
          ':caloriesIntake' => $user->getCaloriesIntake(),
          ':bmrInfo' => $user->getBmrInfo(),
          ':userId' => $user->getUserId(),
      ];
        // Execute the statement
        error_log('SQL Query: ' . $stmt->queryString);
        //echo $stmt->queryString;

        $stmt->execute($params);
        $rowCount = $stmt->rowCount();
        error_log('Rows affected: ' . $rowCount);

        // Check if any rows were affected
        if ($rowCount > 0) {
            // User information updated successfully
           // echo "User information updated successfully";
            return true;
        } else {
            // No rows were affected, user information update failed
         //   echo "No rows were affected, user information update failed";
            return false;
        }
    } catch (\PDOException $e) {
        // Handle the exception (log, show an error message, etc.)
        echo 'Error updating user information: ' . $e->getMessage();
        return false;
    }

    
}



  // public function updateUserInfo($user)
  // {
  //     try {
  //         if (isset($user['password'])) {
  //             $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
  //         }
  
  //         // Initialize an empty array to store the SET part of the SQL query
  //         $setValues = [];
  
  //         // Iterate over the user object and build the SET part dynamically
  //         foreach ($user as $key => $value) {
  //             // Skip the 'id' field, as it's used in the WHERE clause
  //             if ($key !== 'id') {
  //                 $setValues[] = "$key = :$key";
  //             }
  //         }
  
  //         // Join the SET part using commas
  //         $setClause = implode(', ', $setValues);
  
  //         // Prepare the SQL statement
  //         $stmt = $this->connection->prepare("
  //             UPDATE users
  //             SET $setClause
  //             WHERE id = :userId
  //         ");
  
  //         // Bind parameters
  //         foreach ($user as $key => $value) {
  //             // Skip the 'id' field, as it's used in the WHERE clause
  //             if ($key !== 'id') {
  //                 $stmt->bindParam(":$key", $value);
  //             }
  //         }
  
  //         // Execute the statement
  //         error_log('SQL Query: ' . $stmt->queryString);
  
  //         $stmt->execute();
  //         $rowCount = $stmt->rowCount();
  //         error_log('Rows affected: ' . $rowCount);
  
  //         // Check if any rows were affected
  //         if ($rowCount > 0) {
  //             // User information updated successfully
  //             return true;
  //         } else {
  //             // No rows were affected, user information update failed
  //             return false;
  //         }
  //     } catch (\PDOException $e) {
  //         // Handle the exception (log, show an error message, etc.)
  //         echo 'Error updating user information: ' . $e->getMessage();
  //         return false;
  //     }
  // }
  
  // public function updateUserInfo($user)
  // {
  //     try {
  //         if (isset($user['password'])) {
  //             $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
  //         }
  
  //         // Prepare the SQL statement
  //         $stmt = $this->connection->prepare("
  //             UPDATE users
  //             SET password = :password, age = :age, gender = :gender, weight = :weight, height = :height, goal = :goal, username = :newUsername
  //             WHERE username = :oldUsername
  //         ");
  
  //         // Bind parameters
  //         $stmt->bindParam(':password', $user['password']);
  //         $stmt->bindParam(':age', $user['age']);
  //         $stmt->bindParam(':gender', $user['gender']);
  //         $stmt->bindParam(':weight', $user['weight']);
  //         $stmt->bindParam(':height', $user['height']);
  //         $stmt->bindParam(':goal', $user['goal']);
  //         $stmt->bindParam(':newUsername', $user['username']); // Use a consistent parameter name
  //         $stmt->bindParam(':oldUsername', $user['username']); // Use a consistent parameter name
  
  //         // Execute the statement
  //         error_log('SQL Query: ' . $stmt->queryString);
  
  //         $stmt->execute();
  //         $rowCount = $stmt->rowCount();
  //         error_log('Rows affected: ' . $rowCount);
  
  
  //         // Check if any rows were affected
  //         if ($rowCount > 0) {
  //             // User information updated successfully
  //             return true;
  //         } else {
  //             // No rows were affected, user information update failed
  //             return false;
  //         }
  //     } catch (\PDOException $e) {
  //         // Handle the exception (log, show an error message, etc.)
  //         echo 'Error updating user information: ' . $e->getMessage();
  //         return false;
  //     }
  // }
  
  

}