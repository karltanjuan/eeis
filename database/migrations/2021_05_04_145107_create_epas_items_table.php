<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpasItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epas_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('item_quantity')->nullable();
            $table->string('item_type')->nullable();
            $table->string('item_status')->nullable();
            $table->datetime('expired_at')->nullable;
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
        Schema::dropIfExists('epas_items');
    }
}
