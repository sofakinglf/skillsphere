<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('username')->unique()->nullable();  // Optional username
            $table->string('number')->nullable();              // Phone number or contact
            $table->boolean('status')->default(1);             // 1 = active, 0 = inactive
            $table->unsignedBigInteger('role_id')->default(3); // Default role ID
            $table->string('api_token', 80)->unique()->nullable(); // For API access
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
