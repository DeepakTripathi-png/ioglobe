<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alarms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ioslave_id');  
            $table->string('message');
            $table->longText('modbus_data')->nullable();
            $table->enum('alarm_status', ['active', 'acknowledged'])->default('active');
            $table->unsignedInteger('occurrences')->default(1);
            $table->timestamp('last_triggered_at')->useCurrent()->nullable()->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('last_acknowledged_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarms');
    }
};
