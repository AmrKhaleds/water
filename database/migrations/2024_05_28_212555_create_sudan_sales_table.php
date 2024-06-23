<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSudanSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sudan_sales', function (Blueprint $table) {
            $table->id();
            $table->text('address')->nullable();
            $table->string('client_name'); // done
            $table->string('client_phone')->nullable(); // done
            $table->string('client_whatsapp')->nullable(); // done
            $table->string('client_passport')->nullable(); // done

            $table->string('driver_name')->nullable(); // done
            $table->string('driver_phone')->nullable(); // done
            $table->string('driver_passport')->nullable(); // done
            $table->string('water_export')->nullable(); // done
            
            $table->integer('quantity'); // done
            $table->integer('small_packages')->nullable();
            $table->integer('large_packages')->nullable();
            
            $table->unsignedBigInteger('product_id')->nullable();

            $table->string('company_name'); // done
            $table->string('clearance_agent_name')->nullable();
            $table->string('clearance_agent_phone')->nullable();

            $table->string('ref');
            $table->double('purchase_price'); // done
            $table->double('sale_price'); // done
            $table->double('expenses')->nullable();
            $table->double('net_profit');
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('goods_received_date')->nullable();
            $table->enum('received', ['received', 'pending'])->default('pending');
            $table->unsignedBigInteger('assign_from');

            $table->text('notes')->nullable();
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
        Schema::dropIfExists('sudan_sales');
    }
}
