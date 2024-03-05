<?php

namespace App\Controllers;
use App\Models\User;
use App\Services\SignupService;

class SignUpController
{

    private $signupService;

    public function __construct()
    {
        $this->signupService = new SignupService();
    }
    
    public function index()
    {
        // Display the sign-up form
        include '../views/signup.php';
    }

    public function create()
    {
     try{
            // Handle the form submission logic
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Collect form data
                $userName = $_POST["username"];
                $password = $_POST["password"];
                $age = $_POST["age"];
                $gender = $_POST["gender"];
                $weight = $_POST["weight"];
                $height = $_POST["height"];
                $goal = $_POST["goal"];

                // Create a User object
                $user = new User($userName, $password, $age, $gender, $weight, $height, $goal);

                
                $this->signupService->createUser($user);

                session_start();
                $_SESSION["user_name"] = htmlspecialchars($userName);
                $_SESSION["caloriesIntake"] = htmlspecialchars($user->getCaloriesIntake());
                $_SESSION["goal"] = htmlspecialchars($goal);
                $_SESSION["weight"] = htmlspecialchars($weight);
            }

            header("Location: /");//homepage

        } catch(\Exception $e) {
            // Display or log the exception details during development
            echo 'Error: ' . $e->getMessage();
            // Log the exception to your error logs
            error_log($e->getMessage(), 0);
        }
    
    }

    public function editProfile()
    {          
         include '../views/signup/signup.php';

    }

}
