<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('photo')->nullable();
            $table->string('code');
            $table->text('description')->nullable();
            $table->string('writer');
            $table->string('publisher');
            $table->year('year_published');
            $table->integer('stock')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('rak_id')->nullable();

            $table->foreign('rak_id')->references('id')->on('raks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
