<?php

namespace Samarete\Policies;

use Samarete\Models\User;
use Samarete\Models\FileTmp;
use Samarete\Repositories\UserRepository;
use Samarete\Repositories\FileTmpRepository;

use Illuminate\Auth\Access\HandlesAuthorization;

class FileTmpPolicy
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
     * @param  \Samarete\FileTmp  $file
     * @return mixed
     */
    public function view(User $user, FileTmp $file)
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
     * Determine whether the user can update the file.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\FileTmp  $file
     * @return mixed
     */
    public function download(User $user, FileTmp $file)
    {
        return UserRepository::checkPermesso($user, 'download-file') && $this->isOwner($user, $file);
    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\Models\User  $user
     * @param  \Samarete\FileTmp  $file
     * @return mixed
     */
    public function delete(User $user, FileTmp $file)
    {
        return UserRepository::checkPermesso($user, 'delete-file') && $this->isOwner($user, $file);
    }
    
    private function isOwner(User $user, FileTmp $file)
    {
        return $file['uploader_id'] == $user['id'];
    }
}
