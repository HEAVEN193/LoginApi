<?php

namespace Matteomcr\LoginApi\Models;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Matteomcr\LoginApi\Models\Database;


class Utilisateur{
    public $idUtilisateur;
    public $email;
    public $motDePasse;
    public $prenom;
    public $nom;
    public $dateDeNaissance;
    public $idRole;
    protected $role = null;
    

    public static function fetchAll() :array
    {
        $statement = Database::connection()->prepare("SELECT * FROM UTILISATEUR");
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
        return $statement->fetchAll();
    }

    public static function fetchByEmail(string $email) : Utilisateur|false
    {
        $statement = Database::connection()
        ->prepare("SELECT * FROM UTILISATEUR WHERE email = :email");
        $statement->execute([':email' => $email]);
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
        return $statement->fetch();
    }

    s

}


