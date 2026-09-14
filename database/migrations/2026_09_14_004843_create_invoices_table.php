<?php

use App\Enums\InvoiceStatus;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Client::class)->constrained()->cascadeOnDelete();
            $table->string('number')->unique();
            $table->string('public_token', 40)->unique();
            $table->string('status')->default(InvoiceStatus::Draft->value);
            $table->date('issued_on');
            $table->date('due_on');
            $table->date('paid_on')->nullable();
            $table->string('payment_method')->nullable();
            $table->unsignedInteger('tax_rate_basis_points')->default(0);
            $table->string('currency', 3)->default('USD');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
