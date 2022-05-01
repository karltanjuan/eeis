<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CSSItem extends Model implements Auditable
{   
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'item_name', 
        'item_quantity', 
        'item_type',
        'item_status', 
        'expired_at',
    ];

}
