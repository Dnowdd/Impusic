<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Login extends Page{
    public static function getPiece($name){
        $itens = '';

        $itens .= View::render('pages/home/'.$name, [
        ]);

        return $itens;
    }

    /**
     * Método responsável por retornar o conteúdo (view) da nossa Home
     * @return string
     */
    public static function getLogin(){
        //Organização
        $obOrganization = new Organization;

        //VIEW DA HOME
        $content = View::render('pages/login',[
        ]);

        //RETORNA A VIEW DA PÁGINA
        return parent::getPage(
            //NOME DE ARQUIVOS CSS,JS...
            'home',
            //TITLE DA PÁGINA
            'Entrar na sua conta - '.$obOrganization->name,
            //DESCRIÇÃO DA PÁGINA
            'Bem-vindos ao RiftMaker.com - Análise as estatísticas de invocadores, melhores campeões, ranking competitivo, times de Clash, Profissionais e muito mais',
            //CONTEUDO DA PÁGINA
            $content
        );
    }

}