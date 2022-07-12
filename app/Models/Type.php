<?php

namespace App\Models;

use App\Traits\HasTracking;
use App\Traits\HasTrackingRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory, HasTracking, HasTrackingRelations;

    protected $fillable = [
        'name',
        'color',
    ];

    //########################################### Relations ################################################
    public function vacations()
    {
        return $this->hasMany(Vacation::class);
    }
}
