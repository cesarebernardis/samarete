<?php

namespace Samarete\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Activitylog\Traits\LogsActivity;

use Samarete\Repositories\RuoloRepository;
use Samarete\Repositories\UserRepository;

class User extends Authenticatable
{
    
    use LogsActivity;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password', 'remember_token', 'nome', 'cognome', 'email', 'ultimo_accesso', 'attivo', 'created_at', 'updated_at'];
    protected static $logAttributes = ['username', 'remember_token', 'nome', 'cognome', 'email', 'ultimo_accesso', 'attivo', 'created_at', 'updated_at'];

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
    public function associazioni()
    {
        return $this->hasMany('Samarete\Models\Associazione', 'gestore_id');
    }

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
        return $this->belongsToMany('Samarete\Ruolo', 'user_has_ruolo');
    }
    
    public function isAdmin()
    {
        return UserRepository::hasRuolo($this, RuoloRepository::getAdmin());
    }
    
    public function associazione()
    {
        return $this->associazioni->first();
    }
}
