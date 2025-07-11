<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('stu_name');
            $table->string('gender');
            $table->string('age')->nullable();
            $table->string('major', 50)->nullable();
            $table->decimal('major_price', 8, 2)->nullable();
            $table->date('enrollment_date');
            $table->string('phone')->nullable();
            $table->string('address');
             $table->string('image')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
