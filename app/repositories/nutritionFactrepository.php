<?php
namespace App\Repositories;

use PDO;

class NutritionFactRepository extends Repository{

  public function getFoodsByUserGoal($goalId)
  {
   
      try {
          $stmt = $this->connection->prepare("
              SELECT food_id, food_name, carbs, proteins, fats, fibers, goal_id
              FROM nutrition_facts
              WHERE goal_id = :goalId
          ");
          $stmt->bindParam(':goalId', $goalId, PDO::PARAM_INT);
          
          $stmt->execute();

          $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);

          return $foods;
      } catch (\PDOException $e) {
          // Handle the exception (log, show an error message, etc.)
         throw new \PDOException('Error getting foods by goal id: ' . $e->getMessage());
      }
    }

}
