<?php

namespace Module\MyTraining\Policies;

use Module\System\Models\SystemUser;
use Module\MyTraining\Models\MyTrainingEvent;
use Illuminate\Auth\Access\Response;

class MyTrainingEventPolicy
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
        return $user->hasPermission('view-mytraining-event');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return $user->hasPermission('show-mytraining-event');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-mytraining-event');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return $user->hasPermission('update-mytraining-event');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return $user->hasPermission('delete-mytraining-event');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return $user->hasPermission('restore-mytraining-event');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return $user->hasPermission('destroy-mytraining-event');
    }
}
