<?php

namespace App\Repositories;

use PDO;
use App\Models\Workout;

class WorkoutRepository extends Repository
{


  public function getAllWorkouts($userId)
  {
    try {
      $stmt = $this->connection->prepare("
          SELECT userId, workoutName, duration
          FROM workout
          WHERE userId = :userId
        ");
      $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
      error_log('Error getting workouts: ' . $e->getMessage());
      return [];
    }
  }

  public function addWorkout(Workout $workout)
  {
    try {
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

    } catch (\PDOException $e) {
      error_log('Error creating workout: ' . $e->getMessage());
      return false;
    }

  }

  public function deleteWorkout($userId, $workoutName, $duration)
  {
    try {
      $stmt = $this->connection->prepare("
      DELETE FROM workout
      WHERE userId = :userId AND workoutName = :workoutName AND duration = :duration
     ");
      $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
      $stmt->bindParam(':workoutName', $workoutName, PDO::PARAM_STR);
      $stmt->bindParam(':duration', $duration, PDO::PARAM_INT);
      $stmt->execute();

      return true;

    } catch (\PDOException $e) {
      error_log('Error deleting workout: ' . $e->getMessage());
      return false;
    }

  }

}