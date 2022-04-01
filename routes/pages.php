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
    function($request){
        return new Response(200,Pages\Watch::getWatch(''));
    }
]);

//ROTA WATCH Dinamica
$obRouter->get('/watch/{codeVideo}',[
    function($codeVideo){
        return new Response(200,Pages\Watch::getWatch($codeVideo));
    }
]);

//ROTA DE CADASTRO DE UM NOVO USUARIO
$obRouter->get('/upload',[
    function($request){
        return new Response(200,Pages\Upload::getNewVideo($request));
    }
]);

//ROTA DE CADASTRO DE UM NOVO USUARIO (POST)
$obRouter->post('/upload',[
    function($request){
        return new Response(200,Pages\Upload::setNewVideo($request));
    }
]);

//ROTA DE CADASTRO DE UM NOVO USUARIO (POST)
$obRouter->post('/register',[
    function($request){
        return new Response(200,Pages\Channel::setNewChannel($request));
    }
]);

//ROTA Teste Show
/* $obRouter->get('/show',[
    function(){
        return new Response(200,Pages\Show::getShow());
    }
]); */

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