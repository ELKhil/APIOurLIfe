<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ImageController extends AbstractController
{
    #[Get('images/{filename}')]
    #[View]
    public function getImage(string $filename, ParameterBagInterface $parameterBag,)
    {
        $path = $parameterBag->get('pictures_directory') . '/' . $filename;

        if (!file_exists($path)) {
            throw $this->createNotFoundException('Image non trouvée');
        }

        $response = new BinaryFileResponse($path);
        $response->headers->set('Content-Type', mime_content_type($path));

        return $response;
    }


}

