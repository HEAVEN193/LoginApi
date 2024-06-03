<?php

namespace Matteomcr\LoginApi\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
// use Slim\Http\Response as Response;

// use Slim\Http\Response as Response;
use Matteomcr\LoginApi\Models\Database;

class UserController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function register(ServerRequestInterface $request, ResponseInterface $response) {
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($password) || empty($email)) {
            return $response->withJson(['error' => 'Invalid request data.'], 400);
        }

        if ($this->userModel->findByEmail($email)) {
            return $response->withJson(['error' => 'Username or email already exists.'], 409);
        }

        $userId = $this->userModel->create($email, $password);
        return $response->withJson(['message' => 'User registered successfully.', 'userId' => $userId], 201);
    }

    public function login($request, $response) {
        $data = $request->getParsedBody();
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($username) || empty($password)) {
            return $response->withJson(['error' => 'Invalid username or password.'], 400);
        }

        $user = $this->userModel->findByUsername($username);
        if (!$user || !password_verify($password, $user['password'])) {
            return $response->withJson(['error' => 'Unauthorized.'], 401);
        }

        // Assuming a method exists to create a JWT token
        $token = $this->createJwtToken($user['id']);
        return $response->withJson(['token' => $token]);
    }

    public function resetPassword($request, $response) {
        $email = $request->getParsedBody()['email'] ?? '';

        if (empty($email)) {
            return $response->withJson(['error' => 'Email not provided or invalid.'], 400);
        }

        $user = $this->userModel->findByEmail($email);
        if (!$user) {
            return $response->withJson(['error' => 'User not found.'], 404);
        }

        // Process for sending a reset password email
        $this->sendResetPasswordEmail($user['email'], $user['id']);
        return $response->withJson(['message' => 'Password reset email sent.']);
    }

    // Helper method to create JWT token
    private function createJwtToken($userId) {
        $key = 'your_secret_key';
        $payload = [
            'iss' => 'your_domain.com',
            'aud' => 'your_domain.com',
            'iat' => time(),
            'exp' => time() + 7200,  // Token expires in 2 hours
            'sub' => $userId
        ];

        return JWT::encode($payload, $key);
    }

    // Helper method to simulate sending an email
    private function sendResettingPasswordEmail($email, $userId) {
        // This should be implemented to send email in real applications
    }
}
