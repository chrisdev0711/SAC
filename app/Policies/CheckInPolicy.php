<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CheckIn;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckInPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the checkIn can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list checkins');
    }

    /**
     * Determine whether the checkIn can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CheckIn  $model
     * @return mixed
     */
    public function view(User $user, CheckIn $model)
    {
        return $user->hasPermissionTo('view checkins');
    }

    /**
     * Determine whether the checkIn can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create checkins');
    }

    /**
     * Determine whether the checkIn can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CheckIn  $model
     * @return mixed
     */
    public function update(User $user, CheckIn $model)
    {
        return $user->hasPermissionTo('update checkins');
    }

    /**
     * Determine whether the checkIn can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CheckIn  $model
     * @return mixed
     */
    public function delete(User $user, CheckIn $model)
    {
        return $user->hasPermissionTo('delete checkins');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CheckIn  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete checkins');
    }

    /**
     * Determine whether the checkIn can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CheckIn  $model
     * @return mixed
     */
    public function restore(User $user, CheckIn $model)
    {
        return false;
    }

    /**
     * Determine whether the checkIn can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CheckIn  $model
     * @return mixed
     */
    public function forceDelete(User $user, CheckIn $model)
    {
        return false;
    }
}
