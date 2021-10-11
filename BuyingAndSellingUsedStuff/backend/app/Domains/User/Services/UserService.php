<?php

namespace App\Domains\User\Services;

use App\Domains\User\Dto\CreateUserProfileDto;
use App\Domains\User\User;
use App\Repository\User\UserRepositoryInterface;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
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
        return $this->userRepository->firstOrCreate($check, $payload);
    }
    public function firstOrCreateByGsuitHd(array $profile, array $check, array $payload):?Model
    {
        if (empty($profile["hd"]) || $profile["hd"] != env('GOOGLE_HD')) {
            throw new BadRequestHttpException("영진전문대 gsuit 계정이 아닙니다");
        }
        return $this->userRepository->firstOrCreate($check, $payload);
    }
    public function updateProfile(int $userId, CreateUserProfileDto $profile)
    {
        $user = $this->findById($userId);
        $user->name = $profile->name;
        $user->gender = $profile->gender;
        // $user->image = $profile->image;
        $user->save();
        return $user;
    }
    public function destroy(int $userId)
    {
        $this->userRepository->deleteById($userId);
        return "success";
    }
}
