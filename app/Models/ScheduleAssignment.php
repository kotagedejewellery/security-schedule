<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ScheduleAssignment extends Model { protected $fillable = ['assignment_date','security_officer_id','location','status']; protected function casts(): array { return ['assignment_date'=>'date']; } }
