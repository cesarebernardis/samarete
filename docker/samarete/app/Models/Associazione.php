<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;

use Samarete\Models\Richiesta;
use Samarete\Repositories\RichiestaRepository;

/**
 * @property int $id
 * @property int $gestore_id
 * @property string $nome
 * @property string $acronimo
 * @property string $indirizzo
 * @property string $telefono_1
 * @property string $telefono_2
 * @property string $referente_nome
 * @property string $referente_indirizzo
 * @property string $referente_telefono_1
 * @property string $referente_telefono_2
 * @property string $email
 * @property string $sito_web
 * @property string $descrizione
 * @property boolean $logo
 * @property string $data_creazione
 * @property User $user
 * @property AssociazioneHasEvento[] $associazioneHasEventos
 * @property AssociazioneHasProgetto[] $associazioneHasProgettos
 * @property AssociazioneHasServizio[] $associazioneHasServizios
 * @property Chat[] $chats
 * @property Messaggio[] $messaggios
 */
class Associazione extends Model
{
    
    use LogsActivity;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'associazione';
    
    public $timestamps = false;
    
    protected static $logOnlyDirty = true;

    /**
     * @var array
     */
    protected $fillable = ['gestore_id', 'nome', 'acronimo', 'indirizzo', 'telefono_1', 'telefono_2', 'referente_nome', 'referente_indirizzo', 'referente_telefono_1', 'referente_telefono_2', 'email', 'sito_web', 'descrizione', 'logo', 'data_creazione'];
    protected static $logAttributes = ['gestore_id', 'nome', 'acronimo', 'indirizzo', 'telefono_1', 'telefono_2', 'referente_nome', 'referente_indirizzo', 'referente_telefono_1', 'referente_telefono_2', 'email', 'sito_web', 'descrizione', 'logo', 'data_creazione'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Samarete\Models\User', 'gestore_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function chats()
    {
        return $this->belongsToMany('Samarete\Models\Chat', 'chat_has_associazione');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messaggi()
    {
        return $this->hasMany('Samarete\Models\Messaggio', 'autore_id');
    }

    public function servizi()
    {
        return $this->belongsToMany('Samarete\Models\Servizio', 'associazione_has_servizio');
    }

    public function eventi()
    {
        return $this->belongsToMany('Samarete\Models\Evento', 'associazione_has_evento');
    }

    public function progetti()
    {
        return $this->belongsToMany('Samarete\Models\Progetto', 'associazione_has_progetto');
    }

    public function richieste()
    {
        $richieste = RichiestaRepository::getGlobali();
        foreach(DB::select('SELECT * FROM richiesta_has_associazione WHERE associazione_id = ?', [$this->id]) as $rid){
            $r = RichiestaRepository::getById($rid->richiesta_id);
            if($r) $richieste[] = $r;
        }
        
        return $richieste;
    }
}
