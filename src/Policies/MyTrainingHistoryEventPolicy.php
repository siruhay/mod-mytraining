<?php

namespace Module\MyTraining\Policies;

use Module\System\Models\SystemUser;
use Module\MyTraining\Models\MyTrainingHistoryEvent;
use Illuminate\Auth\Access\Response;

class MyTrainingHistoryEventPolicy
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
        return $user->hasPermission('view-mytraining-historyevent');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyTrainingHistoryEvent $myTrainingHistoryEvent): bool
    {
        return $user->hasPermission('show-mytraining-historyevent');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-mytraining-historyevent');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyTrainingHistoryEvent $myTrainingHistoryEvent): bool
    {
        return $user->hasPermission('update-mytraining-historyevent');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyTrainingHistoryEvent $myTrainingHistoryEvent): bool
    {
        return $user->hasPermission('delete-mytraining-historyevent');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyTrainingHistoryEvent $myTrainingHistoryEvent): bool
    {
        return $user->hasPermission('restore-mytraining-historyevent');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyTrainingHistoryEvent $myTrainingHistoryEvent): bool
    {
        return $user->hasPermission('destroy-mytraining-historyevent');
    }
}
