<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Matteomcr\LoginApi\Controllers\HomeController;
use Matteomcr\LoginApi\Controllers\UserController;


$app->get('/', [HomeController::class, 'showHomePage']);

$app->post('/register', [$userController, 'register']);
