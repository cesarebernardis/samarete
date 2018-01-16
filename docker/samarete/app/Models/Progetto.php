<?php

namespace Samarete\Models;

use Samarete\Models\File;

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
        return $this->belongsTo('Samarete\Models\Chat');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function associazioni()
    {
        return $this->belongsToMany('Samarete\Models\Associazione', 'associazione_has_progetto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Samarete\Models\File', 'progetto_has_file');
    }
    
    public function save(array $options = [])
    {
        $this->descrizione = \Purifier::clean($this->descrizione);
        unset($this->logo_base64);
        parent::save($options);
    }
    
    public function isPublic(File $file)
    {
        if(empty($file)) return false;
        $this->files()->where('file_id', '=', $file->id)->first()->public > 0;
    }
}
