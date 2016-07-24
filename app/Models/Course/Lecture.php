<?php

namespace App\Models\Course;

use App\Models\User\Student;
use App\Models\User\Teacher;
use App\Scopes\Local\NextDaysTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $appends = [
        'human_date_time',
        'human_time',
        'mode'
    ];

    protected $with = ['timeSlot', 'student'];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public function getHumanDateTimeAttribute()
    {
        $timeSlot = $this->timeSlot;
        return humanDate($this->date, true) . $timeSlot->day_part . ' ' . $timeSlot->range;
    }

    public function getHumanTimeAttribute()
    {
        $timeSlot = $this->timeSlot;
        return humanDayOfWeek(Carbon::parse($this->date)->dayOfWeek).$timeSlot->day_part . ' ' . $timeSlot->range;
    }

    public function getModeAttribute()
    {
        if ($this->single) {
            return '一对一';
        }

        return '一对多';
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopeOrderByLatest($query)
    {
        return $query->orderBy('start_at', 'desc');
    }

    public function scopeFollowingWeek($query)
    {
        return $this->scopeFollowingDays($query, 7);
    }

    public function scopeFollowingDays($query, $days)
    {
        return $query->where([
            ['date', '>=' , Carbon::now()->tomorrow()->toDateString()],
            ['date', '<', Carbon::now()->tomorrow()->addDays($days)->toDateString()]
        ]);
    }
}
