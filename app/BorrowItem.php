<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BorrowItem extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'user_id', 
        'item_id',
        'status',
        'quantity',
        'category',
        'is_returned'
    ];
}
