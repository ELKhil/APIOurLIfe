<?php

namespace App\Controller;

use App\Dto\user\UserDto;
use App\Entity\User;
use App\Mappers\UserMappers;
use App\Repository\CommentaireRepository;
use App\Repository\PostRepository;
use App\Repository\SchollBranchRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Service\JWTService;
use App\Service\SendMailService;



class UserController extends AbstractFOSRestController
{
    #[POST('api/user')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    public function post(   UserDto $dto,
                            UserPasswordHasherInterface $hasher,
                            EntityManagerInterface $em,
                            ParameterBagInterface $parameterBag,
                            SendMailService $mail,
                            JWTService $jwt,
                            SchollBranchRepository $schollBranchRepository,
                            UserRepository $userRepository
                           )
    {


        // transform DTO in entity(mapping)
        $user = UserMappers::RegisterDTOToUser($dto,$hasher,$schollBranchRepository);

        if($dto->getImageProfil() !== null){
            $name = uniqid();
            $base64 = explode(',',$dto->getImageProfil())[1];
            file_put_contents($parameterBag->get('pictures_directory').'/'.$name,base64_decode($base64));
            $user->setImageProfil($name);
            $user->setActive(false);
        }


        $emailExiste = $userRepository->findOneBy(['email' => $dto->getEmail()]);
        if($emailExiste){
            return new JsonResponse([
                'message' => "Cette adresse e-mail est déjà utilisée"
            ], 401);
        }
        $user->setEmail($dto->getEmail());

        $user->setStars(1000);
        $em->persist($user);
        $em->flush();



        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        //2->On crée le payload
        $payload = [
            'user_id' => $user->getId()
        ];


        //3->On crée le token
        $token = $jwt->generate($header , $payload , $this->getParameter( 'app.jwtsecret') );

        $mail->send(
            'brad@sandbox773f5109dd414fd18763ad3a7ec61d72.mailgun.org',
            $user->getEmail(),
            'Activation de votre compte',
            'register',
            [
                'user'=>$user,
                'token'=>$token
            ]
        );


        return new JsonResponse([
            'message' => "Un email de validation a été envoyé à l'adresse " . $user->getEmail() . ". Veuillez activer votre compte en cliquant sur le lien de validation qui vous a été envoyé. Si vous n'avez pas reçu l'email, veuillez vérifier votre dossier de courrier indésirable ou contactez notre service d'assistance pour obtenir de l'aide."
        ], 200);
    }

    #[Post('api/verif/{token}')]
    #[View]
    public function verifyUser(string $token, JWTService $jwt, UserRepository $usersRepository, EntityManagerInterface $em): Response
    {

        //On vérifie si le token est valide, n'a pas expiré et n'a pas été modifié
        if($jwt->isValid($token) && !$jwt->isExpired($token) && $jwt->check($token, $this->getParameter('app.jwtsecret'))) {
            // On récupère le payload
            $payload = $jwt->getPayload($token);

            // On récupère le user du token
            $user = $usersRepository->find($payload['user_id']);

            //On vérifie que l'utilisateur existe et n'a pas encore activé son compte
            if ($user && !$user->getActive()) {
                $user->setActive(true);
                $em->persist($user);
                $em->flush();
                $this->addFlash('success', 'Utilisateur activé');

                return new JsonResponse([
                    'message' => "Nous sommes ravis de vous informer que votre adresse email a été validée avec succès. Dès à présent, vous avez la possibilité de vous connecter à notre application. Une fois connecté(e), vous aurez accès à l'ensemble des fonctionnalités que nous proposons. Profitez pleinement de votre expérience avec nous et découvrez tout ce que notre application a à offrir !"
                ], 200);
            }
        }

        // Vous devriez également ajouter une réponse en cas d'échec
        // pour gérer les cas où le token n'est pas valide, a expiré, etc.
        return new JsonResponse([
            'message' => "Malheureusement votre email n'a pas été validé"
        ], 401);
    }




        #[Get('api/allUsers')]
        #[View]
        public function getALLUsersByBranch(UserRepository $userRepository,
                                            ){

            /** @var User $user */
            $user = $this->getUser();
            $branch = $user->getSchoolBranch();
            $users = $userRepository->findAllUsersActifByBranch($branch);

            return array_map(
                fn($item) => UserMappers::UserToUserDto($item),
                $users
            );
        }

    #[Get('api/user/delet/{username}')]
    #[View]
    public function delet(string $username,
                          UserRepository $userRepository,
                          PostRepository $postRepository,
                          CommentaireRepository $commentaireRepository,
                          EntityManagerInterface $em){

       //update active user
       $user= $userRepository->findOneBy(['username' => $username]);
       $user->setActive(false);
       $em->flush();

       //update active posts
       $posts = $postRepository->findBy(['user' => $user->getId()]);
          foreach($posts as $post){
              $post->setActive(false);
              $em->flush();
          }

       $coments = $commentaireRepository->findBy(['user' => $user->getId()]);
          foreach ($coments as $coment){
              $coment->setActive(false);
              $em->flush();
          }


    }




}
