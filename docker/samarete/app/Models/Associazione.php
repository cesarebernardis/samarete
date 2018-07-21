<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;

use Samarete\Models\Richiesta;
use Samarete\Models\CategoriaServizi;
use Samarete\Repositories\RichiestaRepository;
use Samarete\Repositories\ChatRepository;

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
        return $this->belongsToMany('Samarete\Models\Chat', 'chat_has_associazione')->withPivot('last_access');
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
    
    public function files()
    {
        return $this->belongsToMany('Samarete\Models\File', 'associazione_has_file')->withPivot('public');
    }
    
    public function lastChat()
    {
        $chats = DB::select('SELECT c.* FROM chat c JOIN messaggio m ON m.chat_id = c.id WHERE autore_id = ? AND NOT EXISTS(SELECT * FROM progetto p WHERE p.chat_id = c.id) ORDER BY m.data DESC', [$this->id]);
        $chat = empty($chats) ? null : reset($chats);
        return empty($chat) ? null : ChatRepository::getById($chat->id);
    }
    
    public function categorie_servizi()
    {
        $catids = DB::select('SELECT DISTINCT categoria_id FROM servizio s JOIN associazione_has_servizio ahs ON s.id = ahs.servizio_id WHERE ahs.associazione_id = ? AND categoria_id IS NOT NULL', [$this->id]);
        $cats = array();
        foreach($catids as $catid){
            $cats[] = CategoriaServizi::where('id', $catid->categoria_id)->first();
        }
        return $cats;
    }
    
    public function save(array $options = [])
    {
        $this->descrizione = \Purifier::clean($this->descrizione);
        $this->descrizione = trim($this->descrizione);
        $this->oggetto = trim(strip_tags($this->oggetto));
        unset($this->logo_base64);
        if(empty($this->telefono_1) && !empty($this->telefono_2)) $this->telefono_1 = $this->telefono_2;
        if(empty($this->referente_telefono_1) && !empty($this->referente_telefono_2)) $this->referente_telefono_1 = $this->referente_telefono_2;
        parent::save($options);
    }
    
    public function isPublic(File $file)
    {
        if(empty($file)) return false;
        return $this->files()->where('file_id', '=', $file->id)->first()->pivot->public > 0;
    }
}
