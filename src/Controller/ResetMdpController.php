<?php

namespace App\Controller;

use App\Dto\user\UserDto;
use App\Entity\User;
use App\Mappers\UserMappers;
use App\Repository\UserRepository;
use App\Service\JWTService;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class ResetMdpController extends AbstractController
{
    #[Post('api/forgetpassword/{email}')]
    #[View]
    public function forgetPassword(string $email,
                                   JWTService $jwt,
                               UserRepository $usersRepository,
                               EntityManagerInterface $em,
                                TokenGeneratorInterface $tokenGenerator,
                            SendMailService $sendMailService): Response
    {


        //On check si l'utilisateur existe par son email
        $user = $usersRepository->findOneBy(['email' => $email]);

        if($user) {

            //1. On génére un token de réinitialisation pour l'utilisateur
            $token = $tokenGenerator->generateToken();
            //dd($token);	//Vérifie qu'on génére bien un token unique
            $user->setResetToken($token);
            $em->persist($user);
            $em->flush();


            //3.On crée le mail de réinitialisation
            $context = [
                'token' => $token,
                'user'=>$user,
            ];

            //4. On envoie le mail
           $sendMailService->send(
                'brad@sandbox773f5109dd414fd18763ad3a7ec61d72.mailgun.org ',
                $user->getEmail(),
                'Réinitialisation du mot de passe',
                'passwordReset',
                $context
            );
            return new JsonResponse([
                'message' => "Bonjour " . $user->getFullName().
                    " Pour votre demande de réinitialisation, Un email été envoyé à l'adresse " .$user->getEmail() ." . Ce lien expirera dans 30 minutes . Merci :)"
            ], 200);
        }else{

            return new JsonResponse([
                'message' => "Malheureusement ce email n'existe pas dans notre base de données."
            ], 401);

        }

    }

    #[POST('api/newpassword')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    public function resetPass(UserDto $dto, UserRepository $userRepository, EntityManagerInterface $entityManagerInterface,
                              UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em):Response{




        //1.Vérifier si on a le token dans la base de donnée
        $user = $userRepository->findOneBy(['resetToken' => $dto->getRestToken()]);



        if ($user){

            $user->setPassword($passwordHasher->hashPassword($user, $dto->getPassword()));

                //On efface le token
                $user->setResetToken('');

                $em->persist($user);
                $em->flush();


            return new JsonResponse([
                'message' => "Nous tenons à vous informer que votre demande de réinitialisation de mot de passe a été traitée avec succès. Votre mot de passe pour " .$user->getFullName() ." a bien été réinitialisé."
            ], 200);

        }else{
            return new JsonResponse([
                'message' => "Malheureusement l'opération à échoué"
            ], 401);

        }


    }
}
