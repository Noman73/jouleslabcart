<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code',250)->unique();
            $table->string("discount_type",250)->default("fixed");
            $table->decimal("discount_amount",20,2)->default(0);
            $table->decimal("maximum_discount_amount",20,2)->default(0);
            $table->decimal("minimum_total_price",20,2)->default(0);
            $table->integer("maximum_num_of_items");
            $table->integer("minimum_num_of_items");
            $table->unsignedBigInteger("allowed_product_id")->nullable();
            $table->integer("max_uses_system")->nullable();
            $table->integer("max_uses_user")->nullable();
            $table->boolean("is_auto_applied",250)->default(false);
            $table->timestamp("expiry_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
