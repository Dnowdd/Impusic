<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Videos{

    /**
     * ID do usuário
     * @var integer
     */
    public $id;

    /**
     * Titulo do video
     * @var string
     */
    public $title;

    /**
     * Descricao do video
     * @var string
     */
    public $description;

    /**
     * Nome do canal
     * @var string
     */
    public $channel = "Dnowd";

    /**
     * Thumbnail do video
     * @var string
     */
    public $thumbnail;

    /**
     * Data do video
     * @var string
     */
    public $data = "data";

    /**
     * Método responsável por cadastrar a instancia atual no banco de dados
     * @return boolean
     */
    public function cadastrar(){
        //INSERE A INSTANCIA NO BANCO
        $this->id = (new Database('videos'))->insert([
            'title' => $this->title,
            'description' => $this->description,
            'channel' => $this->channel,
            'thumbnail' => $this->thumbnail,
            'data' => $this->data
        ]);

        //SUCESSO
        return true;
    }

    /**
     * Método responsável por atualizar os dados do banco
     * @return boolean
     */
    public function atualizar(){
        return (new Database('videos'))->update('id = '.$this->id,[
            'title' => $this->title,
            'description' => $this->description,
            'channel' => $this->channel,
            'thumbnail' => $this->thumbnail,
            'data' => $this->data
        ]);
    }

    /**
     * Método responsável por excluir um usuário do banco
     * @return boolean
     */
    public function excluir(){
        return (new Database('videos'))->delete('id = '.$this->id);
    }

    /**
     * Método responsável por retornar uma instancia com base em seu id
     * @param integer $id
     * @return User
     */
    public static function getVideoById($id){
        return self::getVideos('id = '.$id)->fetchObject(self::class);
    }

    /**
     * Método responsável por retornar Usuarios
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public static function getVideos($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('videos'))->select($where,$order,$limit,$fields);
    }
}