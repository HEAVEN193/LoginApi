<?php
// Indiquer les classes à utiliser
use Slim\Factory\AppFactory;
use Matteomcr\LoginApi\Models\Database;
use Matteomcr\LoginApi\Models\User;
use Matteomcr\LoginApi\Controllers\UserController;

// Activer le chargement automatique des classes
require __DIR__ . '/../vendor/autoload.php';
// Créer l'application
$app = AppFactory::create();
// Ajouter certains traitements d'erreurs
$app->addErrorMiddleware(true, true, true);

$userModel = new User(Database::connection());  // $pdo est l'objet PDO créé dans db.php
$userController = new UserController($userModel);

// Définir les routes
require __DIR__ . '/../routes/web.php';
// Lancer l'application
$app->run();
