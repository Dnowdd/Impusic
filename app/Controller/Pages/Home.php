<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;
use \App\Model\Entity\Videos as EntityVideos;

class Home extends Page{
    public static function getPiece($name){
        $itens = '';

        $itens .= View::render('pages/home/'.$name, [
        ]);

        return $itens;
    }

    public static function getPieceWithOrganization($name,$obOrganization){
        $itens = '';

        $itens .= View::render('pages/home/'.$name, [
            'title' => $obOrganization->name
        ]);

        return $itens;
    }

    public static function time_elapsed_string($datetime, $full = false) {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . '' : 'just now';
    }

    public static function getVideoBox(){
        $itens = '';
        $videoCard = '';

        $results = EntityVideos::getVideos(null,'id DESC');

        while($obUser = $results->fetchObject(EntityVideos::class)){
            $time = self::time_elapsed_string('@'.$obUser->date);

            $videoCard .= View::render('pages/home/videoCard',[
                'videoTitle' => $obUser->title,
                'channel' => $obUser->channel,
                'thumbnail' => $obUser->thumbnail,
                'time' => $time,
                'link' => trim($obUser->video)
            ]);
        } 

        $itens .= View::render('pages/home/videoBox', [
            'videoCard' => $videoCard
        ]);

        return $itens;
    }

    /**
     * M??todo respons??vel por retornar o conte??do (view) da nossa Home
     * @return string
     */
    public static function getHome(){
        //Organiza????o
        $obOrganization = new Organization;

        //VIEW DA HOME
        $content = View::render('pages/home',[
            'hero' => self::getPieceWithOrganization('hero',$obOrganization),
            'banner' => self::getPiece('banner'),
            'videoBox' => self::getVideoBox()
        ]);

        //RETORNA A VIEW DA P??GINA
        return parent::getPage(
            //NOME DE ARQUIVOS CSS,JS...
            'home',
            //TITLE DA P??GINA
            $obOrganization->name,
            //DESCRI????O DA P??GINA
            'Bem-vindos ao RiftMaker.com - An??lise as estat??sticas de invocadores, melhores campe??es, ranking competitivo, times de Clash, Profissionais e muito mais',
            //CONTEUDO DA P??GINA
            $content
        );
    }
}