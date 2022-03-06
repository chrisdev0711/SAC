<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appliance;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppliancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the appliance can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list appliances');
    }

    /**
     * Determine whether the appliance can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appliance  $model
     * @return mixed
     */
    public function view(User $user, Appliance $model)
    {
        return $user->hasPermissionTo('view appliances');
    }

    /**
     * Determine whether the appliance can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create appliances');
    }

    /**
     * Determine whether the appliance can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appliance  $model
     * @return mixed
     */
    public function update(User $user, Appliance $model)
    {
        return $user->hasPermissionTo('update appliances');
    }

    /**
     * Determine whether the appliance can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appliance  $model
     * @return mixed
     */
    public function delete(User $user, Appliance $model)
    {
        return $user->hasPermissionTo('delete appliances');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appliance  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete appliances');
    }

    /**
     * Determine whether the appliance can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appliance  $model
     * @return mixed
     */
    public function restore(User $user, Appliance $model)
    {
        return false;
    }

    /**
     * Determine whether the appliance can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Appliance  $model
     * @return mixed
     */
    public function forceDelete(User $user, Appliance $model)
    {
        return false;
    }
}
