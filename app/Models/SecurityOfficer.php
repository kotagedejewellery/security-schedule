<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SecurityOfficer extends Model { protected $fillable = ['name','base_location','is_active']; protected function casts(): array { return ['is_active'=>'boolean']; } }
