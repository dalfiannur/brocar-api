<?php

use App\Models\Review;
use App\Models\SellerReview;
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
        Schema::create('seller_review_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Review::class);
            $table->foreignIdFor(SellerReview::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_review_items');
    }
};
