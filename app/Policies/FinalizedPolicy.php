<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Finalized;
use Illuminate\Auth\Access\HandlesAuthorization;

class FinalizedPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the finalized can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list finalized');
    }

    /**
     * Determine whether the finalized can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Finalized  $model
     * @return mixed
     */
    public function view(User $user, Finalized $model)
    {
        return $user->hasPermissionTo('view finalized');
    }

    /**
     * Determine whether the finalized can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create finalized');
    }

    /**
     * Determine whether the finalized can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Finalized  $model
     * @return mixed
     */
    public function update(User $user, Finalized $model)
    {
        return $user->hasPermissionTo('update finalized');
    }

    /**
     * Determine whether the finalized can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Finalized  $model
     * @return mixed
     */
    public function delete(User $user, Finalized $model)
    {
        return $user->hasPermissionTo('delete finalized');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Finalized  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete finalized');
    }

    /**
     * Determine whether the finalized can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Finalized  $model
     * @return mixed
     */
    public function restore(User $user, Finalized $model)
    {
        return false;
    }

    /**
     * Determine whether the finalized can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Finalized  $model
     * @return mixed
     */
    public function forceDelete(User $user, Finalized $model)
    {
        return false;
    }
}
