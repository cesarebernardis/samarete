<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use Samarete\Repositories\AssociazioneRepository;

class Richiesta extends Model
{
    
    use LogsActivity;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'richiesta';
    
    public $timestamps = false;
    
    protected static $logOnlyDirty = true;

    /**
     * @var array
     */
    protected $fillable = ['contatto_1', 'contatto_2', 'oggetto', 'testo', 'globale', 'data_creazione'];
    protected static $logAttributes = ['contatto_1', 'contatto_2', 'oggetto', 'testo', 'globale'];
    

    public function associazioni()
    {
        if($this->globale){
            return AssociazioneRepository::getAll();
        }
        return $this->belongsToMany('Samarete\Models\Associazione', 'richiesta_has_associazione');
    }
}
