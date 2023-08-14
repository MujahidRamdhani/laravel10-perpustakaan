<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('book-rent', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
      $request['rent_date'] = Carbon::now()->toDateString();
      $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

      $book = Book::findOrFail($request->book_id)->only('status');
      if($book['status'] != 'in stock'){
        Session::flash('message', 'Cannot rent, the book is not avaible');
        Session::flash('alert-class', 'alert-danger');
        return redirect('book-rent');
      }
      else{
        $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)
        ->count();

        if($count >= 3){
          Session::flash('message', 'Cannot rent, user has reach limit of book');
          Session::flash('alert-class', 'alert-danger');
          return redirect('book-rent');
        }
        else{
                  try{
                      DB::beginTransaction();
                      //process insert to rent_logs table
                      RentLogs::create($request->book_id);
                      //process update book table
                      $book = Book::findOrFail($request->book_id);
                      $book->status = 'not avaible';
                      $book->save();
                      DB::commit();
                      Session::flash('message', 'Succes Rent BOOK!!!!');
                      Session::flash('alert-class', 'alert-danger');
                      return redirect('book-rent');
                      } catch(\Throwable $th){
                        DB::rollBack();
                      }
            }
      }
    }

    public function returnBook()
    {
      $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
      $books = Book::all();
        return view('return-book', ['users' => $users, 'books' => $books]);
    }

    public function saveReturnBook(Request $request)
    {
      $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null)->count();
      $rentData = $rent->first();
      $countData = $rent->count();
      if($countData == 1){
        $rentData->actual_return_date = Carbon::now()->toDateString();
        $rentData->save();
        $book = Book::findOrFail($request->book_id);
        $book->status = 'in stock';
        $book->save();
       Session::flash('message', 'The Book Is Returned Succesfully');
       Session::flash('alert-class', 'alert-success');
       return redirect('book-rent');
      }
      else{
        Session::flash('message', 'The Book Is Error In Process!');
        Session::flash('alert-class', 'alert-danger');
        return redirect('book-rent');
      }
     
    }
}
