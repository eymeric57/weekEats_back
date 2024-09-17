<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login', methods: ['POST'])] // Route for login
    public function login(
        Request $request,
        UserProviderInterface $userProvider,
        UserPasswordHasherInterface $passwordHasher
    ): JsonResponse {
        // Retrieve request data
        $data = json_decode($request->getContent(), true);
        $useremail = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (!$useremail || !$password) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Email and password required'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Load the user by their email
        try {
            $user = $userProvider->loadUserByIdentifier($useremail);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => 'User not found'
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        // Verify credentials
        if (!$passwordHasher->isPasswordValid($user, $password)) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Invalid credentials'
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        // Return JSON response with user details
        return new JsonResponse([
            'success' => true,
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'message' => 'Login successful'
        ]);
    }
}
