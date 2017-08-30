<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Models\Progetto;
use Samarete\Repositories\UserRepository;
use Samarete\Repositories\ProgettoRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProgettoPolicy
{
    
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        return $user->isAdmin() ? true : null; 
    }

    /**
     * Determine whether the user can view the progetto.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Progetto  $progetto
     * @return mixed
     */
    public function view(User $user, Progetto $progetto)
    {
        return UserRepository::checkPermesso($user, 'view-progetto') && $this->isOwner($user, $progetto);
    }

    /**
     * Determine whether the user can create progettos.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return UserRepository::checkPermesso($user, 'create-progetto');
    }

    /**
     * Determine whether the user can update the progetto.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Progetto  $progetto
     * @return mixed
     */
    public function update(User $user, Progetto $progetto)
    {
        return UserRepository::checkPermesso($user, 'edit-progetto') && $this->isOwner($user, $progetto);
    }

    /**
     * Determine whether the user can delete the progetto.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\Progetto  $progetto
     * @return mixed
     */
    public function delete(User $user, Progetto $progetto)
    {
        return UserRepository::checkPermesso($user, 'delete-progetto') && $this->isOwner($user, $progetto);
    }
    
    private function isOwner(User $user, Progetto $progetto)
    {
        $isowner = false;
        foreach($user->associazioni() as $associazione)
            if(ProgettoRepository::progettoHasAssociazione($progetto, $associazione))
                $isowner = true;
        return $isowner;
    }
}
