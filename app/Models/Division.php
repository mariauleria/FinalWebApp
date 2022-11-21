<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class);
    }

    public function assets(){
        return $this->hasMany(Asset::class);
    }

    public function DeletedAssets(){
        return $this->hasMany(DeletedAsset::class);
    }
}
