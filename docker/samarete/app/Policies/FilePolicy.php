<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Models\File;
use Samarete\Repositories\UserRepository;
use Samarete\Repositories\FileRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        return $user->isAdmin() ? true : null; 
    }

    /**
     * Determine whether the user can view the file.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\File  $file
     * @return mixed
     */
    public function view(User $user, File $file)
    {
        return UserRepository::checkPermesso($user, 'view-file') && $this->isOwner($user, $file);
    }

    /**
     * Determine whether the user can create files.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function upload(User $user)
    {
        return UserRepository::checkPermesso($user, 'upload-file');
    }

    /**
     * Determine whether the user can create files.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function publish(User $user)
    {
        return UserRepository::checkPermesso($user, 'publish-file');
    }

    /**
     * Determine whether the user can update the file.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\File  $file
     * @return mixed
     */
    public function download(User $user, File $file)
    {
        return UserRepository::checkPermesso($user, 'download-file') && $this->isOwner($user, $file);
    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\File  $file
     * @return mixed
     */
    public function delete(User $user, File $file)
    {
        return UserRepository::checkPermesso($user, 'delete-file') && $this->isOwner($user, $file);
    }
    
    private function isOwner(User $user, File $file)
    {
        $isowner = false;
        foreach($user->associazioni() as $associazione)
            $isowner = $isowner || ($file['proprietario_id'] == $associazione['id']);
        return $isowner;
    }
}
