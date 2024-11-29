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
        return $user->hasPermission('view-mytraining-question');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyTrainingQuestion $myTrainingQuestion): bool
    {
        return $user->hasPermission('show-mytraining-question');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-mytraining-question');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyTrainingQuestion $myTrainingQuestion): bool
    {
        return $user->hasPermission('update-mytraining-question');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyTrainingQuestion $myTrainingQuestion): bool
    {
        return $user->hasPermission('delete-mytraining-question');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyTrainingQuestion $myTrainingQuestion): bool
    {
        return $user->hasPermission('restore-mytraining-question');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyTrainingQuestion $myTrainingQuestion): bool
    {
        return $user->hasPermission('destroy-mytraining-question');
    }
}
