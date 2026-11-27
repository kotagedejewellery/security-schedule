<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up():void { Schema::create('security_officers',function(Blueprint $t){$t->id();$t->string('name');$t->string('base_location',12);$t->boolean('is_active')->default(true);$t->timestamps();}); } public function down():void { Schema::dropIfExists('security_officers'); } };
