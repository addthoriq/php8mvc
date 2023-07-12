<?php

namespace Kang\Phpmvc\Middleware;

use Kang\Phpmvc\App\View;
use Kang\Phpmvc\Config\Database;
use Kang\Phpmvc\Repository\SessionRepository;
use Kang\Phpmvc\Repository\UserRepository;
use Kang\Phpmvc\Service\SessionService;

class MustNotLoginMiddleware implements Middleware{
  private SessionService $sessionService;

  public function __construct() {
    $sessionRepository = new SessionRepository(Database::getConnection());
    $userRepository = new UserRepository(Database::getConnection());
    $this->sessionService = new SessionService($sessionRepository, $userRepository);
  }

  public function before(): void
  {
    $user = $this->sessionService->current();
    var_dump($user);
    if ($user != null) {
      View::redirect('/');
    } 
  }
  
}
