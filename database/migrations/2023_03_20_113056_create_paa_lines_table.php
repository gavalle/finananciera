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
        Schema::create('paa_lines', function (Blueprint $table) {
            $table->id();
            
            //Dependencia or Organizational Area
            $table->integer('organizational_area_id');
            $table->string('organizational_area_cod',20);
            $table->string('organizational_area_name', 256);

            //Autoincremental code of the line by year
            $table->integer('cod');

            //PAA Line Code (organizational_area_cod + cod)
            $table->string('cod_paa_line',40)->unique();

            $table->string('unspsc',40);

            $table->text('description');

            $table->timestamp('start_date_selection_process');

            $table->integer('contract_duration');
            $table->integer('contract_duration_unit_id');
            $table->string('contract_duration_unit_name',128);

            $table->integer('selection_method_id');
            $table->string('selection_method_name',256);

            $table->integer('source_funds_id');
            $table->string('source_funds_name',256);


            $table->integer('total_amount');
            $table->integer('value_current_period');
            $table->boolean('future_periods_required')->default(false);
            $table->string('status_future_periods',128)->default('N/A');

            $table->integer('unit_responsible_id');
            $table->string('unit_responsible_name',256);
            $table->string('cod_paa_line_unit_responsible',512);

            $table->integer('contractor_id');
            $table->integer('contractor_identification');
            $table->string('contractor_name',256);

            $table->text('observations')->nullable();

            $table->boolean('service_contract')->default(false);
            $table->integer('service_contract_type_id')->nullable();
            $table->string('service_contract_type_name',256)->nullable();

            $table->integer('operating_value')->nullable();
            $table->string('operating_budget',256)->nullable();

            $table->integer('investment_value')->nullable();
            $table->string('investment_budget',256)->nullable();

            $table->string('action_plan_indicator',20);

            $table->integer('value_resources_other_sources')->nullable();

            $table->unsignedBigInteger('paa_id');
            $table->foreign('paa_id')->references('id')->on('paas');

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('paa_line_status');

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
        Schema::dropIfExists('paa_lines');
    }
};
