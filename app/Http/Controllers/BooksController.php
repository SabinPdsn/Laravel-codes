<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
     return Book::latest()->paginate(5);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'author'=>'required|string|max:255',
            'published_at'=>'required|max:255',
            'user_id'=>'required|unique:books,user_id'
        ]);
        $data = Book::create([
            'title'=>$request->title,
            'author'=>$request->author,
            'published_at'=>$request->published_at,
            'user_id'=>$request->user_id
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'book stored successfully',
            'data'=>$data
        ]);
    }


    public function show(Book $book_id)
    {
        if($book_id){
            return response()->json([
                 'message'=>'book found successfully',
                 'searched book'=>$book_id->load('user')
            ]);
        }
    }

    public function update(Request $request, Book $book_id)
    {
        $validationforupdate = $request->validate([
            'title'=>'nullable|string|max:255|unique:books,title',
            'author'=>'nullable|string|max:255',
            'published_at'=>'nullable|max:255'
        ]);

        $book_id->update($validationforupdate);


    return response()->json([
        "message"=>"Books updated successfully",
        "updated book info"=>$book_id
    ]);
    }

    public function destroy(Book $book_id)
    {
        $book_id->delete();

        return response()->json([
            'message'=>'book deleted successfully'
        ]);
    }
}
