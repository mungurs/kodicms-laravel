<?php
namespace KodiCMS\Users\Observers;

/**
 * Class RoleObserver
 * @package KodiCMS\Users\Observers
 */
class RoleObserver
{
    /**
     * @param \KodiCMS\Users\Model\UserRole $role
     *
     * @return bool
     */
    public function deleted($role)
    {
        $role->users()->detach();
        $role->permissions()->delete();
    }

}