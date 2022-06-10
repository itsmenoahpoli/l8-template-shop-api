<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdToProductMonitoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_monitorings', function (Blueprint $table) {
            $table->foreignId('order_id')->nullable()->after('id')->constrained('orders')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_monitorings', function (Blueprint $table) {
            $table->dropColumn(['order_id']);
        });
    }
}
