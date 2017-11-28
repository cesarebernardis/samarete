<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Models\Servizio;
use Samarete\Repositories\UserRepository;
use Samarete\Repositories\ServizioRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class ServizioPolicy
{
    
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        return $user->isAdmin() ? true : null; 
    }

    /**
     * Determine whether the user can view the servizio.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Servizio  $servizio
     * @return mixed
     */
    public function view(User $user, Servizio $servizio)
    {
        return UserRepository::checkPermesso($user, 'view-servizio') && $this->isOwner($user, $servizio);
    }

    /**
     * Determine whether the user can create servizios.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return UserRepository::checkPermesso($user, 'create-servizio');
    }

    /**
     * Determine whether the user can update the servizio.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Servizio  $servizio
     * @return mixed
     */
    public function update(User $user, Servizio $servizio)
    {
        return UserRepository::checkPermesso($user, 'edit-servizio') && $this->isOwner($user, $servizio);
    }

    /**
     * Determine whether the user can delete the servizio.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Servizio  $servizio
     * @return mixed
     */
    public function delete(User $user, Servizio $servizio)
    {
        return UserRepository::checkPermesso($user, 'delete-servizio') && $this->isOwner($user, $servizio);
    }
    
    private function isOwner(User $user, Servizio $servizio)
    {
        $isowner = false;
        if(ServizioRepository::servizioHasAssociazione($servizio, $user->associazione()))
            $isowner = true;
        return $isowner;
    }
}
