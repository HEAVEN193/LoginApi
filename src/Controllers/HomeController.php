<?php

namespace Matteomcr\LoginApi\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;




class HomeController extends BaseController{

    public function showHomePage(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface{
        
        return $this->view->render($response, 'homepage.php');
    }
   
}

