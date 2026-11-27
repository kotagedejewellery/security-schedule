<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up():void { Schema::create('schedule_assignments',function(Blueprint $t){$t->id();$t->date('assignment_date');$t->foreignId('security_officer_id')->constrained()->restrictOnDelete();$t->string('location',12)->nullable();$t->string('status',12);$t->timestamps();$t->unique(['assignment_date','security_officer_id']);}); } public function down():void { Schema::dropIfExists('schedule_assignments'); } };
