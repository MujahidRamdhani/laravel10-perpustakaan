<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class publicController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::all();

        if ($request->category || $request->title) {
            $books = Book::Where('title', 'like', '%'.$request->title. '%')
                ->orWhereHas('categories', function($q) use($request) {
                    $q->where('categories.id', $request->category);
                })
                ->get();

               
                // $books = Book::WhereHas('categories', function($q) use($request) {
                //     $q->where('categories.id', $request->category);
                // })
                // ->get();
        }
        else{
            $books = Book::all();
        }

        return view('books-list', ['books' => $books, 'categories' => $categories]);
    }
}
