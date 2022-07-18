<?php

use App\Models\BodyType;
use App\Models\Brand;
use App\Models\DriveWheel;
use App\Models\Fuel;
use App\Models\CarModel;
use App\Models\Seri;
use App\Models\Transmission;
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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Brand::class);
            $table->foreignIdFor(CarModel::class);
            $table->foreignIdFor(Seri::class);
            $table->foreignIdFor(Transmission::class);
            $table->foreignIdFor(DriveWheel::class);
            $table->foreignIdFor(Fuel::class);
            $table->foreignIdFor(BodyType::class);
            $table->integer('engine_capacity');
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
        Schema::dropIfExists('body_cars');
    }
};
