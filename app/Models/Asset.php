<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'brand',
        'assigned_location',
        'current_location',
        'asset_category_id',
        'division_id'
    ];

    public function AssetCategory(){
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function division(){
        return $this->belongsTo(Division::class, 'division_id');
    }
}
