<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Channel as EntityChannel;
use \App\Model\Entity\Organization;

class Channel extends Page{
    /**
     * Método responsável por cadastrar um usuário no banco
     * @param Request $resquest
     * @return string
     */
    public static function setNewChannel($request){
        //RESGATA O TIMESTAMP DO ENVIO DO VÍDEO
        $date = date_create();
        $timestamp = date_timestamp_get($date);

        //POSTVARS
        $postVars = $request->getPostVars();

        $name = $postVars['name'] ?? '';
        $user = $postVars['user'] ?? '';
        $description = $postVars['description'] ?? '';
        $email = $postVars['email'] ?? '';
        $password = $postVars['password'] ?? '';

        //VERIFICA EMAIL
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        
        //VALIDA O EMAIL E USER DO USUARIO
        $obChannelEmail = EntityChannel::getChannelByEmail($email);
        $obChannelUser = EntityChannel::getChannelByUser($user);
        if($obChannelEmail instanceof EntityChannel || $obChannelUser instanceof EntityChannel){
            //REDIRECIONA O USUÁRIO SE JÁ EXISTIR UM EMAIL OU USER
            return false;
        }

        //NOVA INSTANCIA DE USUÁRIO
        $obChannel = new EntityChannel;
        $obChannel->user = $user;
        $obChannel->name = $name;
        $obChannel->description = $description;
        $obChannel->email = $email;
        $obChannel->password = password_hash($password,PASSWORD_DEFAULT);
        $obChannel->date = $timestamp;
        $obChannel->cadastrar();

        //REDIRECIONA O USUÁRIO
        $request->getRouter()->redirect('/tcc');
    }
}