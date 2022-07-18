<?php

use App\Models\Ad;
use App\Models\Buyer;
use App\Models\OrderStatus;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ad::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(OrderStatus::class);
            $table->foreignIdFor(Buyer::class);
            $table->date('date');
            $table->text('note')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
