<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Action;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the action can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list actions');
    }

    /**
     * Determine whether the action can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Action  $model
     * @return mixed
     */
    public function view(User $user, Action $model)
    {
        return $user->hasPermissionTo('view actions');
    }

    /**
     * Determine whether the action can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create actions');
    }

    /**
     * Determine whether the action can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Action  $model
     * @return mixed
     */
    public function update(User $user, Action $model)
    {
        return $user->hasPermissionTo('update actions');
    }

    /**
     * Determine whether the action can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Action  $model
     * @return mixed
     */
    public function delete(User $user, Action $model)
    {
        return $user->hasPermissionTo('delete actions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Action  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete actions');
    }

    /**
     * Determine whether the action can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Action  $model
     * @return mixed
     */
    public function restore(User $user, Action $model)
    {
        return false;
    }

    /**
     * Determine whether the action can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Action  $model
     * @return mixed
     */
    public function forceDelete(User $user, Action $model)
    {
        return false;
    }
}
