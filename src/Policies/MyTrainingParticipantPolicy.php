<?php

namespace Module\MyTraining\Policies;

use Module\System\Models\SystemUser;
use Module\MyTraining\Models\MyTrainingParticipant;
use Illuminate\Auth\Access\Response;

class MyTrainingParticipantPolicy
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
        return $user->hasPermission('view-mytraining-participant');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyTrainingParticipant $myTrainingParticipant): bool
    {
        return $user->hasPermission('show-mytraining-participant');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-mytraining-participant');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyTrainingParticipant $myTrainingParticipant): bool
    {
        return $user->hasPermission('update-mytraining-participant');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyTrainingParticipant $myTrainingParticipant): bool
    {
        return $user->hasPermission('delete-mytraining-participant');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyTrainingParticipant $myTrainingParticipant): bool
    {
        return $user->hasPermission('restore-mytraining-participant');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyTrainingParticipant $myTrainingParticipant): bool
    {
        return $user->hasPermission('destroy-mytraining-participant');
    }
}
