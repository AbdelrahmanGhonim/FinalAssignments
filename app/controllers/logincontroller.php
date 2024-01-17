<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Services\Loginservice;

class LoginController{

    private $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }

    public function index(){

        include '../views/login/index.php';

    }
    // Example method in LoginController.php
    public function authenticate()
    {
        // Get the username and password from the form submission
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Call the service method to authenticate the user
        $isAuthenticated = $this->loginService->authenticateUser($username, $password);
        //session_start();
        if ($isAuthenticated) {
            
            session_start();
            $_SESSION["user_name"] = htmlspecialchars($username);// for displaying in the nav bar.
            header("Location: /"); 
    
            exit();
        } else {
        
            $_SESSION["user_name"] = 'Guest';

            $this->index();// still in the login page
        }
    }
// Example method in LoginController.php
        public function logout()
        {
            // Start or resume the session
            session_start();

            // Unset specific session variables related to the user
            unset($_SESSION["user_name"]);


            // Redirect the user to the login page
            header("Location: /login");
            exit(); // Ensure that no further code is executed after the redirect
        }   

}