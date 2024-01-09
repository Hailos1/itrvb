<?php

namespace my\Commands;

use Psr\Log\LoggerInterface;
use my\Exceptions\CommandException;
use my\Exceptions\UserNotFoundException;
use my\Model\Name;
use my\Model\User;
use my\Model\UUID;
use my\Repositories\UserRepositoryInterface;

class CreateUserCommand {
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private LoggerInterface $logger
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
        $this->logger->info('Create user command start');

        $username = $arguments->get('username');

        if ($this->userExist($username)) {
            $this->logger->warning("User already exists: $username");
            throw new CommandException(
                "User already exists: $username"
            );
        }

        $userUuid = UUID::random();

        $this->userRepository->save(new User(
            $userUuid,
            $username,
            new Name(
                $arguments->get('first_name'),
                $arguments->get('last_name')
            )
        ));

        $this->logger->info("User created with UUID $userUuid");
    }
}