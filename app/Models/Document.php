<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
    ];
    //userDocument and document relation
    public function userDocuments()
    {
        return $this->hasMany(UserDocument::class,'document_id','id');
    }
}
