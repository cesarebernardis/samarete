<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

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
    public function getGiorni($from=null, $to=null)
    {
        $params = ['id' => $this->id];
        $where = "servizio_id = :id";
        $giorni_calc = array();
        $giorni = DB::select("SELECT giorno, da, a, descrizione FROM servizio_has_giorno WHERE $where ORDER BY giorno, da, a ASC", $params);
        $from = new Carbon($from);
        $to = new Carbon($to);
        $datafine = new Carbon($this->data_fine);
        foreach($giorni as $giorno){
            $day = new Carbon($giorno->giorno);
            while($day->lte($datafine)){
                $cond_from = $cond_to = false;
                if(empty($from) || $from->lte($day)){
                    $cond_from = true;
                }if(empty($to) || $to->gte($day)){
                    $cond_to = true;
                }
                if($cond_from && $cond_to){
                    $new_giorno = clone($giorno);
                    $new_giorno->giorno = $day->toDateString();
                    $giorni_calc[] = $new_giorno;
                }
                $day = $this->getNextPeriodicalDate($day);
            }
        }
        return $giorni_calc;
    }
    
    public function getNextPeriodicalDate($day)
    {
        $newday = clone($day);
        switch($this->periodicita){
            case 'Giornaliera': $newday->addDay(); break;
            case 'Settimanale': $newday->addWeek(); break;
            case 'Quattordicinale': $newday->addWeek(2); break;
            case 'Mensile': $newday->addMonth(); break;
            case 'Bimestrale': $newday->addMonth(2); break;
            default: $newday = new Carbon($this->data_fine);
                   $newday->addDay();
        }
        return $newday;
    }
    
    public function save(array $options = [])
    {
        $this->descrizione = \Purifier::clean($this->descrizione);
        unset($this->logo_base64);
        parent::save($options);
    }
}
