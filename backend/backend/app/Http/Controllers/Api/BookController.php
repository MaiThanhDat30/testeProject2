<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
   public function index()
    {
        $books = Book::with('category')->get();
        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::with('category')->find($id);
        if (!$book) return response()->json(['message' => 'Không tìm thấy sách'], 404);
        return response()->json($book);
    }

    public function store(Request $request)
    {
         $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        'description' => 'nullable|string',
        'published_year' => 'nullable|integer',
        'image' => 'nullable|image|max:2048',
    ]);

    $book = new Book();
    $book->title = $request->title;
    $book->author = $request->author;
    $book->category_id = $request->category_id;
    $book->description = $request->description;
    $book->published_year = $request->published_year;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('books', 'public');
        $book->image = '/storage/' . $path;
    }

    $book->save();

    return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
    if (!$book) return response()->json(['message' => 'Không tìm thấy sách'], 404);

    $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'author' => 'sometimes|required|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        'description' => 'nullable|string',
        'published_year' => 'nullable|integer',
        'image' => 'nullable|image|max:2048',
    ]);

    $book->title = $request->title ?? $book->title;
    $book->author = $request->author ?? $book->author;
    $book->category_id = $request->category_id ?? $book->category_id;
    $book->description = $request->description ?? $book->description;
    $book->published_year = $request->published_year ?? $book->published_year;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('books', 'public');
        $book->image = '/storage/' . $path;
    }

    $book->save();

    return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) return response()->json(['message' => 'Không tìm thấy sách'], 404);

        $book->delete();
        return response()->json(['message' => 'Xoá thành công']);
    }
}