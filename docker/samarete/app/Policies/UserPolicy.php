<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Repositories\UserRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        return $user->isAdmin() ? true : null; 
    }

    /**
     * Determine whether the user can view the user_dest.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\User  $user_dest
     * @return mixed
     */
    public function view(User $user, User $user_dest)
    {
        return UserRepository::checkPermesso($user, 'view-user') && $this->isOwner($user, $user_dest);
    }

    /**
     * Determine whether the user can create user_dests.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the user_dest.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\User  $user_dest
     * @return mixed
     */
    public function update(User $user, User $user_dest)
    {
        return UserRepository::checkPermesso($user, 'edit-user') && $this->isOwner($user, $user_dest);
    }

    /**
     * Determine whether the user can delete the user_dest.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\User  $user_dest
     * @return mixed
     */
    public function delete(User $user, User $user_dest)
    {
        return UserRepository::checkPermesso($user, 'delete-user') && $this->isOwner($user, $user_dest);
    }
    
    public function addRuolo(User $user)
    {
        return UserRepository::checkPermesso($user, 'add-ruolo');
    }
    
    public function revokeRuolo(User $user)
    {
        return UserRepository::checkPermesso($user, 'revoke-ruolo');
    }
    
    private function isOwner(User $user, User $user_dest)
    {
        return $user['id'] == $user_dest['id'];
    }
}
