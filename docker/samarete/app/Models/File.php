<?php

namespace Samarete\Models;

use Samarete\Models\Associazione;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property int $proprietario_id
 * @property string $nome
 * @property string $nome_originale
 * @property int $dimensione
 * @property string $estensione
 * @property string $data_caricamento
 * @property User $user
 * @property Progetto[] $progettos
 */
class File extends Model
{
    
    use LogsActivity;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'file';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $timestamps = false;
    
    protected static $logOnlyDirty = true;

    /**
     * @var array
     */
    protected $fillable = ['proprietario_id', 'nome', 'nome_originale', 'dimensione', 'data_caricamento'];
    protected static $logAttributes = ['proprietario_id', 'nome', 'nome_originale', 'dimensione', 'data_caricamento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Samarete\User', 'proprietario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function progetti()
    {
        return $this->belongsToMany('Samarete\Models\Progetto', 'progetto_has_file');
    }
    
    public function getCompleteFilePath()
    {
        return $this->getFilePath().'/'.$this->nome;
    }
    
    public function getFilePath()
    {
        $associazione = Associazione::where('id', $this->proprietario_id)->first();
        return 'associazioni/'.$associazione->datapath;
    }
}
