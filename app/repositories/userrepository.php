<?php
namespace App\Repositories;

use PDO;
use App\Models\User;

class UserRepository extends Repository
{

    public function getUserByUserName($userName)
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->connection->prepare("
                SELECT id, userName,password, age, gender, weight, height, bmrInfo, goal, caloriesIntake FROM users
                WHERE  userName = :username
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
            throw new \PDOException('Error authenticating user: ' . $e->getMessage());
        }
    }


    public function updateUserInfo(User $user)
    {

        try {

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

            $stmt->execute($params);
            $rowCount = $stmt->rowCount();
            error_log('Rows affected: ' . $rowCount);

            if ($rowCount > 0) {
                // User information updated successfully
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            throw new \PDOException('Error updating user information: ' . $e->getMessage());
        }
    }
    public function deleteUser(User $user)
    {
        try {
            $this->DeleteUserFood($user->getUserId());
            $this->deleteUserWorkout($user->getUserId());
            $stmt = $this->connection->prepare("DELETE FROM users WHERE id = :id");
            $userId = $user->getUserId();
            $stmt->bindParam(':id', $userId, PDO::PARAM_STR);
            $stmt->execute();

            return true; // Return true if deletion is successful
        } catch (\PDOException $e) {
            // Handle the exception (log, show an error message, etc.)
            throw new \PDOException('Error deleting user: ' . $e->getMessage());

        }
    }
    public function DeleteUserFood($userId)
    {
        try {
            $stmt = $this->connection->prepare("
                DELETE FROM userfood
                WHERE userId = :id
            ");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            error_log('Error deleting user food: ' . $e->getMessage());
            return false;
        }
    }
    public function deleteUserWorkout($userId)
    {
        try {
            $stmt = $this->connection->prepare("
      DELETE FROM workout
      WHERE userId = :userId
     ");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            error_log('Error deleting workout: ' . $e->getMessage());
            return false;
        }
    }
}