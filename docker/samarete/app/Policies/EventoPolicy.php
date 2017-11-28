<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Models\Evento;
use Samarete\Repositories\UserRepository;
use Samarete\Repositories\EventoRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class EventoPolicy
{
    
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        return $user->isAdmin() ? true : null;
    }

    /**
     * Determine whether the user can view the evento.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Evento  $evento
     * @return mixed
     */
    public function view(User $user, Evento $evento)
    {
        return true;
    }

    /**
     * Determine whether the user can create eventos.
     *
     * @param  \Samarete\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return UserRepository::checkPermesso($user, 'create-evento');
    }

    /**
     * Determine whether the user can update the evento.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Evento  $evento
     * @return mixed
     */
    public function update(User $user, Evento $evento)
    {
        return UserRepository::checkPermesso($user, 'edit-evento') && $this->isOwner($user, $evento);
    }

    /**
     * Determine whether the user can delete the evento.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Evento  $evento
     * @return mixed
     */
    public function delete(User $user, Evento $evento)
    {
        return UserRepository::checkPermesso($user, 'delete-evento') && $this->isOwner($user, $evento);
    }
    
    private function isOwner(User $user, Evento $evento)
    {
        $isowner = false;
        if(EventoRepository::eventoHasAssociazione($evento, $user->associazione()))
            $isowner = true;
        return $isowner;
    }
}
