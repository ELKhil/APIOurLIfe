<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/images/{filename}', name: 'app_get_image', methods: ["GET"])]
    public function getImage($filename, ParameterBagInterface $parameterBag,)
    {
        $path = $parameterBag->get('pictures_directory') . '/' . $filename;

        if (!file_exists($path)) {
            throw $this->createNotFoundException('Image non trouvée');
        }

        return new BinaryFileResponse($path);
    }

}
