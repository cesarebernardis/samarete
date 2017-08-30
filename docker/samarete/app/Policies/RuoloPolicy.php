<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Models\Ruolo;
use Samarete\Repositories\UserRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class RuoloPolicy
{
    
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        return $user->isAdmin() ? true : null; 
    }

    /**
     * Determine whether the user can view the ruolo.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Ruolo  $ruolo
     * @return mixed
     */
    public function view(User $user, Ruolo $ruolo)
    {
        return UserRepository::checkPermesso($user, 'view-ruolo');
    }

    /**
     * Determine whether the user can create ruolos.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return UserRepository::checkPermesso($user, 'create-ruolo');
    }

    /**
     * Determine whether the user can update the ruolo.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Ruolo  $ruolo
     * @return mixed
     */
    public function update(User $user, Ruolo $ruolo)
    {
        return UserRepository::checkPermesso($user, 'edit-ruolo');
    }

    /**
     * Determine whether the user can delete the ruolo.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Ruolo  $ruolo
     * @return mixed
     */
    public function delete(User $user, Ruolo $ruolo)
    {
        return UserRepository::checkPermesso($user, 'delete-ruolo');
    }
    
    public function addPermesso(User $user)
    {
        return UserRepository::checkPermesso($user, 'add-permesso');
    }
    
    public function revokePermesso(User $user)
    {
        return UserRepository::checkPermesso($user, 'revoke-permesso');
    }
    
}
