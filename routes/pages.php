<?php

use \App\Http\Response;
use \App\Controller\Pages;

//ROTA HOME
$obRouter->get('/',[
    function(){
        return new Response(200,Pages\Home::getHome());
    }
]);

//ROTA WATCH
$obRouter->get('/watch',[
    function(){
        return new Response(200,Pages\Watch::getWatch());
    }
]);

/* //ROTA DISCORD
$obRouter->get('/discord',[
    'middlewares' => [
        'cache'
    ],
    function(){
        return new Response(200,Pages\Socials::Discord());
    }
]);

//ROTA ERRO
$obRouter->get('/error',[
    'middlewares' => [
        'cache'
    ],
    function($request){
        return new Response(200,Pages\Error::getError($request));
    }
]); */





//ROTA DEPOIMENTOS
/* $obRouter->get('/depoimentos',[
    'middlewares' => [
        'cache'
    ],
    function($request){
        return new Response(200,Pages\Testimony::getTestimonies($request));
    }
]); */

//ROTA DEPOIMENTOS (INSERT)
/* $obRouter->post('/depoimentos',[
    function($request){
        return new Response(200,Pages\Testimony::insertTestimony($request));
    }
]); */








//ROTA DINÂMICA
/* $obRouter->get('/pagina/{idPagina}/{acao}',[
    function($idPagina,$acao){
        return new Response(200,'Página '.$idPagina.' = '.$acao);
    }
]); */