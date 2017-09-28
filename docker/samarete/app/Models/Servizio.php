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

    public function associazioni()
    {
        return $this->belongsToMany('Samarete\Models\Associazione', 'associazione_has_servizio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servizioHasGiorni()
    {
        return DB::select("SELECT giorno, da, a, descrizione FROM servizio_has_giorno WHERE servizio_id = ? ORDER BY giorno, da, a ASC", [$this->id]);
    }
    
    public function save(array $options = [])
    {
        $this->descrizione = \Purifier::clean($this->descrizione);
        unset($this->logo_base64);
        parent::save($options);
    }
}
