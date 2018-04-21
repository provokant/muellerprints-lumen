<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDeliveryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'delivery')) {
                $table->dropColumn('delivery');
            }
            if (Schema::hasColumn('orders', 'sum')) {
                $table->string('delivery_salutation')->nullable()->after('sum');
            } else {
                $table->string('delivery_salutation')->nullable();
            }

            $table->string('delivery_name')->nullable()->after('delivery_salutation');
            $table->string('delivery_street')->nullable()->after('delivery_name');
            $table->integer('delivery_zip')->nullable()->after('delivery_street');
            $table->string('delivery_town')->nullable()->after('delivery_zip');
            $table->string('delivery_country')->nullable()->after('delivery_town');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $columnsToDelete = [
                'delivery_salutation', 
                'delivery_name', 
                'delivery_street',
                'delivery_zip',
                'delivery_town',
                'delivery_country'
            ];

            foreach ($columnsToDelete as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
