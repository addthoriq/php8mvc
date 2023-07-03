<?php

namespace Kang\Phpmvc\Controller;

use Kang\Phpmvc\App\View;

class AboutController
{

    function index(): void
    {
        $model = [
            "title" => "Ini halaman About",
            "content" => "Welcome di halaman About"
        ];

        View::render('About/index', $model);
    }
}
