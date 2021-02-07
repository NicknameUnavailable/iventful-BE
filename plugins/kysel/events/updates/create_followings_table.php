<?php namespace Kysel\Events\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFollowingsTable extends Migration
{
    public function up()
    {
        Schema::create('kysel_events_followings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('user_id');
            $table->string('event_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kysel_events_followings');
    }
}
