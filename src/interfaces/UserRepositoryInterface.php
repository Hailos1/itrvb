<?php

namespace Repositories;

use Model\User;
use Model\UUID;

interface UserRepositoryInterface {
    public function save(User $user): void;
    public function get(UUID $uuid): User;
    public function getByUsername(string $username): User;
}