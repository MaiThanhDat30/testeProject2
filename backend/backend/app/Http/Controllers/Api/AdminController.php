<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Book;

class AdminController extends Controller
{
    // Dashboard admin
    public function index()
    {
        return response()->json([
            'message' => 'Welcome Admin, bạn có full access!',
            'total_users' => User::count(),
            'total_books' => Book::count(),
        ]);
    }

    // Quản lý users (ví dụ: list user)
    public function listUsers()
    {
        return User::all();
    }

    // Xóa user (demo full access)
    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'User đã bị xóa']);
    }

    // Quản lý sách (ví dụ: list all books)
    public function listBooks()
    {
        return Book::all();
    }
}
