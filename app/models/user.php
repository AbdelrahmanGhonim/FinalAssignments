<?php

namespace App\Models;

class User implements \JsonSerializable{

        private $id;
        private $userName;
        private $password;
        private $age;
        private $gender;
        private $weight;
        private $height;
        private $bmrInfo;
        private $goal;
        private $caloriesIntake;
    
        public function __construct($userName, $password, $age, $gender, $weight, $height, $goal) {
           // $this->id=$id;
            $this->userName = $userName;
            $this->setPassword($password);
            $this->age = $age;
            $this->gender = $gender;
            $this->weight = $weight;
            $this->height = $height;
            $this->setGoal($goal);
            $this->caloriesIntake =$this->calculateCaloriesIntake();// should called setCaloriesIntake TODO:
            $this->bmrInfo = $this->calculateBMR();
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function setPassword($password) {
     
            if(empty($password) || password_needs_rehash($password, PASSWORD_BCRYPT)){
               // echo "the password is empty ";
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $this->password = $hashedPassword;
            }
            else{
               // echo "the password is not Empty and does not need to be rehashed ";
                $this->password = $password;
            }

        }
    
    
        public function getUserId()
        {
            return $this->id;
        }  
        public function setUserId($userId)
        {
            $this->id = $userId;
        }
        
        public function getUserName() {
            return $this->userName;
        }
        public function setUserName($userName)
        {
            $this->userName = $userName;
        }
    
        
      

        public function getAge() {
            return $this->age;
        }
        public function setAge($userAge)
        {
            $this->age = $userAge;
        }
        public function getGender() {
            return $this->gender;
        }
        public function setGender($userGender)
        {
            $this->gender = $userGender;
        }
        public function getHeight() {
            return $this->height;
        }
        public function setHeight($userHeight)
        {
            $this->height = $userHeight;
        }
        public function getWeight() {
            return $this->weight;
        }
        public function setWeight($userWeight)
        {
            $this->weight = $userWeight;
        }
        public function getBMRInfo() {
            return $this->bmrInfo;
        }
        public function setBMRInfo($userBMRInfo)
        {
            $this->bmrInfo = $userBMRInfo;
        }

    
      
            public function getGoal()
        {
            return $this->goal;
        }
        private function isValidGoal($goal) {
            $allowedGoals = [GoalEnum::LOSE_WEIGHT, GoalEnum::MAINTAIN_WEIGHT, GoalEnum::BUILD_MUSCLE];
            return in_array($goal, $allowedGoals);
        }
        public function setGoal($goal) {
            // Check if the provided goal is one of the defined enums
            $this->goal = $this->isValidGoal($goal) ? $goal : GoalEnum::MAINTAIN_WEIGHT;
        }
        // public function setGoal($goal) {
        //     // Check if the provided goal is one of the defined enums
        //     $allowedGoals = [GoalEnum::LOSE_WEIGHT, GoalEnum::MAINTAIN_WEIGHT, GoalEnum::BUILD_MUSCLE];
        //     if (in_array($goal, $allowedGoals)) {
        //         $this->goal = $goal;
        //     } else {
        //         // Handle invalid goal (you can throw an exception, set a default, etc.)
        //         // For now, I'll set a default value
        //         $this->goal =GoalEnum::MAINTAIN_WEIGHT;
        //     }
        // }
        public function getCaloriesIntake()
        {
           return $this->caloriesIntake;
        }

        public function setCaloriesIntake($caloriesIntake)
        {
            $this->caloriesIntake = $caloriesIntake;
        }
        

        public function calculateBMR()
        {      
            $constantA = 88.362;
            $constantBWeight = 13.397;
            $constantBHeight = 4.799;
            $constantBAge = 5.677;
        
            $weight = $this->weight;
            $height = $this->height;
            $age = $this->age;
        
            $bmr = $constantA + ($constantBWeight * $weight) + ($constantBHeight * $height) - ($constantBAge * $age);
        
            return $bmr;
        }

        public function calculateCaloriesIntake()
        {
            // Calories Intake Calculation based on BMR and user's goal
            // $bmr = $this->calculateBMR();
    
            // switch ($this->goal) {
            //     case GoalEnum::LOSE_WEIGHT:
            //         return $bmr - 500; // Example: Reduce 500 calories for weight loss
            //     case GoalEnum::MAINTAIN_WEIGHT:
            //         return $bmr; // Maintain current weight
            //     case GoalEnum::BUILD_MUSCLE:
            //         return $bmr + 300; // Example: Increase 300 calories for muscle building
            //     default:
            //         return $bmr; // Default to BMR if goal is not recognized
            // }
            $bmr = $this->calculateBMR();

            // Use the isValidGoal method to check goal validity
            return $this->isValidGoal($this->goal) ?
                match ($this->goal) {
                    GoalEnum::LOSE_WEIGHT => $bmr - 500,
                    GoalEnum::MAINTAIN_WEIGHT => $bmr,
                    GoalEnum::BUILD_MUSCLE => $bmr + 300,
                    default => $bmr,
                } :
                $bmr;
        }
       
        public function jsonSerialize():mixed
        {
            $vars=get_object_vars($this);
            return $vars;
        }
    
}


    



