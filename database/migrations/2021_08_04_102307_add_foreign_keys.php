<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('lekarze'))
        {
            Schema::table('terminy', function(Blueprint $table){
                $table->foreignId('lekarze_id')->constrained('lekarze')->onUpdate('cascade')->onDelete('cascade');
            });
        }

        if(Schema::hasTable('terminy'))
        {
            Schema::table('rezerwacje', function(Blueprint $table){
                $table->foreignId('terminy_id')->unique()->constrained('terminy')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('terminy', function(Blueprint $table){
            $table->dropForeign(['lekarze_id']);
        });

        Schema::table('rezerwacje', function(Blueprint $table){
            $table->dropForeign(['terminy_id']);
        });
    }
}
