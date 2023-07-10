<?php

namespace Kang\Phpmvc\Controller;

use Exception;
use Kang\Phpmvc\App\View;
use Kang\Phpmvc\Config\Database;
use Kang\Phpmvc\Exception\ValidationException;
use Kang\Phpmvc\Model\UserLoginRequest;
use Kang\Phpmvc\Model\UserRegisterRequest;
use Kang\Phpmvc\Repository\SessionRepository;
use Kang\Phpmvc\Repository\UserRepository;
use Kang\Phpmvc\Service\SessionService;
use Kang\Phpmvc\Service\UserService;

class UserController
{
  private UserService $userService;
  private SessionService $sessionService;

  public function __construct() {
    $connection = Database::getConnection();
    $userRepository = new UserRepository($connection);
    $this->userService = new UserService($userRepository);

    $sessionRepository = new SessionRepository($connection);
    $this->sessionService = new SessionService($sessionRepository, $userRepository);
  }

  public function register() {
    View::render('User/register', [
      'title' => 'Register new User'
    ]);
  }
  public function postRegister() {
    $request = new UserRegisterRequest();
    $request->id = $_POST['id'];
    $request->name = $_POST['name'];
    $request->password = $_POST['password'];

    try {
      $this->userService->register($request);
      View::redirect('/login');
    } catch (ValidationException $e) {
      View::render('User/register', [
        'title' => 'Register new User',
        'error' => $e->getMessage()
      ]); 
    }
  }

  public function login() {
    View::render('User/login', [
      'title' => 'Login user'
    ]);
  }

  public function postLogin() {
    $request = new UserLoginRequest();
    $request->id = $_POST['id'];
    $request->password = $_POST['password'];

    try {
      $response = $this->userService->login($request);
      $this->sessionService->create($response->user->id);
      View::redirect('/');
    } catch (ValidationException $e) {
      View::render('User/login', [
        'title' => 'Login user',
        'error' => $e->getMessage()
      ]); 
    }
  }

  public function logout() {
    $this->sessionService->destroy();
    View::redirect("/");
  }
}
