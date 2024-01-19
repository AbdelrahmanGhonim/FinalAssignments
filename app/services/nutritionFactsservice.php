<?php


namespace App\Services;

use App\Repositories\NutritionFactRepository;
use App\Models\GoalEnum;

class NutritionFactsService{

    private $nutritionFactRepository;
    public function __construct()
    {
        $this->nutritionFactRepository=new NutritionFactRepository();
    }
  
    public function processUserGoal($userGoal)
    {
      $goalId = 0;
        switch ($userGoal) {
            case GoalEnum::LOSE_WEIGHT:

            //  echo "lose weight";
                $foods = $this->nutritionFactRepository->getFoodsByUserGoal($goalId);
             
                break;
            case GoalEnum::MAINTAIN_WEIGHT:
             // echo "maintain weight";
              $goalId=1 ;
                $foods = $this->nutritionFactRepository->getFoodsByUserGoal($goalId);
               // echo GoalEnum::MAINTAIN_WEIGHT." in service!!    ";

                break;
            case GoalEnum::BUILD_MUSCLE:
              //echo "build muscle Because you are a beast!   ";
              $goalId=2 ;
                $foods = $this->nutritionFactRepository->getFoodsByUserGoal($goalId);
                break;
            default:
                // Handle unknown goal (optional)
                $foods = $this->nutritionFactRepository->getFoodsByUserGoal($goalId);
                break;
        }
        return $foods;
    }
    
}