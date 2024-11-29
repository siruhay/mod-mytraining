<?php

namespace Module\MyTraining\Policies;

use Module\System\Models\SystemUser;
use Module\MyTraining\Models\MyTrainingPresence;
use Illuminate\Auth\Access\Response;

class MyTrainingPresencePolicy
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
        return $user->hasPermission('view-mytraining-presence');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, MyTrainingPresence $myTrainingPresence): bool
    {
        return $user->hasPermission('show-mytraining-presence');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-mytraining-presence');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, MyTrainingPresence $myTrainingPresence): bool
    {
        return $user->hasPermission('update-mytraining-presence');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, MyTrainingPresence $myTrainingPresence): bool
    {
        return $user->hasPermission('delete-mytraining-presence');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, MyTrainingPresence $myTrainingPresence): bool
    {
        return $user->hasPermission('restore-mytraining-presence');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, MyTrainingPresence $myTrainingPresence): bool
    {
        return $user->hasPermission('destroy-mytraining-presence');
    }
}
