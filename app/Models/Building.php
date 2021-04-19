<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [
        'school_id','building','created_at','updated_at'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

   public static function updateBuilding($data)
   {
   		$bulding = new Building();
   		$bulding->school_id = $data['school_id'];
   		$bulding->building = $data['building'];
   		$bulding->save();
   		return $bulding;
   }
}
