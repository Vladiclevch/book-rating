<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookFolderLink extends Model
{
    use HasFactory;

    protected $table = 'book_folder_links';

    protected $fillable = ['book_folder_id', 'book_id'];
}
