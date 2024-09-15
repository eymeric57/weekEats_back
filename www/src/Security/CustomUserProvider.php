<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class CustomUserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        // Implémentez la logique pour charger l'utilisateur par son identifiant
        // Par exemple :
        // $user = $this->userRepository->findOneBy(['email' => $identifier]);
        // if (!$user) {
        //     throw new UserNotFoundException(sprintf('User "%s" not found.', $identifier));
        // }
        // return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }

        // Rechargez un utilisateur frais depuis la base de données
        // ou renvoyez simplement le même utilisateur si vous n'avez pas besoin de le rafraîchir
        // Par exemple :
        // return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class || is_subclass_of($class, User::class);
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        // Mettez à jour le mot de passe haché de l'utilisateur ici
        // Par exemple :
        // if ($user instanceof User) {
        //     $user->setPassword($newHashedPassword);
        //     $this->userRepository->save($user, true);
        // }
    }
}