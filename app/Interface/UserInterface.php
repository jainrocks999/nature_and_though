<?php

namespace App\Interface;

interface UserInterface
{
    public function getAllUser();
    public function getUserById($userId);
    public function getUserByWhereId($where, $userId);
    public function deleteUser($userId);
    public function createUser(array $createUserDetails);
    public function updateUser($userId, array $updateUserDetails);
  
}
