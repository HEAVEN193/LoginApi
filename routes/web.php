<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Matteomcr\LoginApi\Controllers\HomeController;


$app->get('/', [HomeController::class, 'showHomePage']);
