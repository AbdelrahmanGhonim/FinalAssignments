<?php

namespace App\Services;

use App\Repositories\WorkoutRepository;
use App\Models\Workout;

class WorkoutService
{

    private $workoutRepository;
    public function __construct()
    {
        $this->workoutRepository = new WorkoutRepository();
    }

    public function getUserWorkout($userId)
    {
        try {
            $workouts = $this->workoutRepository->getAllWorkouts($userId);
            return $workouts;
        } catch (\Exception $e) {

            throw new \Exception('Error getting workouts: ' . $e->getMessage());
        }
    }

    public function addWorkout(array $workoutData)
    {
        try {
            $workout = $this->convertArrayToWorkout($workoutData);

            $this->workoutRepository->addWorkout($workout);
        } catch (\Exception $e) {

            throw new \Exception('Error adding workout: ' . $e->getMessage());
        }
    }

    public function deleteWorkout($userId, $workoutName, $duration)
    {
        try {
            $this->workoutRepository->deleteWorkout($userId, $workoutName, $duration);
        } catch (\Exception $e) {

            throw new \Exception('Error deleting workout: ' . $e->getMessage());
        }
    }

    private function convertArrayToWorkout(array $workoutData): Workout
    {
        // Ensure that all required keys are present in the array
        $requiredKeys = ['userId', 'workoutName', 'duration'];

        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $workoutData)) {
                throw new \Exception("Missing key in workout data: $key");
            }
        }

        // Now you can create a new Workout object
        $workout = new Workout(
            $workoutData['userId'],
            $workoutData['workoutName'],
            $workoutData['duration']
        );

        return $workout;
    }
}
