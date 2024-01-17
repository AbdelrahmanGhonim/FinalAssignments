<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\SignupRepository;

class SignupService{

    private $signupRepository;
    public function __construct()
    {
        $this->signupRepository=new SignupRepository();
    }

    public function createUser(User $user){

        $this->signupRepository->createUser($user);
    }
  }