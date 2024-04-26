<?php 

namespace App\Repository;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function attempt(array $credentials);
    public function logout();
    public function getUsersWithRoles();
    public function getAllRoles();
}
