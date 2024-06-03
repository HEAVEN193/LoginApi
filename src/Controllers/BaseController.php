<?php

namespace Matteomcr\LoginApi\Controllers;

use Slim\Views\PhpRenderer;

abstract class BaseController
{
    protected PhpRenderer $view;

    function __construct(){
        $this->view = new PhpRenderer(__DIR__ .'/../../views', [
            'title' => 'Slimages',
        ]);

    }
}
