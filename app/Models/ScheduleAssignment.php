<?php
namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class ScheduleAssignment extends Model { protected $fillable = ['assignment_date','security_officer_id','location','status']; protected function casts(): array { return ['assignment_date'=>'date']; } public function setAssignmentDateAttribute($value): void { $this->attributes['assignment_date'] = Carbon::parse($value)->toDateString(); } }
