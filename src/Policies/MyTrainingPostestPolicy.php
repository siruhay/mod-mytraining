<?php

namespace Module\MyTraining\Policies;

use Module\System\Models\SystemUser;
use Module\MyTraining\Models\MyTrainingPostest;
use Illuminate\Auth\Access\Response;

class MyTrainingPostestPolicy
{
    /**
    * Perform pre-authorization checks.
    */
    public function before(SystemUser $user, string $ability): bool|null
    {
        if ($user->hasLicenseAs('mytraining-superadmin')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function view(SystemUser $user): bool
    {
        return $user->hasLicenseAs('mytraining-member') && $user->hasPermission('view-mytraining-postest');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyTrainingPostest $myTrainingPostest): bool
    {
        return $user->hasPermission('show-mytraining-postest');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-mytraining-postest');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyTrainingPostest $myTrainingPostest): bool
    {
        $isParticipant = $myTrainingPostest
            ->event
            ->participants()
            ->where('particiable_id', $user->userable->id)->count() > 0;

        return
            $isParticipant &&
            $myTrainingPostest->mode === 'POSTEST' &&
            $user->hasLicenseAs('mytraining-member') &&
            $user->hasPermission('update-mytraining-postest');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyTrainingPostest $myTrainingPostest): bool
    {
        return $user->hasPermission('delete-mytraining-postest');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyTrainingPostest $myTrainingPostest): bool
    {
        return $user->hasPermission('restore-mytraining-postest');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyTrainingPostest $myTrainingPostest): bool
    {
        return $user->hasPermission('destroy-mytraining-postest');
    }
}
