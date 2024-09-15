<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Request $request, JWTTokenManagerInterface $jwtManager, UserProviderInterface $userProvider): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);
        $useremail = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        // Vérifiez si l'utilisateur est déjà connecté
        if ($this->getUser()) {
            return new JsonResponse([
                'success' => true,
                'id' => $this->getUser()->getId(),
                'email' => $this->getUser()->getEmail(),
                'name' => $this->getUser()->getName(),
                'surname' => $this->getUser()->getSurname(),
                'message' => 'Utilisateur déjà en session'
            ]);
        }

        // Vérifiez si l'utilisateur existe
        $user = $userProvider->loadUserByIdentifier($useremail);

        // Vérifiez les informations d'identification
        if (!$user || !password_verify($password, $user->getPassword())) {
            throw new AuthenticationException('Invalid credentials');
        }

        // Authentification réussie, générez le token JWT
        $token = $jwtManager->create($user);

        return new JsonResponse([
            'success' => true,
            'token' => $token,
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'message' => 'Connexion réussie'
        ]);
    }
}