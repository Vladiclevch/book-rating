<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'img', 'grade', 'user_id'];

    public static array $grades = ['Read later', 'Excellent', 'Good', 'Average', 'Bad', 'Disgusting'];

    public function setGradeAttribute($value)
    {
        if(!in_array($value, self::$grades)) {
            throw new \InvalidArgumentException("Invalid grade value");
        }

        $this->attributes['grade'] = $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function folders()
    {
        return $this->belongsToMany(BookFolder::class, 'book_folder_links');
    }
}
