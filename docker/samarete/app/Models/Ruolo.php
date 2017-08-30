<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property string $nome
 * @property Permesso[] $permessos
 * @property User[] $users
 */
class Ruolo extends Model
{
    
    use LogsActivity;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ruolo';
    
    /*
     * Avoid created_at and updated_at
     */
    public $timestamps = false;
    
    protected static $logOnlyDirty = true;

    /**
     * @var array
     */
    protected $fillable = ['nome', 'data_creazione', 'attivo'];
    protected static $logAttributes = ['nome', 'data_creazione', 'attivo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permessi()
    {
        return $this->belongsToMany('Samarete\Permesso', 'ruolo_has_permesso');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Samarete\User', 'user_has_ruolo');
    }
}
