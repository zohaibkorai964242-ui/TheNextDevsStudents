<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // user_id for QR-based attendance (new)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            // legacy columns used by existing controllers
            $table->unsignedBigInteger('student_id')->nullable()->index();
            $table->unsignedBigInteger('start_time')->nullable()->index();

            $table->date('date')->nullable();
            $table->timestamp('scanned_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
