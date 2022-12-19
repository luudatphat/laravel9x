<?php

namespace App\Services;

use App\Repository\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\FlareClient\Truncation\TruncationStrategy;

class LoginService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $email, string $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
            return true;
        }
        return false;
    }

    public function register(string $email, string $password)
    {
        $response = [
            'status' => false,
            'message' => 'Error'
        ];

        try {
            $infoUser = $this->userRepository->getUserByEmail($email);
            if ($infoUser) {
                $response['message'] = 'email isset';
                return $response;
            }
// dd(['email' => $email, 'password' => Hash::make($password)]);
            $this->userRepository->createUserByEmail(['email' => $email, 'password' => Hash::make($password)]);
            $this->login($email, $password);
        } catch (Exception $e) {
            dd($e);
            \Debugbar::error($e);
            return $response;
        }
        return [
            'status' => true,
            'message' => 'Success',
        ];
    }
}
