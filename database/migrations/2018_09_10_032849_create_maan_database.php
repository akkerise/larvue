<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaanDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maan_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('created_at');
            $table->integer('updated_at');
        });

        Schema::create('maan_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appota_id');
            $table->integer('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('maan_roles')->onDelete('cascade');
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('fullname');
            $table->string('avatar');
            $table->string('phone');
            $table->string('address');
            $table->tinyInteger('gender');
            $table->string('last_activity')->nullable();
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->string('remember_token')->nullable();
            $table->integer('expired_at')->nullable();
            $table->integer('created_at');
            $table->integer('updated_at');
        });

        Schema::create('maan_apps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('platform');
            $table->string('version');
            $table->string('build');
            $table->string('api_key');
            $table->string('secret_key');
            $table->string('bundle_id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('maan_users')->onDelete('cascade');
            $table->integer('created_at');
            $table->integer('updated_at');
        });

        Schema::create('maan_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image');
            $table->string('url');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('maan_users')->onDelete('cascade');
            $table->integer('app_id')->unsigned()->index();
            $table->foreign('app_id')->references('id')->on('maan_apps')->onDelete('cascade');
            $table->integer('created_at');
            $table->integer('updated_at');
        });

        Schema::create('maan_ads_config', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->unsigned()->index();
            $table->foreign('app_id')->references('id')->on('maan_apps')->onDelete('cascade');
            $table->string('type');
            $table->string('banner');
            $table->string('interstitial');
            $table->string('native');
            $table->integer('created_at');
            $table->integer('updated_at');
        });

        Schema::create('maan_relateds_app', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->unsigned()->index();
            $table->foreign('app_id')->references('id')->on('maan_apps')->onDelete('cascade');
            $table->string('title');
            $table->string('image');
            $table->string('url');
            $table->string('url_schema');
            $table->integer('created_at');
            $table->integer('updated_at');
        });

        Schema::create('maan_iaps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('product_id');
            $table->integer('created_at');
            $table->integer('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
