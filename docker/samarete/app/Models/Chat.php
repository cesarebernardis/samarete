<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property string $data_creazione
 * @property Associazione[] $associaziones
 * @property Messaggio[] $messaggios
 * @property Progetto[] $progettos
 */
class Chat extends Model
{
    
    use LogsActivity;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'chat';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['data_creazione'];
    
    protected static $logOnlyDirty = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function associazioni()
    {
        return $this->belongsToMany('Samarete\Associazione', 'chat_has_associazione');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messaggi()
    {
        return $this->hasMany('Samarete\Messaggio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function progetti()
    {
        return $this->hasMany('Samarete\Progetto');
    }
}
