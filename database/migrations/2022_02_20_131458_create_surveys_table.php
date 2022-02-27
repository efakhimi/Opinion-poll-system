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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('uid');
            $table->tinyText('title');
            $table->tinyText('photo');
            $table->text('description');
            $table->boolean('public')->default(0);
            $table->boolean('registered_only')->default(0);
            $table->boolean('active')->default(0);
            $table->tinyText('url');
            $table->tinyText('password')->default('');
            $table->unsignedTinyInteger('type');//0 normal, 1 exam
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
        Schema::dropIfExists('surveys');
    }
};
