<?php

namespace App\Session\Admin;

class Login{

    /**
     * Método responsável por iniciar a sessão
     */
    private static function init(){
        //VERIFICA SE A SESSÃO NÃO ESTÁ ATIVA
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    /**
     * Método reponsável por criar o login do usuário
     * @param User $obUser
     * @return boolean
     */
    public static function login($obUser){
        //INICIAR A SESSÃO
        self::init();

        //DEFINE A SESSÃO DO USUÁRIO
        $_SESSION['admin']['user'] = [
            'id' => $obUser->id,
            'name' => $obUser->name,
            'user' => $obUser->user,
            'email' => $obUser->email
        ];

        //SUCESSO
        return true;
    }

    public static function getLogin(){
        self::init();

        return $_SESSION['admin']['user'];
    }

    /**
     * Método responsável por verificar se o usuário está logado
     * @return boolean
     */
    public static function isLogged(){
        //INICIA A SESSÃO
        self::init();

        //RETORNA A VERIFICAÇÃO
        return isset($_SESSION['admin']['user']['id']);
    }

    /**
     * Método responsável por executar o logout do usuário
     * @return boolean
     */
    public static function logout(){
        //INICIA A SESSÃO
        self::init();

        //DESLOGA O USUÁRIO
        unset($_SESSION['admin']['user']);

        //SUCESSO
        return true;
    }

}