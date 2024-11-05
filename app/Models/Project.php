<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover',
        'client',
        'sector',
        'published',
        'tyep_id',
    ];

    public function type(){
        return $table->belongsTo(Type::class);
    }
}
