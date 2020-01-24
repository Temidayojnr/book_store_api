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
        $books = Book::orderBy('title')->paginate(10);

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
            return response()->json($data, 201);
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
            return response()->json($data, 200);
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
            return response()->json($data, 200);
        }

    }

    //get an author
    public function get_author($id)
    {
        $author = Author::find($id)->get();

        if (!is_null($author)) {
            $data = [
                'data'=>$author,
                'message'=>'success',
            ];
            return response($data, 200);
        }else {
            $data = [
                'message'=>'No Author found',
            ];
            return response()->json($data, 200);
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
            return response()->json($data, 200);
        }

        
    }

    // search query
    public function search_book_title(Request $request, $title)
    {
        $search_title = $title;
        $query = Book::where('title', 'LIKE', "%$search_title%")->get();

        return response()->json($query, 200);
    }

    // search query for author
    public function search_author(Request $request, $author)
    {
        $search_author = $author;
        $query = Author::where('id', 'LIKE', "%$search_author%")->paginate(10);

        if (!is_null($query)) {
            $data = [
                'data'=>$query,
                'message'=>'success',
            ];
            return response()->json($data, 200);
        }else {
            $data = [
                'message'=>'No Author found',
            ];
            return response()->json($data, 404);
        }
    }
}
