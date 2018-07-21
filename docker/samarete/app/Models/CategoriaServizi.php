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
class CategoriaServizi extends Model
{
    
    use LogsActivity;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'categoria_servizi';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['nome', 'icona'];
    
    protected static $logOnlyDirty = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servizi()
    {
        return $this->hasMany('Samarete\Models\Servizio', 'categoria_id');
    }

}
