<?php

namespace App\Models;

use App\Traits\HasTracking;
use App\Traits\HasTrackingRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory, HasTracking, HasTrackingRelations;

    protected $fillable = [
        'start_date',
        'end_date',
        'type_id',
        'user_id'
    ];

    //########################################### Relations ################################################
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
