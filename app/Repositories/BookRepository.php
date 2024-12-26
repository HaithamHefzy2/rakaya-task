<?php

namespace App\Repositories;

use App\Models\Book;
use Yajra\DataTables\DataTables;

class BookRepository
{
    /**
     * Load books data for DataTables.
     */
    public function loadAjax()
    {
        $books = Book::query();

        return DataTables::of($books)
            ->editColumn('title', fn($model) => '<strong>' . e($model->title) . '</strong>')
            ->editColumn('author', fn($model) => e($model->author))
            ->editColumn('is_available', fn($model) => $model->is_available ? 'Available' : 'Not Available')
            ->addColumn('action', fn($model) => '
                <a href="' . route('books.edit', $model->id) . '" class="btn btn-primary btn-sm">Edit</a>
                <form action="' . route('books.destroy', $model->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            ')
            ->rawColumns(['title', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Create a new book.
     */
    public function create(array $data)
    {
        return Book::create($data);
    }

    /**
     * Find a book by ID.
     */
    public function find(int $id)
    {
        return Book::findOrFail($id);
    }

    /**
     * Update an existing book.
     */
    public function update(int $id, array $data)
    {
        $book = $this->find($id);
        $book->update($data);
        return $book;
    }

    /**
     * Delete a book by ID.
     */
    public function delete(int $id)
    {
        $book = $this->find($id);
        $book->delete();
    }
}
