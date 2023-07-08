<?php

namespace Kang\Phpmvc\Controller;

use Kang\Phpmvc\App\View;
use Kang\Phpmvc\Config\Database;
use Kang\Phpmvc\Repository\SessionRepository;
use Kang\Phpmvc\Repository\UserRepository;
use Kang\Phpmvc\Service\SessionService;

class HomeController
{

  private SessionService $sessionService;

  public function __construct() {
    $connection = Database::getConnection();
    $sessionRepository = new SessionRepository($connection);
    $userRepository = new UserRepository($connection);
    $this->sessionService = new SessionService($sessionRepository, $userRepository);
  }

  function index(): void
  {
    $user = $this->sessionService->current();
    if ($user == null) {
      View::render('Home/index', [
        "title" => "Php MVC Login"
      ]);
    } else {
      View::render('Home/dashboard', [
        "title" => "Dashboard",
        "user" => [
          "name" => $user->name
        ]
      ]);
    }
  }

}
