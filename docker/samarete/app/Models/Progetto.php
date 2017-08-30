<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property int $chat_id
 * @property string $nome
 * @property string $oggetto
 * @property string $descrizione
 * @property boolean $logo
 * @property string $data_creazione
 * @property Chat $chat
 * @property AssociazioneHasProgetto[] $associazioneHasProgettos
 * @property File[] $files
 */
class Progetto extends Model
{
    
    use LogsActivity;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'progetto';
    public $timestamps = false;
    
    protected static $logOnlyDirty = true;

    /**
     * @var array
     */
    protected $fillable = ['chat_id', 'nome', 'oggetto', 'descrizione', 'logo', 'data_creazione'];
    protected static $logAttributes = ['chat_id', 'nome', 'oggetto', 'descrizione', 'logo', 'data_creazione'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chat()
    {
        return $this->belongsTo('Samarete\Chat');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function associazioneHasProgetti()
    {
        return $this->hasMany('Samarete\AssociazioneHasProgetto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Samarete\File', 'progetto_has_file');
    }
}
