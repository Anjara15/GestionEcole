<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table = 'schedules'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['event_name', 'start_time', 'end_time', 'date'];
    
    public function setStartTime(string $time)
    {
        $this->attributes['start_time'] = date('H:i', strtotime($time));
    }

    public function getStartTime(string $time = null)
    {
        return date('H:i', strtotime($time ?? $this->attributes['start_time']));
    }

    public function setEndTime(string $time)
    {
        $this->attributes['end_time'] = date('H:i', strtotime($time));
    }

    public function getEndTime(string $time = null)
    {
        return date('H:i', strtotime($time ?? $this->attributes['end_time']));
    }
}