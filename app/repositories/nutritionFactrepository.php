<?php
namespace App\Repositories;

use PDO;
use App\Models\NutritionFact;

class NutritionFactRepository extends Repository{

  public function getFoodsByUserGoal($goalId)
  {
    $goalId = (int)$goalId;
   // echo "       Test   ".$goalId." in repository";
      try {
          $stmt = $this->connection->prepare("
              SELECT food_id, food_name, carbs, proteins, fats, fibers, goal_id
              FROM nutrition_facts
              WHERE goal_id = :goalId
          ");
          //userGoal will be one of the enum types of the GoalEnum class


          $stmt->bindParam(':goalId', $goalId, PDO::PARAM_INT);
          
          $stmt->execute();

          $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);

          return $foods;
      } catch (\PDOException $e) {
          // Handle the exception (log, show an error message, etc.)
         throw new \Exception('Error getting foods by goal id: ' . $e->getMessage());
      }
    }

}
