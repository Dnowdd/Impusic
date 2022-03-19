<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Videos as EntityVideos;
use \App\Model\Entity\Organization;

class Upload extends Page{
    /**
     * Método responsável por retornar o formulário de cadastro de um novo usuario
     * @param Request $resquest
     * @return string
     */
    public static function getNewVideo($request){
        //CONTEÚDO DO FORMULÁRIO
        $content = View::render('pages/upload',[
        ]);

        //RETORNA A PÁGINA COMPLETA
        return parent::getPanel('upload','Publicar vídeo',$content);
    }

    
    /**
     * Método responsável por cadastrar um usuário no banco
     * @param Request $resquest
     * @return string
     */
    public static function setNewVideo($request){
        //POSTVARS
        $postVars = $request->getPostVars();

        $title = $postVars['title'] ?? '';
        $description = $postVars['description'] ?? '';
        $thumbnail = $postVars['thumbnail'] ?? '';

        //VALIDA O EMAIL DO USUARIO
        /* $obUser = EntityUser::getUserByEmail($email);
        if($obUser instanceof EntityUser){
            //REDIRECIONA O USUÁRIO
            $request->getRouter()->redirect('/admin/users/new?status=duplicated');
        } */

        //NOVA INSTANCIA DE USUÁRIO
        $obUser = new EntityVideos;
        $obUser->title = $title;
        $obUser->description = $description;
        $obUser->thumbnail = $thumbnail;
        $obUser->cadastrar();

        //REDIRECIONA O USUÁRIO
        $request->getRouter()->redirect('/tcc/upload');
    }
}