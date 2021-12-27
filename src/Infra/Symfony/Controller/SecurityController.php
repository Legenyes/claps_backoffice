<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Domain\Account\User\UseCase\Register\RegisterUserRequest;
use Infra\Symfony\Form\Type\UserRegisterType;
use Infra\Symfony\Persistance\Doctrine\Entity\User;
use Infra\Symfony\Persistance\Doctrine\Repository\MemberRepository;
use Infra\Symfony\Persistance\Doctrine\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class SecurityController extends BaseController
{
    use TargetPathTrait;

    #[Route('/register', name: 'security_register')]
    public function register(
        Request $request,
        UserRepository $userRepository,
        MemberRepository $membreRepository,
        UserPasswordHasherInterface $hasher
    ): Response {
        $registerRequest = new RegisterUserRequest();

        $form = $this->createForm(UserRegisterType::class, $registerRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $userRepository->findOneByEmail($registerRequest->email);
            if ($user) {
                return $this->redirectToRoute('security_login');
            }

            $membre = $membreRepository->findOneByEmail($registerRequest->email);
            if (!$membre) {
                $this->addFlash('error', 'user.updated_successfully');
                return $this->redirectToRoute('security_register');
            }

            $user = new User();
            $user->setEmail($membre->getEmail());
            $user->setFirstName($membre->getFirstname());
            $user->setLastName($membre->getLastname());
            $user->setPassword($hasher->hashPassword($user, $registerRequest->password));
            $user->setRoles(['ROLE_USER']);

            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();

            return $this->redirectToRoute('user_edit');
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/login', name: 'security_login')]
    public function login(Request $request, Security $security, AuthenticationUtils $helper): Response
    {
        // if user is already logged in, don't display the login page again
        if ($security->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('security/login.html.twig', [
            'error' => $helper->getLastAuthenticationError(),
            'last_username' => $helper->getLastUsername(),
            'page_title' => 'Clap\'Sabots',
            'csrf_token_intention' => 'authenticate',
        ]);
    }

    /**
     * This is the route the user can use to logout.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the logout automatically. See logout in config/packages/security.yaml
     */
    #[Route('/logout', name: 'security_logout')]
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }
}
