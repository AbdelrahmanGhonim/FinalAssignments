<?php


namespace App\Services;

use App\Repositories\LoginRepository;

class LoginService{

    private $loginRepository;
    public function __construct()
    {
        $this->loginRepository=new LoginRepository();
       // echo "LoginService layer in the house";
    }
    public function authenticateUser($username, $password) //service layer
    {
        // Call the repository method to check the username and password
        return $this->loginRepository->authenticateUser($username, $password);
    }
    
}