<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    //mutator
    //not flexible for transferring data to another domain for example.
    // public function setPostImageAttribute($value){
        
    //     $this->attributes['post_image'] = asset($value);
    // } 
    
    //assessor
    public function getPostImageAttribute($value){
    
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
          return $value;
        } 
     
        return asset('storage/' . $value);
      }
      
      
    
}
