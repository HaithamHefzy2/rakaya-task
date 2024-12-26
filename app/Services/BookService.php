<?php

namespace App\Services;

use App\Models\Borrow;
use App\Repositories\BookRepository;

class BookService
{
    protected BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Load books data for DataTables.
     */
    public function loadAjax()
    {
        return $this->bookRepository->loadAjax();
    }

    /**
     * Create a new book.
     */
    public function create(array $data)
    {
        return $this->bookRepository->create($data);
    }

    /**
     * Find a book by ID.
     */
    public function find(int $id)
    {
        return $this->bookRepository->find($id);
    }

    /**
     * Update an existing book.
     */
    public function update(int $id, array $data)
    {
        return $this->bookRepository->update($id, $data);
    }

    /**
     * Delete a book by ID.
     */
    public function delete(int $id)
    {
        return $this->bookRepository->delete($id);
    }

}
