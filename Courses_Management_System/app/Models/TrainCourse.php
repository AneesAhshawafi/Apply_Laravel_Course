<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class TrainCourse extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'training_courses';
    protected $guarded = [];
    public function students():BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'trn_crs_enrolments', 'train_course_id', 'student_id')->withPivot('enrolment_date');
    }
}
