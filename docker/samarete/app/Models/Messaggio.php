<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use Carbon\Carbon;

/**
 * @property int $id
 * @property int $autore_id
 * @property int $chat_id
 * @property string $data
 * @property string $testo
 * @property Associazione $associazione
 * @property Chat $chat
 */
class Messaggio extends Model
{
    
    use LogsActivity;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'messaggio';
    
    public $timestamps = false;
    
    protected static $logOnlyDirty = true;

    /**
     * @var array
     */
    protected $fillable = ['autore_id', 'chat_id', 'data', 'testo'];
    protected static $logAttributes = ['autore_id', 'chat_id', 'data', 'testo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autore()
    {
        return $this->belongsTo('Samarete\Models\Associazione', 'autore_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chat()
    {
        return $this->belongsTo('Samarete\Models\Chat');
    }
    
    public function getDataAttribute($value)
    {
        if(is_object($value))
            return new Carbon($value->format(DATE_ISO8601));
        else
            return Carbon::parse($value);
    }
    
    public function save(array $options = [])
    {
        $this->testo = strip_tags($this->testo);
        parent::save($options);
    }
    
}
