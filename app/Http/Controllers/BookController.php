<?php

namespace App\Http\Controllers;

use App\Book;
use App\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{

    // To get aggregate books 
    public function getAllBooks() 
    {
        $books = Book::orderBy('id', 'desc')->get();

        if (!is_null($books)) {
            $data = [
                'books'=>$books,
                'message'=>'success',
            ];
            return response($data, 200);
        }else {
            $data = [
                'message'=>'No record found',
            ];
            return response($data, 201);
        }
    }

    // To get single book 
    public function single_book($id)
    {
        $book = Book::find($id)->with('author')->get();

        if (!is_null($book)) {
            $data = [
                'data'=>$book,
                'message'=>'success',
            ];
            return response($data, 200);
        }else {
            $data = [
                'message'=>'No Book found',
            ];
            return response($data, 200);
        }
    }


    // To create author 
    public function create_author(Request $request)
    {
        $author = new Author;
        $author->name = $request->name;
        $author->surname = $request->surname;

        if ($author->save()) {
            $data = [
                'author'=>$author,
                'message'=>'success',
            ];
            return response($data, 200);
        } else {
            $data = [
                'message'=>'Failed to save!!!',
            ];
            return response($data, 200);
        }

    }

    // To create book 
    public function create_book(Request $request)
    {
        $isbn_code = rand();

        $book = new Book;
        $book->isbn = $isbn_code;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author_id = $request->author_id;
        if ($book->save()) {
            $data = [
                'data'=>$book,
                'message'=>'success',
            ];
            return response($data, 200);
        } else {
            $data = [
                'message'=>'Error!!!',
            ];
            return response($data, 200);
        }

        
    }

    // public function 
}
