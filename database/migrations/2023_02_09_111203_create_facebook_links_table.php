<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacebookLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facebook_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('facebook_title');
            $table->string('facebook_description');
            $table->string('facebook_photo')->nullable();;
            $table->string('facebook_link');
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
        Schema::dropIfExists('facebook_links');
    }
}
