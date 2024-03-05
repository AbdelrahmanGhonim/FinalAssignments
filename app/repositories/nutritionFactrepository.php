<?php
namespace App\Repositories;

use App\Models\NutritionFact;
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

    public function addUserFood(NutritionFact $nutritionFact)
    {
        try
        {
            $stmt=$this->connection->prepare("INSERT INTO userfood (userId,foodname,carbs,proteins,fats,fibers) VALUES (:userId, :foodname, :carbs, :proteins, :fats, :fibers)");
            $params = [
                ':userId' => $nutritionFact->getUserId(),
                ':foodname' => $nutritionFact->getFoodName(),
                ':carbs' => $nutritionFact->getCarbs(),
                ':proteins' => $nutritionFact->getProteins(),
                ':fats' => $nutritionFact->getFats(),
                ':fibers' => $nutritionFact->getFibers()
            ];
            $stmt->execute($params);
            return true;
        }catch (\PDOException $e) {
            error_log('Error creating user food: ' . $e->getMessage());
            return false;
        }
    }
}

/*
try{
    //  var_dump($workout);////////////////////////////
    $stmt = $this->connection->prepare("
      INSERT INTO workout (userId, workoutName, duration)
      VALUES (:userId, :workoutName, :duration)
    ");
    $params = [
      ':userId' => $workout->getUserId(),
      ':workoutName' => $workout->getWorkoutName(),
      ':duration' => $workout->getDuration()
    ];
    $stmt->execute($params);

    return true;

    }
    catch (\PDOException $e) {
      error_log('Error creating workout: ' . $e->getMessage());
      return false;
    }

  }
*/
