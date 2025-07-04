<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('log_name')->nullable();
            $table->text('description');
            $table->nullableMorphs('subject', 'subject');
            $table->nullableMorphs('causer', 'causer');
            $table->json('properties')->nullable();
            $table->timestamps();
            $table->index('log_name');
        });

        // Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('log_name')->nullable();
        //     $table->text('description');
        //     $table->nullableMorphs('subject', 'subject');
        //     $table->nullableMorphs('causer', 'causer');
        //     $table->json('properties')->nullable();
        //     $table->timestamps();
        //     $table->index('log_name');
        // });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        // Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
        Schema::dropIfExists('activity_log');
    }
}
