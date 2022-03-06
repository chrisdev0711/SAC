<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PlugCheck;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlugCheckPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the plugCheck can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list plugchecks');
    }

    /**
     * Determine whether the plugCheck can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PlugCheck  $model
     * @return mixed
     */
    public function view(User $user, PlugCheck $model)
    {
        return $user->hasPermissionTo('view plugchecks');
    }

    /**
     * Determine whether the plugCheck can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create plugchecks');
    }

    /**
     * Determine whether the plugCheck can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PlugCheck  $model
     * @return mixed
     */
    public function update(User $user, PlugCheck $model)
    {
        return $user->hasPermissionTo('update plugchecks');
    }

    /**
     * Determine whether the plugCheck can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PlugCheck  $model
     * @return mixed
     */
    public function delete(User $user, PlugCheck $model)
    {
        return $user->hasPermissionTo('delete plugchecks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PlugCheck  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete plugchecks');
    }

    /**
     * Determine whether the plugCheck can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PlugCheck  $model
     * @return mixed
     */
    public function restore(User $user, PlugCheck $model)
    {
        return false;
    }

    /**
     * Determine whether the plugCheck can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PlugCheck  $model
     * @return mixed
     */
    public function forceDelete(User $user, PlugCheck $model)
    {
        return false;
    }
}
