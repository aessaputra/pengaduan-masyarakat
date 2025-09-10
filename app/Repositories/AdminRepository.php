<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements AdminRepositoryInterface
{
    public function getAllAdmins()
    {
        return User::role('admin')->paginate(10);
    }

    public function getAdminById($id)
    {
        return User::findOrFail($id);
    }

    public function createAdmin(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('admin');
        return $user;
    }

    public function updateAdmin(array $data, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        return $user->save();
    }

    public function deleteAdmin($id)
    {
        return User::destroy($id);
    }
}
