<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('terminy'))
        {
            Schema::create('terminy', function (Blueprint $table) {
                $table->id();
                $table->date('data');
                $table->time('godzina');
                $table->enum('status', ['wolny', 'zarezerwowany', 'ukończony'])->default('wolny');

                $table->engine = 'InnoDB';
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_polish_ci';
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terminy');
    }
}
