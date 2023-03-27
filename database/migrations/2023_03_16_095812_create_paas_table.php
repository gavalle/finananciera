<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paas', function (Blueprint $table) {
            $table->id();
            
            $table->string('cod', 20)->nullable()->unique();
            $table->string('name', 256)->unique();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('paa_status_id');
            $table->unsignedBigInteger('year_id');
            $table->foreign('paa_status_id')->references('id')->on('paa_status');
            $table->foreign('year_id')->references('id')->on('years');

            

            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paas');
    }
};
