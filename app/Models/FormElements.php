<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormElements extends Model
{
    use HasFactory;

    protected $fillable = ['form_id','label_name','form_element_name','status'];

}
