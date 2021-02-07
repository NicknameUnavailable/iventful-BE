<?php namespace Kysel\Events\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('kysel_events_events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('user_id');
            $table->string('address');
            $table->string('date_start');
            $table->string('date_end');
            $table->longtext('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kysel_events_events');
    }
}
