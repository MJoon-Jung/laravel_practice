<?php

namespace App\Policies;

use App\Domains\User\Models\User;
use App\Domains\Group\Models\GroupUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function create(User $user, GroupUser $member)
    {
        return $member->group_admin;
    }
    public function update(User $user, GroupUser $member)
    {
        return $member->group_admin;
    }
    public function delete(User $user, GroupUser $member)
    {
        return $member->group_admin;
    }
}
