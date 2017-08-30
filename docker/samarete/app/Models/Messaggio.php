<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

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
    public function associazione()
    {
        return $this->belongsTo('Samarete\Associazione', 'autore_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chat()
    {
        return $this->belongsTo('Samarete\Chat');
    }
}
