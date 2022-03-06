<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cleaning;
use Illuminate\Auth\Access\HandlesAuthorization;

class CleaningPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the cleaning can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list cleanings');
    }

    /**
     * Determine whether the cleaning can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cleaning  $model
     * @return mixed
     */
    public function view(User $user, Cleaning $model)
    {
        return $user->hasPermissionTo('view cleanings');
    }

    /**
     * Determine whether the cleaning can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create cleanings');
    }

    /**
     * Determine whether the cleaning can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cleaning  $model
     * @return mixed
     */
    public function update(User $user, Cleaning $model)
    {
        return $user->hasPermissionTo('update cleanings');
    }

    /**
     * Determine whether the cleaning can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cleaning  $model
     * @return mixed
     */
    public function delete(User $user, Cleaning $model)
    {
        return $user->hasPermissionTo('delete cleanings');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cleaning  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete cleanings');
    }

    /**
     * Determine whether the cleaning can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cleaning  $model
     * @return mixed
     */
    public function restore(User $user, Cleaning $model)
    {
        return false;
    }

    /**
     * Determine whether the cleaning can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cleaning  $model
     * @return mixed
     */
    public function forceDelete(User $user, Cleaning $model)
    {
        return false;
    }
}
