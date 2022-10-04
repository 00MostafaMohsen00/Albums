<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attachment;
class Album extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="albums";

    //album and photo many to many relation ship

    public function attachments()
    {
        return $this->hasMany(Attachment::class,"album_id","id");
    }
}
