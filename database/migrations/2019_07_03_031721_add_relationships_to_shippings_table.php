<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shippings', function (Blueprint $table) {
            $table->string('payment_id')->unsigned()->change();
            $table->foreign('payment_id')->references('id')->on('payments')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shippings', function (Blueprint $table) {
            //
            $table->dropForeign('shippings_payment_id_foreign');
        });

        Schema::table('shippings', function (Blueprint $table) {
            //
            $table->dropIndex('shippings_payment_id_foreign');
        });

        Schema::table('shippings', function (Blueprint $table) {
            //
            $table->integer('payment_id')->change();
        }); 
    }
}
