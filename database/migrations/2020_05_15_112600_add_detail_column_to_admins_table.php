<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailColumnToAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
            $table->enum('type', ['Admin', 'Sub-Admin'])->default("Admin");
            $table->tinyInteger('categories_access');
            $table->tinyInteger('products_access');
            $table->tinyInteger('orders_access');
            $table->tinyInteger('users_access');
            $table->tinyInteger('banners_access');
            $table->tinyInteger('brands_access');
            $table->tinyInteger('cms_pages_access');
            $table->tinyInteger('inquiries_access');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
}
