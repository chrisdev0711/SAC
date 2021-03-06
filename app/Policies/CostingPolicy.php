<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Costing;
use Illuminate\Auth\Access\HandlesAuthorization;

class CostingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the costing can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list costings');
    }

    /**
     * Determine whether the costing can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Costing  $model
     * @return mixed
     */
    public function view(User $user, Costing $model)
    {
        return $user->hasPermissionTo('view costings');
    }

    /**
     * Determine whether the costing can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create costings');
    }

    /**
     * Determine whether the costing can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Costing  $model
     * @return mixed
     */
    public function update(User $user, Costing $model)
    {
        return $user->hasPermissionTo('update costings');
    }

    /**
     * Determine whether the costing can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Costing  $model
     * @return mixed
     */
    public function delete(User $user, Costing $model)
    {
        return $user->hasPermissionTo('delete costings');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Costing  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete costings');
    }

    /**
     * Determine whether the costing can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Costing  $model
     * @return mixed
     */
    public function restore(User $user, Costing $model)
    {
        return false;
    }

    /**
     * Determine whether the costing can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Costing  $model
     * @return mixed
     */
    public function forceDelete(User $user, Costing $model)
    {
        return false;
    }
}
