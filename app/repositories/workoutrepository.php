<?php

namespace App\Repositories;
use PDO;
use App\Models\Workout;

class WorkoutRepository extends Repository{


  public function getAllWorkouts($userId)
  {
        try{
        $stmt = $this->connection->prepare("
          SELECT workoutName, duration
          FROM workout
          WHERE userId = :userId
        ");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e) {
          error_log('Error getting workouts: ' . $e->getMessage());
          return [];
        }
    }

  public function addWorkout(Workout $workout)
  {
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

}