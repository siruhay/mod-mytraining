<?php

namespace Module\MyTraining\Policies;

use Module\System\Models\SystemUser;
use Module\MyTraining\Models\MyTrainingPretest;
use Illuminate\Auth\Access\Response;

class MyTrainingPretestPolicy
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
        return $user->hasPermission('view-mytraining-pretest');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyTrainingPretest $myTrainingPretest): bool
    {
        return $user->hasPermission('show-mytraining-pretest');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-mytraining-pretest');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyTrainingPretest $myTrainingPretest): bool
    {
        $isParticipant = $myTrainingPretest
            ->event
            ->participants()
            ->where('particiable_id', $user->userable->id)->count() > 0;

        return
            $isParticipant &&
            $myTrainingPretest->mode === 'PRETEST' &&
            $user->hasLicenseAs('mytraining-member') &&
            $user->hasPermission('update-mytraining-pretest');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyTrainingPretest $myTrainingPretest): bool
    {
        return $user->hasPermission('delete-mytraining-pretest');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyTrainingPretest $myTrainingPretest): bool
    {
        return $user->hasPermission('restore-mytraining-pretest');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyTrainingPretest $myTrainingPretest): bool
    {
        return $user->hasPermission('destroy-mytraining-pretest');
    }
}
