<?php
namespace App\Repositories;

use App\Models\User;

Class SignupRepository extends Repository
{
  
  public function createUser(User $user) {
    try {
        // $bmrInfo = $user->calculateBMR(); 
        // $caloriesIntake = $user->calculateCaloriesIntake();

        // $user->setBmrInfo($bmrInfo);
        // $user->setCaloriesIntake($caloriesIntake);

        // Prepare the SQL statement
        $stmt = $this->connection->prepare("
            INSERT INTO users (userName, password, age, gender, weight, height, bmrInfo, goal, caloriesIntake)
            VALUES (:userName, :password, :age, :gender, :weight, :height, :bmrInfo, :goal, :caloriesIntake)
        ");

        // Bind parameters using associative array
        $params = [
            ':userName' => $user->getUserName(),
            ':password' => $user->getPassword(),
            ':age' => (int)$user->getAge(),
            ':gender' => $user->getGender(),
            ':weight' => $user->getWeight(),
            ':height' => $user->getHeight(),
            ':bmrInfo' => $user->getBmrInfo(),
            ':goal' => $user->getGoal(),
            ':caloriesIntake' => $user->getCaloriesIntake(),
        ];
        $bmrInfo = $user->calculateBMR(); 
        $caloriesIntake = $user->calculateCaloriesIntake();

        $user->setBmrInfo($bmrInfo);
        $user->setCaloriesIntake($caloriesIntake);

        // Execute the statement
        $stmt->execute($params);

        // Optionally, you might return some indication of success
        return true;
    } catch (\PDOException $e) {
        // Log the error instead of echoing
        error_log('Error creating user: ' . $e->getMessage());

        // Optionally, you might return some indication of failure
        return false;
    }
  }

}