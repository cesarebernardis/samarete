<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
/**
 * @property int $id
 * @property string $nome
 * @property string $oggetto
 * @property string $descrizione
 * @property string $data_inizio
 * @property string $data_fine
 * @property boolean $logo
 * @property string $data_creazione
 * @property AssociazioneHasServizio[] $associazioneHasServizios
 * @property ServizioHasGiorno[] $servizioHasGiornos
 */
class Servizio extends Model
{
    
    use LogsActivity;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'servizio';
    public $timestamps = false;
    
    protected static $logOnlyDirty = true;

    /**
     * @var array
     */
    protected $fillable = ['nome', 'oggetto', 'descrizione', 'data_inizio', 'data_fine', 'logo', 'data_creazione'];
    protected static $logAttributes = ['nome', 'oggetto', 'descrizione', 'data_inizio', 'data_fine', 'logo', 'data_creazione'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function associazioneHasServizi()
    {
        return $this->hasMany('Samarete\AssociazioneHasServizio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servizioHasGiorni()
    {
        return $this->hasMany('Samarete\ServizioHasGiorno');
    }
}
