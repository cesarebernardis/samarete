<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Models\Richiesta;
use Samarete\Repositories\UserRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class RichiestaPolicy
{
    
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        return $user->isAdmin() ? true : null;
    }

    /**
     * Determine whether the user can view the richiesta.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Richiesta  $richiesta
     * @return mixed
     */
    public function viewall(User $user)
    {
        return UserRepository::checkPermesso($user, 'view-richiesta');
    }

    /**
     * Determine whether the user can view the richiesta.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Richiesta  $richiesta
     * @return mixed
     */
    public function view(User $user, Richiesta $richiesta)
    {
        return UserRepository::checkPermesso($user, 'view-richiesta') && $this->isOwner($user, $richiesta);
    }

    /**
     * Determine whether the user can create richiestas.
     *
     * @param  \Samarete\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the richiesta.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Richiesta  $richiesta
     * @return mixed
     */
    public function update(User $user, Richiesta $richiesta)
    {
        return UserRepository::checkPermesso($user, 'edit-richiesta') && $this->isOwner($user, $richiesta);
    }

    /**
     * Determine whether the user can delete the richiesta.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Richiesta  $richiesta
     * @return mixed
     */
    public function delete(User $user, Richiesta $richiesta)
    {
        return UserRepository::checkPermesso($user, 'delete-richiesta') && $this->isOwner($user, $richiesta);
    }
    
    private function isOwner(User $user, Richiesta $richiesta)
    {
        $isowner = false;
        foreach($user->associazioni() as $associazione)
            if(RichiestaRepository::richiestaHasAssociazione($richiesta, $associazione))
                $isowner = true;
        return $isowner;
    }
}
