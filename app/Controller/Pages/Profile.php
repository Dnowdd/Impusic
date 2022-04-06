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

        //VIEW DA HOME
        $content = View::render('pages/profile',[
            'name' => $login['name']
        ]);

        //RETORNA A VIEW DA PÁGINA
        return parent::getPage(
            //NOME DE ARQUIVOS CSS,JS...
            'profile',
            //TITLE DA PÁGINA
            $login['name'].' - '.$obOrganization->name,
            //DESCRIÇÃO DA PÁGINA
            'Bem-vindos ao RiftMaker.com - Análise as estatísticas de invocadores, melhores campeões, ranking competitivo, times de Clash, Profissionais e muito mais',
            //CONTEUDO DA PÁGINA
            $content
        );
    }
}