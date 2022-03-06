<?php

namespace App\Policies;

use App\Models\User;
use App\Models\QualityControl;
use Illuminate\Auth\Access\HandlesAuthorization;

class QualityControlPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the qualityControl can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list qualitycontrols');
    }

    /**
     * Determine whether the qualityControl can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QualityControl  $model
     * @return mixed
     */
    public function view(User $user, QualityControl $model)
    {
        return $user->hasPermissionTo('view qualitycontrols');
    }

    /**
     * Determine whether the qualityControl can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create qualitycontrols');
    }

    /**
     * Determine whether the qualityControl can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QualityControl  $model
     * @return mixed
     */
    public function update(User $user, QualityControl $model)
    {
        return $user->hasPermissionTo('update qualitycontrols');
    }

    /**
     * Determine whether the qualityControl can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QualityControl  $model
     * @return mixed
     */
    public function delete(User $user, QualityControl $model)
    {
        return $user->hasPermissionTo('delete qualitycontrols');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QualityControl  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete qualitycontrols');
    }

    /**
     * Determine whether the qualityControl can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QualityControl  $model
     * @return mixed
     */
    public function restore(User $user, QualityControl $model)
    {
        return false;
    }

    /**
     * Determine whether the qualityControl can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QualityControl  $model
     * @return mixed
     */
    public function forceDelete(User $user, QualityControl $model)
    {
        return false;
    }
}
