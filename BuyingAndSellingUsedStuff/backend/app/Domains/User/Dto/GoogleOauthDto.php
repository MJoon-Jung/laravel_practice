<?php

namespace App\Domains\User\Dto;

use Illuminate\Http\Request;

class GoogleOauthDto
{
    private string $email;
    private string $name;
    private ?string $hd;
    private string $password;

    public function __construct(string $id, string $email, string $name, string $hd=null)
    {
        $this->email = $email;
        $this->name = $name;
        $this->hd = $hd;
        $this->password = bcrypt($id);
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getHd()
    {
        return $this->hd;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function isNotGsuitEmail()
    {
        if ($this->hd) {
            return false;
        }
        return true;
    }
}
