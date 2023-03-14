<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDocument extends Model
{
    use HasFactory;
    //use SoftDeletes;
    protected $fillable = [
        'path',
        'expired_date',
        'status',
        'user_id',
        'document_id',
    ];

    protected $casts =[
        'path'  => 'array',
    ];

    //document and user relation
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    //document and userDocument relation
    public function document()
    {
        return $this->belongsTo(Document::class,'document_id','id');
    }
}
