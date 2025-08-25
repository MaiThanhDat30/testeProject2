<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo category
        $category1 = Category::create(['name' => 'Lập trình']);
        $category2 = Category::create(['name' => 'Công nghệ']);

        // Tạo books
        Book::create([
            'title' => 'Lập trình Laravel cơ bản',
            'author' => 'Nguyễn Văn A',
            'category_id' => $category1->id,
            'description' => 'Sách hướng dẫn học Laravel từ cơ bản đến nâng cao',
            'published_year' => 2024,
        ]);

        Book::create([
            'title' => 'Lập trình PHP nâng cao',
            'author' => 'Trần Thị B',
            'category_id' => $category1->id,
            'description' => 'Hướng dẫn các kỹ thuật PHP nâng cao',
            'published_year' => 2025,
        ]);

        Book::create([
            'title' => 'Công nghệ AI cơ bản',
            'author' => 'Lê Văn C',
            'category_id' => $category2->id,
            'description' => 'Giới thiệu về trí tuệ nhân tạo',
            'published_year' => 2023,
        ]);
    }
}
