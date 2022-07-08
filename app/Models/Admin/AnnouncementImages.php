<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementImages extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "announcement_images";
}
