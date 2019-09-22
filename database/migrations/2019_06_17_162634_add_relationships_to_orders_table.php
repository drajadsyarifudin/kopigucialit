<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            
            
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
       //orders-customer
       Schema::table('orders', function (Blueprint $table) {
        $table->dropForeign('orders_customer_id_foreign');
    });
    Schema::table('orders', function (Blueprint $table) {
        $table->dropIndex('orders_customer_id_foreign');
    });
    Schema::table('orders', function (Blueprint $table) {
        $table->string('customer_id')->change();
    });


    //orders-users
    Schema::table('orders', function (Blueprint $table) {
        $table->dropForeign('orders_user_id_foreign');
    });
    Schema::table('orders', function (Blueprint $table) {
        $table->dropIndex('orders_user_id_foreign');
    });
    Schema::table('orders', function (Blueprint $table) {
        $table->integer('user_id')->change();
    });




    }
}
