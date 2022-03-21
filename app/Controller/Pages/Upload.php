<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Videos as EntityVideos;
use \App\Model\Entity\Organization;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

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

    public static function sendS3($type,$keyName){
        // AWS Info
        $bucketName = getEnv("IAM_BUCKET");
        $IAM_KEY = getEnv("IAM_KEY");
        $IAM_SECRET = getEnv("IAM_SECRET");
    
        // Connect to AWS
        try {
            // You may need to change the region. It will say in the URL when the bucket is open
            // and on creation.
            $s3 = S3Client::factory(
                array(
                    'credentials' => array(
                        'key' => $IAM_KEY,
                        'secret' => $IAM_SECRET
                    ),
                    'version' => 'latest',
                    'region'  => 'sa-east-1'
                )
            );
        } catch (Exception $e) {
            return false;
            exit;
        }
    
        
        // For this, I would generate a unqiue random string for the key name. But you can do whatever.
        $keyName = $keyName.'-'.$type;

        $pathInS3 = 'https://s3.sa-east-1.amazonaws.com/'.$bucketName.'/'.$keyName;
    
        // Add it to S3
        try {
            // Uploaded:
            $file = $_FILES[$type]['tmp_name'];
    
            $s3->putObject(
                array(
                    'Bucket'=>$bucketName,
                    'Key' =>  $keyName,
                    'SourceFile' => $file,
                    'StorageClass' => 'REDUCED_REDUNDANCY'
                )
            );
    
        } catch (S3Exception $e) {
            return false;
            exit;
        } catch (Exception $e) {
            return false;
            exit;
        }
        
        return true;
    }

    
    /**
     * Método responsável por cadastrar um usuário no banco
     * @param Request $resquest
     * @return string
     */
    public static function setNewVideo($request){
        //ID ÚNICO DE THUMBNAIL E VÍDEO
        $m = microtime(true);
        $keyName = sprintf("%8x%05x\n",floor($m),($m-floor($m))*1000000);

        if(isset($_FILES['thumbnail'])){
            //ENVIA E VERIFICA O S3
            $sendS3 = self::sendS3('thumbnail',$keyName);
            if($sendS3 != true){
                return false;
                exit;
            }
        }

        if(isset($_FILES['video'])){
            //ENVIA E VERIFICA O S3
            $sendS3 = self::sendS3('video',$keyName);
            if($sendS3 != true){
                return false;
                exit;
            }
        }

        //RESGATA O TIMESTAMP DO ENVIO DO VÍDEO
        $date = date_create();
        $timestamp = date_timestamp_get($date);

        //POSTVARS
        $postVars = $request->getPostVars();

        $title = $postVars['title'] ?? '';
        $description = $postVars['description'] ?? '';
        $thumbnail = $keyName ?? '';
        $video = $keyName ?? '';

        //NOVA INSTANCIA DE USUÁRIO
        $obUser = new EntityVideos;
        $obUser->title = $title;
        $obUser->description = $description;
        $obUser->thumbnail = $thumbnail;
        $obUser->video = $video;
        $obUser->date = $timestamp;
        $obUser->cadastrar();

        //REDIRECIONA O USUÁRIO
        $request->getRouter()->redirect('/tcc/upload');
    }
}