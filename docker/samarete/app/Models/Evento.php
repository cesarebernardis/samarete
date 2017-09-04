<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

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
 * @property AssociazioneHasEvento[] $associazioneHasEventos
 * @property EventoHasGiorno[] $eventoHasGiornos
 */
class Evento extends Model
{
    use LogsActivity;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'evento';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['nome', 'oggetto', 'descrizione', 'logo', 'data_creazione'];
    protected static $logAttributes  = ['nome', 'oggetto', 'descrizione', 'logo', 'data_creazione'];
    protected static $logOnlyDirty = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function associazioni()
    {
        return $this->belongsToMany('Samarete\Models\Associazione', 'associazione_has_evento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventoHasGiorni()
    {
        return DB::select("SELECT giorno, da, a, descrizione FROM evento_has_giorno WHERE evento_id = ? ORDER BY giorno, da, a ASC", [$this->id]);
    }
}
