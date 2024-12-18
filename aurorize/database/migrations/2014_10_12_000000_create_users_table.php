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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('role_id')->default(2)->comment('1-Admin, 2-User');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('country_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('photo')->nullable();
            $table->string('password');
            $table->tinyInteger('is_active')->default(0)->comment('0-Pending, 1-Active, 2-Deactive');
            $table->tinyInteger('is_complete_profile')->default(0)->comment('0-no, 1-yes');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
