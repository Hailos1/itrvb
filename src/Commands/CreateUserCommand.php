<?php

namespace Commands;

use Exceptions\CommandException;
use Exceptions\UserNotFoundException;
use Repositories\UserRepositoryInterface;
use Model\UUID;
use Model\User;
use Model\Name;

class CreateUserCommand {
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function userExist(string $username): bool {
        try {
            $this->userRepository->getByUsername($username);
        } catch (UserNotFoundException) {
            return false;
        }

        return true;
    }

    public function handle(Arguments $arguments): void {
        $username = $arguments->get('username');

        if ($this->userExist($username)) {
            throw new CommandException(
                "User already exists: $username"
            );
        }

        $this->userRepository->save(new User(
            UUID::random(),
            $username,
            new Name(
                $arguments->get('first_name'),
                $arguments->get('last_name')
            )
        ));
    }
}