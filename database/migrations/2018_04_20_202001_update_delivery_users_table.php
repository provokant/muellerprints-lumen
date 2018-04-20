<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDeliveryUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'company')) {
                $table->string('delivery_salutation')->nullable()->after('company');
            } else {
                $table->string('delivery_salutation')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'delivery_salutation')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('delivery_salutation');
            });
        }
    }
}
