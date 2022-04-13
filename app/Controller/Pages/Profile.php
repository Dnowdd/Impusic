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
    public static function getProfile($user){
        //Organização
        $obOrganization = new Organization;

        if(!SessionAdminLogin::isLogged()){
            return false;
        }
        $login = SessionAdminLogin::getLogin();
        $obUser = EntityChannel::getChannelByUser($user);

        if($obUser->user == $login['user']){
            $follow = View::render('pages/profile/editContainer', [
            ]);
        }else{
            $follow = View::render('pages/profile/followContainer', [
            ]);
        }

        // ADICIONA ELLIPSIS SE A DESCRIÇÃO FOR MAIOR QUE 35C
        $minDesc = $obUser->description;
        $pageTitle = strlen($minDesc) > 35 ? substr($minDesc,0,35)."..." : $minDesc;

        // ADICIONA VEJA MAIS SE A DESCRIÇÃO FOR MAIOR QUE 35C
        $seeMore = '';
        if($obUser->description != '' && strlen($minDesc) > 35){
            $seeMore = 'Veja Mais.';
        }



        //VIEW DA HOME
        $content = View::render('pages/profile',[
            'name' => $obUser->name,
            'description' => $minDesc,
            'seeMore' => $seeMore,
            'follow' => $follow
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