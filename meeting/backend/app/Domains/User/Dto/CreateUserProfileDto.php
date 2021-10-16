<?php

namespace App\Domains\User\Dto;

class CreateUserProfileDto
{
    private string $name;
    private string $gender;
    private ?string $image;

    public function __construct(string $name, int $gender, string $image=null)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->image = $image;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getGender()
    {
        return $this->gender;
    }
    public function getImage()
    {
        return $this?->image;
    }
    public function setImage(string $image)
    {
        $this->image = $image;
    }
}
