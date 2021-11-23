<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'label',
        'description'
    ];

    public function setDescriptionAttribute($value)
    {
        if (is_array($value)){
            $this->attributes['description'] = json_encode($value);
        }else{
            $this->attributes['description'] = $value;
        }
    }
    public function isJson($string){
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function getDescriptionAttribute($value){
        if ($this->isJson($value)){
            return json_decode($value, true);
        }

        return $value;
    }
}
