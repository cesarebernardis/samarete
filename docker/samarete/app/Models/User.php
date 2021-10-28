<?php

namespace Samarete\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Activitylog\Traits\LogsActivity;

use Samarete\Repositories\RuoloRepository;
use Samarete\Repositories\UserRepository;
use Samarete\Repositories\AssociazioneRepository;

class User extends Authenticatable
{
    
    use LogsActivity;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	// protected $table = "users";
    protected $fillable = ['username', 'password', 'remember_token', 'nome', 'cognome', 'email', 'ultimo_accesso', 'attivo', 'datapath', 'admin', 'created_at', 'updated_at', 'associazione_id'];
    protected static $logAttributes = ['username', 'remember_token', 'nome', 'cognome', 'email', 'attivo', 'admin', 'associazione_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected static $logOnlyDirty = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany('Samarete\Models\File', 'proprietario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ruoli()
    {
        return $this->belongsToMany('Samarete\Models\Ruolo', 'user_has_ruolo');
    }
    
    public function isAdmin()
    {
        return $this->admin == 1;
    }
    
    public function associazione()
    {
        return AssociazioneRepository::getById($this->associazione_id);
    }
}
