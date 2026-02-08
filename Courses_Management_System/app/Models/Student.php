<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'students';
    protected $guarded = [];//عكس مصفوفة الفلبل هنا نضع اسماء لاعمدة التي لا نريد تعبئتها
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
