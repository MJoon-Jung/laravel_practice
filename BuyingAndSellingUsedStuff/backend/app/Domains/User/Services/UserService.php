<?php

namespace App\Domains\User\Services;

use App\Repository\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all():Collection
    {
        return $this->userRepository->all();
    }
    public function findById(int $id):?Model
    {
        return $this->userRepository->findById($id);
    }
    public function firstOrCreate(array $check, array $payload):?Model
    {
        return $this->UserRepository->firstOrCreate($check, $payload);
    }
    public function firstOrCreateByGsuitHd($profile, array $check, array $payload):?Model
    {
        if (empty($profile["hd"]) || $profile["hd"] != env('GOOGLE_HD')) {
            throw new BadRequestHttpException("영진전문대 gsuit 계정이 아닙니다");
        }
        return $this->firstOrCreate($check, $payload);
    }
}
