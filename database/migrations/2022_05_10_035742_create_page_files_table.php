<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_id')->unsigned();
            $table->bigInteger('file_id')->unsigned();

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files_teacher_pages', function (Blueprint $table) {
            //
        });
    }
}
