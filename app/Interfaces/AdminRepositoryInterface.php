<?php

namespace App\Interfaces;

interface AdminRepositoryInterface
{
    public function getAllAdmins();
    public function getAdminById($id);
    public function createAdmin(array $data);
    public function updateAdmin(array $data, $id);
    public function deleteAdmin($id);
}
