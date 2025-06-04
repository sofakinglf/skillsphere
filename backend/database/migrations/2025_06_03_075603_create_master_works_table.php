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
    Schema::create('work', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->decimal('rate', 10, 2);
        $table->integer('priority')->default(1);
        $table->tinyInteger('status')->default(1);
        $table->string('currency');
        $table->string('paymentType');
        $table->unsignedBigInteger('client_id');
        $table->text('description');
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
        Schema::dropIfExists('work');
    }
};
