<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($user) {
        AuthHelper::init();
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_name'] = $user->user_name;
    }

    public static function logout() {
        AuthHelper::init();
        session_destroy();
    }

    public static function verify() {
        AuthHelper::init();
        return isset($_SESSION['user_id']);
    }
}