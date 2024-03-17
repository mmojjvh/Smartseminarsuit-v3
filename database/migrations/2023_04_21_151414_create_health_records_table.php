<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->string('school_office')->nullable();
            $table->string('diagnosis')->nullable();
            $table->text('plan_summary')->nullable();

            $table->boolean('panoramic')->default(false);
            $table->boolean('photo')->default(false);
            $table->boolean('ceph')->default(false);
            $table->boolean('cast')->default(false);
            $table->boolean('tmj')->default(false);

            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('patient_id')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatment_records');
    }
}
