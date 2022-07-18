<?php

use App\Models\AdminFee;
use App\Models\Car;
use App\Models\CheckLocation;
use App\Models\Commission;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Car::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(CheckLocation::class);
            $table->foreignIdFor(Regency::class);
            $table->foreignIdFor(AdminFee::class);
            $table->foreignIdFor(Commission::class);
            $table->integer('year');
            $table->string('color');
            $table->double('used_distance');
            $table->double('admin_fee');
            $table->double('commission');
            $table->text('description')->nullable();
            $table->double('price');
            $table->string('plate_number');
            $table->timestamp('sold_at')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('ads');
    }
};
