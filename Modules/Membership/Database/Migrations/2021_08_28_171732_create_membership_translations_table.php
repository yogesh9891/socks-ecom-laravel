<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_translations', function (Blueprint $table) {
              $table->bigIncrements('id');
            $table->integer('membership_id');
            $table->string('locale');
            $table->string('title');
            $table->longText('description')->nullable();

            $table->unique(['membership_id', 'locale']);
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_translations');
    }
}
