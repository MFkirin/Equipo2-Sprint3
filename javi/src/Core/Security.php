<?php
declare(strict_types=1);

namespace App\Core;

use App\Entity\Login;
use App\Helper\FlashMessage;
use App\Repository\LoginRepository;
use Exception;

class Security
{
    const TOKEN_NAME = "loginToken";

    private static function verifyLogin(?Login $user, string $password): void
    {
        if (!$user) {
            self::handleLoginError("Nombre de usuario incorrecto");
        }
        if (!password_verify($password, $user->getPassword())) {
            self::handleLoginError("Contraseña incorrecta");
        }
    }

    private static function handleLoginError(string $message): void
    {
        try {
            FlashMessage::set("message", $message);
            header('Location: login.php');
            exit;
        } catch (Exception $e) {
            FlashMessage::set("message", $e->getMessage());
        }
    }

    public static function login(string $username, string $password, LoginRepository $loginRepository): void
    {
        try {
            $user = $loginRepository->findByUsername($username);

            self::verifyLogin($user, $password);
            $user->setPassword("private-xd");
            self::setToken($user);

        } catch (Exception $e) {
            self::handleLoginError($e->getMessage());
        }
    }

    private static function checkSession(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE)
            throw new Exception('No hi ha cap sessió activa');
    }

    public static function setToken(Login $login): void
    {
        self::checkSession();

        $_SESSION[self::TOKEN_NAME] = $login;
    }

    public static function getToken(): ?Login
    {
        self::checkSession();

        if (isset($_SESSION[self::TOKEN_NAME])) {
            return $_SESSION[self::TOKEN_NAME];
        }

        return null;
    }

    public static function isToken(?Login $token): void
    {
        if (!$token) {
            self::handleLoginError("Cal iniciar sessió");
        }
    }

    public static function isRoleCustomer(?Login $token): void
    {
        self::checkRole($token, 'customer');
    }

    public static function isRoleEmployee(?Login $token): void
    {
        self::checkRole($token, 'employee');
    }

    public static function isRolePrivate(?Login $token): void
    {
        self::checkRole($token, 'private');
    }

    public static function isRoleProfessional(?Login $token): void
    {
        self::checkRole($token, 'professional');
    }

    public static function isRoleAdministrator(?Login $token): void
    {
        self::checkRole($token, 'administrator');
    }

    public static function isRoleAdministrative(?Login $token): void
    {
        self::checkRole($token, 'administrative');
    }

    private static function checkRole(?Login $token, string $expectedRole): void
    {
        if ($token->getRole() != $expectedRole) {
            self::handleLoginError("No tens permisos per a accedir com a $expectedRole.");
        }
    }
}