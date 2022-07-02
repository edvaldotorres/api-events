<?php

namespace Modules\Event\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'event_time',
        'email_notification',
        'sent',
        'sent_time',
    ];

    public function setEventTimeAttribute($value)
    {
        $this->attributes['event_time'] = Carbon::createFromFormat('d/m/Y H:i', $value)->format('Y-m-d H:i:s');
    }

    public function getEventTimeAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i');
    }

    public function scopeFilterEventsDay($query, $day)
    {
        return $query->where(
            DB::raw('DATE(event_time)'),
            Carbon::createFromFormat('d/m/Y', $day)
                ->format('Y-m-d')
        );
    }
}
