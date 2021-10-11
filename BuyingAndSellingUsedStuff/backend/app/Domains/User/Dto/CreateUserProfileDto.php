<?php

namespace App\Domains\User\Dto;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserProfileDto extends DataTransferObject
{
    /**
     * Built in types:
     *
     * @var string|null
     */
    public $name;

    /**
     * Built in types:
     *
     * @var int|null
     */
    public $gender;

    /**
     * Built in types:
     *
     * @var string|null
     */
    public $image;

    public static function fromRequest(Request $request)
    {
        return new self([
            'name' => $request->input('name'),
            'gender' =>$request->input('gender'),
            'image' => $request->input('image'),
        ]);
    }
}
