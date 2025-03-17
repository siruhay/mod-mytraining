<?php

namespace Module\MyTraining\Policies;

use Module\System\Models\SystemUser;
use Module\MyTraining\Models\MyTrainingQuestion;
use Illuminate\Auth\Access\Response;

class MyTrainingQuestionPolicy
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
        return $user->hasAnyPermission('view-mytraining-pretest', 'view-mytraining-postest', 'view-mytraining-history-pretest', 'view-mytraining-history-postest');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyTrainingQuestion $myTrainingQuestion): bool
    {
        return $user->hasAnyPermission('show-mytraining-pretest', 'show-mytraining-postest', 'show-mytraining-history-pretest', 'show-mytraining-history-postest');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return
            $user->hasLicenseAs('mytraining-speaker') &&
            $user->hasAnyPermission('create-mytraining-pretest', 'create-mytraining-postest', 'create-mytraining-prhistory-etest', 'create-mytraining-history-postest');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyTrainingQuestion $myTrainingQuestion): bool
    {
        return
            $user->hasLicenseAs('mytraining-speaker') &&
            $user->hasAnyPermission('update-mytraining-pretest', 'update-mytraining-postest', 'update-mytraining-prhistory-etest', 'update-mytraining-history-postest');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyTrainingQuestion $myTrainingQuestion): bool
    {
        return
            $user->hasLicenseAs('mytraining-speaker') &&
            $user->hasAnyPermission('delete-mytraining-pretest', 'delete-mytraining-postest', 'delete-mytraining-prhistory-etest', 'delete-mytraining-history-postest');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyTrainingQuestion $myTrainingQuestion): bool
    {
        return $user->hasAnyPermission('restore-mytraining-pretest', 'restore-mytraining-postest', 'restore-mytraining-prehistory-test', 'restore-mytraining-history-postest');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyTrainingQuestion $myTrainingQuestion): bool
    {
        return $user->hasAnyPermission('destroy-mytraining-pretest', 'destroy-mytraining-postest', 'destroy-mytraining-prehistory-test', 'destroy-mytraining-history-postest');
    }
}
