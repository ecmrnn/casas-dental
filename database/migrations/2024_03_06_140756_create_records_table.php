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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('purpose')->required();
            $table->string('status')->required()->default('scheduled');
            $table->string('note')->nullable();
            $table->date('schedule_date')->default(date("Y-m-d"));
            $table->time('schedule_time')->default(date("H:i:s"));
            $table->dateTime('completed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
