<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Models\Chat;
use Samarete\Repositories\UserRepository;
use Samarete\Repositories\ChatRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
{
    
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        return $user->isAdmin() ? true : null;
    }

    /**
     * Determine whether the user can view the chat.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Chat  $chat
     * @return mixed
     */
    public function view(User $user, Chat $chat)
    {
        return UserRepository::checkPermesso($user, 'view-chat') && $this->isOwner($user, $chat);
    }

    /**
     * Determine whether the user can create chats.
     *
     * @param  \Samarete\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return UserRepository::checkPermesso($user, 'create-chat');
    }

    /**
     * Determine whether the user can update the chat.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Chat  $chat
     * @return mixed
     */
    public function update(User $user, Chat $chat)
    {
        return UserRepository::checkPermesso($user, 'edit-chat') && $this->isOwner($user, $chat);
    }

    /**
     * Determine whether the user can delete the chat.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Chat  $chat
     * @return mixed
     */
    public function delete(User $user, Chat $chat)
    {
        return UserRepository::checkPermesso($user, 'delete-chat') && $this->isOwner($user, $chat);
    }

    /**
     * Determine whether the user can send a message in the chat.
     *
     * @param  \Samarete\Models\User  $user
     * @param  \Samarete\Models\Chat  $chat
     * @return mixed
     */
    public function sendMessage(User $user, Chat $chat)
    {
        return UserRepository::checkPermesso($user, 'send-chat-message') && $this->isOwner($user, $chat);
    }
    
    private function isOwner(User $user, Chat $chat)
    {
        $isowner = false;
        if(ChatRepository::chatHasAssociazione($chat, $user->associazione()))
            $isowner = true;
        return $isowner;
    }
}
