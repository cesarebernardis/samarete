<?php

namespace Samarete\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property string $nome
 * @property Ruolo[] $ruolos
 */
class Permesso extends Model
{
    
    use LogsActivity;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'permesso';
    
    public $timestamps = false;
    
    protected static $logOnlyDirty = true;

    /**
     * @var array
     */
    protected $fillable = ['nome'];
    protected static $logAttributes = ['nome'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ruoli()
    {
        return $this->belongsToMany('Samarete\Models\Ruolo', 'ruolo_has_permesso');
    }
}
