<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Channel as EntityChannel;
use \App\Model\Entity\Organization;

class Login extends Page{
    /**
     * Método responsável por definir o login do usuário
     * @param Request $request
     */
    public static function setLogin($request){
        //POST VARS
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        //BUSCA O USUÁRIO PELO E-MAIL
        $obUser = EntityChannel::getChannelByEmail($email);
        if(!$obUser instanceof User){
            // EMAIL OU SENHA INVÁLIDOS
            $request->getRouter()->redirect('/tcc/?status=loginfailed');
        }

        //VERIFICA A SENHA DO USUÁRIO
        if(!password_verify($senha,$obUser->senha)){
            // EMAIL OU SENHA INVÁLIDOS
            $request->getRouter()->redirect('/tcc/?status=loginfailed');
        }

        //CRIA A SESSÃO DE LOGIN
        SessionAdminLogin::login($obUser);

        //REDIRECIONA O USUÁRIO PARA A HOME DO ADMIN
        $request->getRouter()->redirect('/tcc');
    }

    /**
     * Método responsável por deslogar o usuário
     * @param Request $request
     */
    public static function setLogout($request){
        //DESTRÓI A SESSÃO DE LOGIN
        SessionAdminLogin::logout();

        //REDIRECIONA O USUÁRIO PARA A TELA DE LOGIN
        $request->getRouter()->redirect('/tcc');
    }
}