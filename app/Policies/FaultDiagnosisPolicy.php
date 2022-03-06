<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FaultDiagnosis;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaultDiagnosisPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the faultDiagnosis can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list faultdiagnoses');
    }

    /**
     * Determine whether the faultDiagnosis can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FaultDiagnosis  $model
     * @return mixed
     */
    public function view(User $user, FaultDiagnosis $model)
    {
        return $user->hasPermissionTo('view faultdiagnoses');
    }

    /**
     * Determine whether the faultDiagnosis can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create faultdiagnoses');
    }

    /**
     * Determine whether the faultDiagnosis can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FaultDiagnosis  $model
     * @return mixed
     */
    public function update(User $user, FaultDiagnosis $model)
    {
        return $user->hasPermissionTo('update faultdiagnoses');
    }

    /**
     * Determine whether the faultDiagnosis can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FaultDiagnosis  $model
     * @return mixed
     */
    public function delete(User $user, FaultDiagnosis $model)
    {
        return $user->hasPermissionTo('delete faultdiagnoses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FaultDiagnosis  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete faultdiagnoses');
    }

    /**
     * Determine whether the faultDiagnosis can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FaultDiagnosis  $model
     * @return mixed
     */
    public function restore(User $user, FaultDiagnosis $model)
    {
        return false;
    }

    /**
     * Determine whether the faultDiagnosis can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FaultDiagnosis  $model
     * @return mixed
     */
    public function forceDelete(User $user, FaultDiagnosis $model)
    {
        return false;
    }
}
