<?php

namespace App\Controllers;

use App\Services\LoginService;

class LoginController{

    private $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }

    public function index(){
        include '../views/login.php';

    }


    public function authenticate()
    {
        // Get the username and password from the form submission
        $username =$this->validate($_POST['username']);
        $password =$this->validate($_POST['password']);

        // Call the service method to authenticate the user
        $userAuthenticated= $this->loginService->authenticateUser($username, $password);

        if ($userAuthenticated) {    
            session_start();            
        
            $_SESSION["user_name"] = htmlspecialchars($username);// for displaying in the nav bar.
            $_SESSION["caloriesIntake"] =htmlspecialchars($userAuthenticated['caloriesIntake']);
            $_SESSION["goal"] =htmlspecialchars($userAuthenticated['goal']);
            $_SESSION["weight"] =htmlspecialchars($userAuthenticated['weight']);
          

            header("Location: /"); // navigate to the home page
            exit();

        } else {
           // session_start();            
        
          //  $_SESSION["user_name"] = 'Guest';
            $error = 'Invalid username or password.';
            echo "<script type='text/javascript'>
            alert('Invalid username or password.');
            window.location.href = '/login'; 
          </script>";
            $this->index();// still in the login page
        }
    }
    private function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
// Example method in LoginController.php
        public function logout()
        {
            // Start or resume the session
            session_start();

            session_unset();
            session_destroy();


            // Redirect the user to the login page
            header("Location: /login");
            exit(); // Ensure that no further code is executed after the redirect
        }   

}