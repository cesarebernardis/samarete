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
        return $this->belongsToMany('Samarete\Models\Associazione', 'chat_has_associazione')->withPivot('last_access');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messaggi()
    {
        return $this->hasMany('Samarete\Models\Messaggio');
    }
    
    public function ultimo_messaggio()
    {
        return $this->messaggi()->orderBy('data', 'DESC')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function progetto()
    {
        return $this->hasOne('Samarete\Models\Progetto');
    }
    
    public function partecipanti()
    {
        return implode(', ', array_map(function($x){ return $x['acronimo'] ? $x['acronimo'] : $x['nome']; }, $this->associazioni->toArray()));
    }
}
