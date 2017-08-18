<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Book;
use Auth;
use Illuminate\Support\Facades\Input;  
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    
    public function index()
    {
        //$books = Book::all();
        $books = Book::paginate(3);
        return view('index', compact('books'));
    }

    
    public function create()
    {
        return view('create');
    }

    
    public function store(Request $request)
    {
        $book = new Book;
        $book->user_id = Auth::user()->id;
        $book->content = $request->content;
        $book->filepath = $request->filepath;
        //$filename = uniqid().$request->get('upload_file')->getClientOriginalName() . '.' . $request->get('upload_file')->getClientOriginalExtension();
        //$filename = Input::file('book')->getClientOriginalName();
        $filename=$book->filepath;
        if(Input::file('book')){
        $request->file('book')->move(base_path() . '/public/pdfjs/web/bookstore', $filename.'.'.$request->file('book')->getClientOriginalExtension());
        }
        $book->save();
    }

    
    public function show($id)
    {
        $book = Book::findOrFail($id);
        //$book->filepath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();   
        return view('readerTemp', compact('book'));
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
