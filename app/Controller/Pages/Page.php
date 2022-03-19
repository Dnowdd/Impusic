<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Controller\Pages;

class Page{
    /**
     * Método responsável por renderizar o topo da página
     * @return string
     */
    private static function getHeader(){
        return View::render('pages/header');
    }

    /**
     * Método responsável por renderizar o rodapé da página
     * @return string
     */
    private static function getFooter(){
        return View::render('pages/footer');
    }

    /**
     * Método responsável por retornar o conteúdo (view) da nossa página genérica
     * @return string
     */
    public static function getPage($css,$title,$description,$content){
        return View::render('pages/page',[
            'css' => $css,
            'title' => $title,
            'description' => $description,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }

    /**
     * Método responsável por retornar o conteúdo (view) da nossa página de erro
     * @return string
     */
    public static function getErrorPage($css,$title,$description,$content){
        return View::render('pages/page',[
            'css' => $css,
            'title' => $title,
            'description' => $description,
            'header' => '',
            'content' => $content,
            'footer' => ''
        ]);
    }

    /**
     * Método responsável por renderizar a view do painel com conteúdos dinâmicos
     * @param string $title
     * @param string $content
     * @param string $currentModule
     * @return string
     */
    public static function getPanel($css,$title,$content){
        //RETORNA A PÁGINA RENDERIZADA
        return self::getPage($css,$title,'',$content);
    }
}