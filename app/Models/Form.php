<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['form_title','status'];

    public function formelements()
    {
        return $this->hasMany(FormElements::class,'form_id','id');
    }
}
