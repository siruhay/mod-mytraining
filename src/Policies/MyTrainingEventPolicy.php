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
        return $user->hasPermission('view-mytraining-event', 'view-mytraining-history');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return
            $myTrainingEvent->participants()->firstWhere('particiable_id', $user->userable->id) &&
            $user->hasPermission('show-mytraining-event', 'show-mytraining-history');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-mytraining-event', 'create-mytraining-history');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return $user->hasPermission('update-mytraining-event', 'update-mytraining-history');
    }

    /**
     * presence function
     *
     * @param SystemUser $user
     * @param MyTrainingEvent $myTrainingEvent
     * @return boolean
     */
    public function presence(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return
            $myTrainingEvent->status === 'PUBLISHED' &&
            $user->hasLicenseAs('mytraining-member');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return $user->hasPermission('delete-mytraining-event', 'delete-mytraining-history');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return $user->hasPermission('restore-mytraining-event', 'restore-mytraining-history');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyTrainingEvent $myTrainingEvent): bool
    {
        return $user->hasPermission('destroy-mytraining-event', 'destroy-mytraining-history');
    }
}
