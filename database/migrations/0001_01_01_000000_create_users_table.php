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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable()->default('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAALVBMVEXU1NS2trbT09O3t7e+vr7Pz8/MzMzDw8PIyMjAwMCzs7PX19e6urrKysrFxcVQ/TkPAAAFO0lEQVR4nO2d25KDIAyGBUQrWN//cVdEqz24WiUHbL6rnZ3dmf4TciBAWhSCIAiCIAiCIAiCIAiCIAiCIAiCIAiCIAiCIAiCIAiCIAjCG77Qtuq6pgw0XVdZ3f/uGgQl9ta0yvWoyPBj29ys75VTf8DzVI1RKzhTV9Qf7xS9+fS6vBHT6HwN6avWbegbLNlWmbpk1e6QF2nzW6za21LtMeBoRlVan9lSrQcf2ylw+Lua+iN/g692W29JRu5Yu73We7Kky8WMujxkwUCZhS/q/f73ZkWl+Es86IIz3J3xtED2Eqv9OXANxzr7n7dggLFEnUQg43Cjj8bQVwxTiX5/pb1FyzLa+Pp8lJlwNUeJ1aFS7TOGZUBNt0YDLbWcN3ydVGC/meK2Tm06J4w4Sy3pheP7iTVKaknPJKjWXmEWbNKGmQirYANgQl5G9Om9MFDyCacWRKBSbMKpP9Z52sIwqt0g9A0aqYVNgMSZAJdY4xsggUo1TJYp1CJls0yTl6QzTIrTG6DCG7W4AFC6j/BI+nBuyMIRdbIW4mc0gzN+qJItwiHU3CEFuju1vD7QdJAKVUcfapK3oJ5hUHwD1mwBDnUbsEJqeX0sh0z4oeNGni1ASxoWRY0ovIDC68dS4HxILe8napo09y/W4HC7BrCJwaSNAb0/pMeD7vEZLFLYwpS+LA1cvtf2A/3S6/e8AR2RhxsWxR3s7IlBHypy+fPDvvgGOQPmUHYPaMBzfA4lzfAID+I6zXDLlIfC4gfu08C0Mhg0MBZc/14bgBF5mTDVS4slvExYpC/duBRsD3SyxxaRVrNJFA+SbqK4bJueSfreglrMZxK+maGWssKJ16Mv8PPBkVQVOEsnjFz+/eEPvCFN0NHg07lYwZ97wmYch6OYDUK4OSYy/BfjIPPgzO0MBjcv9nGwuuFayXzAV0Z9v1RNBi44MsyH+taMLqt5UeGD2l0zoh76Wjv+X05ce05UpNoXVctc9QVsZ8Ji/Rx0wm+d6XJIgf9ia7My9cspU2cvL9CHyHFu4qwtzk28znTIwsfZl/U4+7KOsy8vI2+JD1B/CEEQBEEgQ7/8mNtOaQs/1md6YPmbCxAKtnvdtO1yg2HatqnvFxhbPg4r/2fr29xsvip9cW/MdivDmeaencjB0e77h0E7Vd4f/5cH3tZfzLqOIpuMNsP+ix7Ukkxms/uds+Y/GrLXyF7kCX2TRmoJ/6PL0+eHvCdedykunLiOWsYKOizQBHcxjAlLlaEhtU9iwIjrGErUSQw40puRm8J4YpgSZqeJKVfohGPwQHYiuGD6BxeGkTP6rw989+E4PFUP+NNZflUii7vevgCy4CCx4bBzBBQ4SKQGeGgEvS+CRNElhjhpeMBXzhPuRikRdlbbBGV7w4A8rXzGED4lBR6+M0OWFm9IApUiGjxgv2wYHseRuKIGmTS/RkvQLcZIFDMEKUPDjqV5B/stmwYeCPlOjbxZ1NYhpMIZo5zFVYiWCmeQkyLo+KvP4D66JDAhshEJTIhqRPxAGsEMpyQClULTh1hyP4NXgFPEmQDal1xhF2wzWH4IO8/zP5DOToEmCu0B6bstNW5JOtMXpzjLFHVj+AzSHEWqSBpAiaag80q3QJlnitMFXgOjNgX9xo5NMOYR0FTdExjPvSkDDU6ooQw0GOMwtabLhgEH3VXUNNv7hUIL3jgFGzi7UyF8MKXbWETAtxdELZoZ8K9Hgr57sQn43YwfUEib8BH6wtdXSFy0IZRtYkN4hdACr2/D62cL4g0wxhaY6lRm4ut+4h+rqk4YPaPUbwAAAABJRU5ErkJggg==');
            $table->string('username', 100)->unique(); // Đảm bảo username là duy nhất
            $table->string('fullname', 100)->default('user');
            $table->date('birthday')->nullable();
            $table->string('email')->unique(); // Đảm bảo email không trùng lặp
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('role', ['admin', 'teacher', 'student'])->default('student'); // ENUM
            $table->string('phone', 15)->nullable();
            $table->text('address')->nullable();
            $table->timestamps(); // Tạo created_at và updated_at tự động
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
