<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Channel as EntityChannel;
use \App\Model\Entity\Organization;
use \App\Session\Admin\Login as SessionAdminLogin;

class Profile extends Page{
    /**
     * Método responsável por retornar o conteúdo (view) da nossa Home
     * @return string
     */
    public static function getProfile(){
        //Organização
        $obOrganization = new Organization;

        $login = SessionAdminLogin::getLogin();
        $obUser = EntityChannel::getChannelByUser($login['name']);

        $seeMore = '';
        if($obUser->description != ''){
            $seeMore = 'Veja Mais.';
        }

        //VIEW DA HOME
        $content = View::render('pages/profile',[
            'name' => $obUser->name,
            'description' => $obUser->description,
            'seeMore' => $seeMore
        ]);

        //RETORNA A VIEW DA PÁGINA
        return parent::getPage(
            //NOME DE ARQUIVOS CSS,JS...
            'profile',
            //TITLE DA PÁGINA
            $obUser->name.' - '.$obOrganization->name,
            //DESCRIÇÃO DA PÁGINA
            'Bem-vindos ao RiftMaker.com - Análise as estatísticas de invocadores, melhores campeões, ranking competitivo, times de Clash, Profissionais e muito mais',
            //CONTEUDO DA PÁGINA
            $content
        );
    }
}