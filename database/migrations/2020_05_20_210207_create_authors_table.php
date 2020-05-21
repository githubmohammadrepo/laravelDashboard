<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('fullName',60);
            $table->string('about',255)->nullable();
            $table->string('city',30)->nullable();
            $table->string('phone',25)->nullable();
            $table->string('email',50)->nullable();
            $table->string('website',60)->nullable();
            $table->string('publisher',50)->nullable();
            $table->string('age',3)->nullable();
            $table->string('image',65)->nullable();
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
        Schema::dropIfExists('authors');
    }
}
