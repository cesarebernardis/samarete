<?php

namespace Samarete\Models;

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
class FileTmp extends Model
{
    
    use LogsActivity;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'file_tmp';

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
    protected $fillable = ['nome', 'nome_originale', 'dimensione', 'data_caricamento'];
    protected static $logAttributes = ['nome', 'nome_originale', 'dimensione', 'data_caricamento'];

}
