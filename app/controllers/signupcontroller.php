<?php

namespace App\Controllers;
use App\Models\User;
use App\Services\SignupService;

class SignUpController
{

    private $signupservice;

    public function __construct()
    {
        $this->signupservice = new SignupService();
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

                
                $this->signupservice->createUser($user);

                session_start();
                $_SESSION["user_name"] = htmlspecialchars($userName);
            }

            header("Location: /");

        } catch(\Exception $e) {
            // Display or log the exception details during development
            echo 'Error: ' . $e->getMessage();
            // Log the exception to your error logs
            error_log($e->getMessage(), 0);
        }
    
    }

    public function editProfile()
    {
        if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] !== "Guest") {
          
         include '../views/signup/signup.php';

        } else {
            // If the user is not logged in, redirect to the login page
            header('location: /login');
            exit();
        }
    }

}
