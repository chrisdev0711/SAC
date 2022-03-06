<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ebay;
use Illuminate\Auth\Access\HandlesAuthorization;

class EbayPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the ebay can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list ebays');
    }

    /**
     * Determine whether the ebay can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ebay  $model
     * @return mixed
     */
    public function view(User $user, Ebay $model)
    {
        return $user->hasPermissionTo('view ebays');
    }

    /**
     * Determine whether the ebay can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create ebays');
    }

    /**
     * Determine whether the ebay can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ebay  $model
     * @return mixed
     */
    public function update(User $user, Ebay $model)
    {
        return $user->hasPermissionTo('update ebays');
    }

    /**
     * Determine whether the ebay can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ebay  $model
     * @return mixed
     */
    public function delete(User $user, Ebay $model)
    {
        return $user->hasPermissionTo('delete ebays');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ebay  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete ebays');
    }

    /**
     * Determine whether the ebay can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ebay  $model
     * @return mixed
     */
    public function restore(User $user, Ebay $model)
    {
        return false;
    }

    /**
     * Determine whether the ebay can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ebay  $model
     * @return mixed
     */
    public function forceDelete(User $user, Ebay $model)
    {
        return false;
    }
}
