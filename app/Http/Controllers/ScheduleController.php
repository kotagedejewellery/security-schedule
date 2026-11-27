<?php
namespace App\Http\Controllers;
use App\Models\ScheduleAssignment; use App\Models\SecurityOfficer; use Carbon\Carbon; use Illuminate\Http\Request;
class ScheduleController extends Controller {
 public function index(Request $request) { return view('schedule', $this->scheduleData($request)); }
 protected function scheduleData(Request $request): array { $value=$request->string('month')->toString(); $month=preg_match('/^\d{4}-(0[1-9]|1[0-2])$/',$value) ? Carbon::createFromFormat('Y-m',$value)->startOfMonth() : now()->startOfMonth(); $officers=SecurityOfficer::where('is_active',true)->orderBy('id')->get(); $assignments=ScheduleAssignment::whereIn('security_officer_id',$officers->pluck('id'))->whereBetween('assignment_date',[$month->toDateString(),$month->copy()->endOfMonth()->toDateString()])->get(); $lastUpdated=$assignments->sortByDesc('updated_at')->first()?->updated_at; $assignments=$assignments->keyBy(fn($item)=>$item->assignment_date->toDateString().'-'.$item->security_officer_id); return compact('month','officers','assignments','lastUpdated'); }
}
