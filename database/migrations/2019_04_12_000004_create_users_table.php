<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateUsersTable extends Migration
{
    /**
     * @var string
     */
    private $table = 'users';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('company')->nullable();
                $table->string('email');
                $table->unsignedInteger('role_id');
                $table->boolean('existence')
                    ->nullable()
                    ->storedAs('CASE WHEN deleted_at IS NULL THEN 1 ELSE NULL END');
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();

                $table->unique([
                    'email',
                    'existence',
                ]);

                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onDelete('cascade');
            });
        } catch (\Exception $e) {
            report($e);
            $this->down();
            dd($e->getMessage());
        }
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
