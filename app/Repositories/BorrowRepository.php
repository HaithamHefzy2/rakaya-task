<?php

namespace App\Repositories;

use App\Models\Borrow;
use Yajra\DataTables\DataTables;

class BorrowRepository
{
    /**
     * Load borrows for DataTables.
     */
    public function loadAjax()
    {
        $borrows = Borrow::with('book', 'user')->get();
        return DataTables::of($borrows)
            ->addColumn('user', fn($model) => $model->user->name)
            ->addColumn('book', fn($model) => $model->book->title)
            ->editColumn('borrowed_at', fn($model) => $model->borrowed_at ? $model->borrowed_at->format('Y-m-d') : '-')
            ->editColumn('returned_at', fn($model) => $model->returned_at ? $model->returned_at->format('Y-m-d') : '-')
            ->addColumn('action', fn($model) => '
                <a href="' . route('borrows.edit', $model->id) . '" class="btn btn-primary btn-sm">Edit</a>
                <form action="' . route('borrows.destroy', $model->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            ')
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Create a borrow record.
     */
    public function create(array $data)
    {
        return Borrow::create($data);
    }

    /**
     * Find a borrow record by ID.
     */
    public function find($id)
    {
        return Borrow::findOrFail($id);
    }

    /**
     * Update a borrow record.
     */
    public function update($id, array $data)
    {
        $borrow = $this->find($id);
        $borrow->update($data);
        return $borrow;
    }

}
