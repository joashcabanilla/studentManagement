<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\AnnouncementImages;

class Announcement extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "announcements";
    
    public function images(){
        return $this->hasMany(AnnouncementImages::class);
    } 
}
