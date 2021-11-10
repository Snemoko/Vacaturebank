<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('job_title');
            $table->integer('hours');
            $table->String('text');
            $table->String('labor_contract')->nullable();
            $table->String('working_conditions')->nullable();
            $table->String('contract')->nullable();
            $table->String('ethic')->nullable();
            $table->String('dismissal')->nullable();
            $table->String('health_safety')->nullable();
            $table->integer('company_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_offers');
    }
}
