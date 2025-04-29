
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
        Schema::create('crawl_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // thêm dòng này
            $table->string('brand_name');
            $table->text('post_content');
            $table->boolean('is_group')->default(false);
            $table->boolean('is_fanpage')->default(false);
            $table->text('comment_file');
            $table->text('comment');
            $table->string('date_comment'); // dữ liệu dạng "2 giờ", "2 năm"
            $table->timestamp('date_crawled')->nullable();
            $table->json('data_llm')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crawl_comments');
    }
};
