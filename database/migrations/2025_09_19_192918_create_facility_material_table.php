<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/2025_09_19_000003_create_facility_material_table.php
return new class extends Migration {
    public function up() {
        Schema::create('facility_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained()->onDelete('cascade');
            $table->foreignId('material_id')->constrained()->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('facility_material');
    }
};

