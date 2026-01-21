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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->date('issued_at')->nullable();
            $table->decimal('total', 15, 2);

            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('document_type_id')->constrained('document_types');
            $table->foreignId('document_status_id')->constrained('document_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
