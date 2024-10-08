<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    protected $fillable = [
        'title',
        'type_id',
        'slug',
        'img_path',
        'img_original_name',
        'description',
        'start_date',
        'end_date',
        'status',
        'project_url',
    ];

    protected $casts =  [
        'start_date' => 'datetime:d/m/Y',
        'end_date' => 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y h:m:s',
        'updated_at' => 'datetime:d/m/Y h:m:s',
    ];
}
