<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Models\Associazione;
use Samarete\Repositories\UserRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class AssociazionePolicy
{
    
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        return $user->isAdmin() ? true : null; 
    }

    /**
     * Determine whether the user can view the associazione.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Associazione  $associazione
     * @return mixed
     */
    public function view(User $user, Associazione $associazione)
    {
        return true;
    }

    /**
     * Determine whether the user can create associaziones.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return UserRepository::checkPermesso($user, 'create-associazione');
    }

    /**
     * Determine whether the user can update the associazione.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Associazione  $associazione
     * @return mixed
     */
    public function update(User $user, Associazione $associazione)
    {
        return UserRepository::checkPermesso($user, 'edit-associazione') && $this->isOwner($user, $associazione);
    }

    /**
     * Determine whether the user can delete the associazione.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Associazione  $associazione
     * @return mixed
     */
    public function delete(User $user, Associazione $associazione)
    {
        return UserRepository::checkPermesso($user, 'delete-associazione') && $this->isOwner($user, $associazione);
    }
    
    private function isOwner(User $user, Associazione $associazione)
    {
        return $user['associazione_id'] == $associazione['id'];
    }
}
