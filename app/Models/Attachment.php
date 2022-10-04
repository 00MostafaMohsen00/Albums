<?php

namespace App\Models;
use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="attachments";


    public function Album()
    {
        return $this->belongsTo(Album::class);
    }

}
