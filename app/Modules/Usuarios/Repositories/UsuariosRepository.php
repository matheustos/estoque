<?php

namespace App\Modules\Usuarios\Repositories;
use App\Modules\Usuarios\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuariosRepository
{
    public function getAllUsuarios()
    {
        return Usuario::all();
    }

    public function getUsuarioPorId($id)
    {
        return Usuario::find($id);
    }

    public function getUsuarioPorEmail($email)
    {
        return Usuario::where('email', $email)->first();
    }

    public function updateUsuario($id, array $data)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return null;
        }
        $usuario->update($data);
        return $usuario;
    }

    public function updateSenha($id, $newPassword)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return null;
        }

        $usuario->update([
            'password' => $newPassword
        ]);
        return $usuario;
    }

    public function deleteUsuario($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return null;
        }
        $usuario->delete();
        return true;
    }
}