<?php

namespace App\Repository\User;

use App\Domains\User\Dto\CreateUserProfileDto;
use App\Domains\User\User;
use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function updateProfile(int $modelId, CreateUserProfileDto $profile): ?Model
    {
        $user = User::find($modelId);
        $user->name = $profile->name;
        $user->gender = $profile->gender;
        // $user->image = $profile->image;
        $user->save();
        return $user;
    }
}
