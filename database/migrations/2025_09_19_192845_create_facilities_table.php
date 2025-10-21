<?php
// database/migrations/2025_09_19_000001_create_facilities_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->date('last_update_date');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('facilities');
    }
};

