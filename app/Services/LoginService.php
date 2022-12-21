<?php

namespace App\Services;

use App\Models\Admin;
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

    public function login(string $email, string $password, string $type = 'user')
    {
        if ($type == 'user') {
            $login = Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1]);
        } else {

            $login = Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'active' => 1]);
        }
        return $login;
    }

    public function register(string $email, string $password, string $type = 'user')
    {
        $response = [
            'status' => false,
            'message' => 'Error'
        ];

        try {
            $checkAndCreateInfo = $type == 'user' ? $this->registerUser($email, $password) : $this->registerAdmin($email, $password);
            if (!$checkAndCreateInfo) {
                $response['message'] = "email {$type} isset";
                return $response;
            }
            $this->login($email, $password, $type);
        } catch (Exception $e) {
            \Debugbar::error($e);
            return $response;
        }
        return [
            'status' => true,
            'message' => 'Success',
        ];
    }

    public function registerUser(string $email, string $password)
    {
        $infoUser = $this->userRepository->getUserByEmail($email);
        if ($infoUser) {
            return false;
        }
        $this->userRepository->createUserByEmail(['email' => $email, 'password' => Hash::make($password)]);
        return true;
    }

    public function registerAdmin(string $email, string $password)
    {
        $infoUser = Admin::where('email', $email)->get();
        if ($infoUser) {
            return false;
        }

        // create
        Admin::create(
            [
                'email'     => $email,
                'name'      => 'ppp',
                'password'  =>  Hash::make($password)
            ]
        );
        return true;
    }
}
