<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Models\Permesso;
use Samarete\Repositories\UserRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class PermessoPolicy
{
    
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        return $user->isAdmin() ? true : null; 
    }

    /**
     * Determine whether the user can view the permesso.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Permesso  $permesso
     * @return mixed
     */
    public function view(User $user, Permesso $permesso)
    {
        return UserRepository::checkPermesso($user, 'view-permesso');
    }

    /**
     * Determine whether the user can create permessos.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return UserRepository::checkPermesso($user, 'create-permesso');
    }

    /**
     * Determine whether the user can update the permesso.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Permesso  $permesso
     * @return mixed
     */
    public function update(User $user, Permesso $permesso)
    {
        return UserRepository::checkPermesso($user, 'edit-permesso');
    }

    /**
     * Determine whether the user can delete the permesso.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Permesso  $permesso
     * @return mixed
     */
    public function delete(User $user, Permesso $permesso)
    {
        return UserRepository::checkPermesso($user, 'delete-permesso');
    }
    
}
