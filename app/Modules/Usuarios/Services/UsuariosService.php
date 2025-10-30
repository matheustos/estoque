<?php

namespace App\Modules\Usuarios\Services;
use App\Modules\Usuarios\Repositories\UsuariosRepository;
use Illuminate\Support\Str;
use App\Mail\UsuarioMail;
use Illuminate\Support\Facades\Mail;

class UsuariosService
{
    protected $usuariosRepository;

    public function __construct(UsuariosRepository $usuariosRepository)
    {
        $this->usuariosRepository = $usuariosRepository;
    }

    public function listarUsuarios()
    {
        $usuarios = $this->usuariosRepository->getAllUsuarios();
        if ($usuarios->isEmpty()) {
            return null;
        }
        return $usuarios;
    }

    public function pegarUsuarioPorId($id)
    {
        $usuario = $this->usuariosRepository->getUsuarioPorId($id);

        if (!$usuario) {
            return null;
        }
        return $usuario;
    }

    public function atualizarUsuario($id, array $data)
    {
        $usuario = $this->usuariosRepository->updateUsuario($id, $data);

        if (!$usuario) {
            return null;
        }
        return $usuario;
    }

    public function deletarUsuario($id)
    {
        $usuario = $this->usuariosRepository->deleteUsuario($id);

        if (!$usuario) {
            return null;
        }
        return $usuario;
    }

    public function resetarSenha($email)
    {
        $usuario = $this->usuariosRepository->getUsuarioPorEmail($email);
        if (!$usuario) {
            return null;
        }else{
            $newPassword = Str::random(8);
            $id = $usuario->id;
            $this->usuariosRepository->updateSenha($id, $newPassword);
            Mail::to($usuario->email)->send(new UsuarioMail($usuario, $newPassword));
            return $usuario;
        }
    }

    public function resetarSenhaLogado($email, $senha)
    {
        $usuario = $this->usuariosRepository->getUsuarioPorEmail($email);
        if (!$usuario) {
            return null;
        }else{
            $id = $usuario->id;
            $this->usuariosRepository->updateSenha($id, $senha);
            return $usuario;
        }
    }
}