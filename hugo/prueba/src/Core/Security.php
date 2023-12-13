<?php

require_once __DIR__ . '/../Entity/Login.php';

class Security{
    const TOKEN_NAME = "asdfasdf";

    public static function login(string $username, string $password, LoginRepository $loginRepository):Login{
        $login = $loginRepository->findByUsername($username);
        if ($login->getPassword() != $password) {
            throw new Exception("El nom i la constrasenya no s'han trobat");
        }
        return $login;
    }

    private static function checkSession(): void {
        if (session_status() !== PHP_SESSION_ACTIVE)
            throw new Exception('No hi ha cap sessió activa');
    }
    public static function setToken(Login $login):void{
        self::checkSession();

        $_SESSION[self::TOKEN_NAME] = $login;
    }

    public static function getToken(): ?Login{
        self::checkSession();

        if (isset($_SESSION[self::TOKEN_NAME])) {
            return $_SESSION[self::TOKEN_NAME];
        }

        return null;
    }

    public static function isToken(?Login $token): void{
        if (!$token){
            FlashMessage::set("message", "Cal iniciar sessió");
            header('Location: login.php');
            exit;
        }
    }

    public static function isRoleAdmin(?Login $token): void{
        if ($token->getRole()!='admin') {
            FlashMessage::set("message", "No tens permisos per a accedir");
            header('Location: login.php');
            exit;
        }
    }


}






