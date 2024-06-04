<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
    private  $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this -> params = $params;
    }

    public function add(UploadedFile $picture, ?string $folder = '', ?int $width = 250, ?int $height = 250 )
    {
        //On donne un nouveau nom à l'image

        $fichier = md5(uniqid(rand(), true)).'.png';

        //on récupère les infos de l'image 
        $picture_infos = getimagesize($picture);

        if($picture_infos = false){
            throw new Exception('Format d\'image incorrect');
        }

        //On vérifie le format de l'image 
        switch ($picture->getMimeType()) {
            case 'image/png':
                $picture_source = imagecreatefrompng($picture);
                break;
            case 'image/jpeg':
                $picture_source = imagecreatefromjpeg($picture);
                break;
            case 'image/webp':
                $picture_source = imagecreatefromwebp($picture);
                break;
            default:
                throw new Exception('Format d\'image incorrect');
        }
        // on recadre l'image 
        //on récupère les dimension
        $imageWidth = getimagesize($picture)[0];
        $imageheight = getimagesize($picture)[1];

        //on vérifie l'orientation de l'image

        switch ($imageWidth <=> $imageheight ) {
            case -1: //portrait
                $squarreSize = $imageWidth;
                $src_x = 0;
                $src_y = ($imageheight - $squarreSize) / 2;
                break;
            case 0: // carré
                $squarreSize = $imageWidth;
                $src_x = 0;
                $src_y = 0;
                break;
            case 1: //paysage
                $squarreSize = $imageheight;
                $src_x = ($imageWidth - $squarreSize) / 2;
                $src_y = 0;
                break;
            default:
                throw new Exception('Format d\'image incorrect');
                break;
        }   

        $resized_picture =  imagecreatetruecolor($width, $height);

        imagecopyresampled($resized_picture, $picture_source, 0, 0,
        $src_x, $src_y, $width, $height,$squarreSize, $squarreSize);

        $path = $this -> params->get('images_directory');

        // on créé le dossier de destination s'il n'existe pas 

        if(!file_exists($path. '/images/')){
            mkdir($path. '/images/', 0755, true);
        }

        $relativePath = $folder . '/' . $width . 'x' . $height . '-' . $fichier;
        $fullPath = $path . '/' . $relativePath;

        //on stock l'image recadré 
        imagepng($resized_picture, $path. '/images/'. $width.'x'. $height.'-'. $fichier);

        $picture->move($path. '/images/',$fichier);

        return $relativePath ;
    }

    public function delete(string $fichier, ?string $folder = '', ?int $width = 250, ?int $height = 250)
    {
        if($fichier !== 'dafault.webp'){
            $success = false;
            $path = $this -> params->get('images_directory'). $folder;
            $mini = $path. '/mini'. $width.'x'. $height.'-'.$fichier;

            if(file_exists($mini)){
                unlink($mini);
                $success =true;
            }

            $original = $path.'/'.$fichier;

            if(file_exists($original)){
                unlink($original);
                $success =true;
            }

            return $success;
        }

        return false;
    }
}