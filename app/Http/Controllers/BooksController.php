<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

      /**
     * Get books
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function books()
    {
        $accountId = auth()->user()->account_id;
    //to do pagination
        $books = Book::where('account_id', $accountId)
               ->orderBy('title')
               ->skip(0)
               ->take(20)
               ->get();
        
        return response()->json(['books' => $books]);
    }

    public function book($id){
        $book = Book::find($id);
        return response()->json(['book' => $book]);
    }

    public function addBook(Request $request){

    $validated = $request->validate([
        'title' => 'required|unique:App\Models\Book|max:255',
        'author' => 'required|unique:App\Models\Book|max:255',
        'release_date' => 'required'
    ]);
    $validated['account_id'] =  auth()->user()->account_id;
    $book = Book::create($validated );
    return response()->json(['message' =>  'Success!'], 201);




    }


}   