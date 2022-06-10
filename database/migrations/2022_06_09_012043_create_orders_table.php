<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->string('reference_code')->unique();
            $table->float('total_amount', 8, 2);
            $table->float('total_shipping_fee', 8, 2);
            $table->text('shipping_address');
            $table->text('delivery_notes')->nullable();
            $table->string('payment_method')->default('ONLINE PAYMENT (VIA SEND PAYMENT PROOF)');
            $table->string('status')->default('PENDING');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
