<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class BookController extends Controller
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->middleware('auth');

        // Add permission-based middleware
        $this->middleware('permission:view-books')->only(['index', 'loadAjax']);
        $this->middleware('permission:create-books')->only(['create', 'store']);
        $this->middleware('permission:delete-books')->only(['destroy']);
        $this->bookService = $bookService;
    }

    /**
     * Display the books listing page.
     */
    public function index()
    {
        return view('books.index');
    }

    /**
     * Load books for DataTables.
     */
    public function loadAjax()
    {
        return $this->bookService->loadAjax();
    }

    /**
     * Show the create book form.
     */
    public function create()
    {
        return view('books.form');
    }

    /**
     * Store a new book.
     */
    public function store(Request $request)
    {

        $this->bookService->create($request->all());
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Show the edit book form.
     */
    public function edit($id)
    {
        $book = $this->bookService->find($id);
        return view('books.form', compact('book'));
    }

    /**
     * Update an existing book.
     */
    public function update(Request $request, $id)
    {
        $this->bookService->update($id, $request->all());
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Delete a book.
     */
    public function destroy($id)
    {
        $this->bookService->delete($id);
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
