<?php

namespace App\Services;

use App\Models\Borrow;
use App\Repositories\BorrowRepository;
use App\Models\User;
use App\Models\Book;

class BorrowService
{
    protected BorrowRepository $borrowRepository;

    public function __construct(BorrowRepository $borrowRepository)
    {
        $this->borrowRepository = $borrowRepository;
    }

    /**
     * Load borrows for DataTables.
     */
    public function loadAjax()
    {
        return $this->borrowRepository->loadAjax();
    }

    /**
     * Create a new borrow record.
     */
    public function create(array $data)
    {
        return $this->borrowRepository->create($data);
    }

    /**
     * Find a borrow record by ID.
     */
    public function find($id)
    {
        return $this->borrowRepository->find($id);
    }

    /**
     * Update an existing borrow record.
     */
    public function update($id, array $data)
    {
        return $this->borrowRepository->update($id, $data);
    }


    /**
     * Get all users.
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * Get all available books.
     */
    public function getAvailableBooks()
    {
        // Fetch books that are available AND not currently in an active borrow period
        return Book::where('is_available', true)
            ->whereDoesntHave('borrows', function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery
                        ->where('borrowed_at', '<=', now()) // Borrowed in the past or today
                        ->where(function ($q) {
                            $q->whereNull('returned_at') // Not yet returned
                            ->orWhere('returned_at', '>=', now()); // Or return date is in the future
                        });
                });
            })
            ->get();
    }


    /**
     * Get available books with the borrowed book included.
     */
    public function getAvailableBooksWithBorrowed($bookId)
    {
        return Book::where('is_available', true)
            ->orWhere('id', $bookId)
            ->get();
    }

    public function getBorrowedPeriods($bookId)
    {
        return Borrow::where('book_id', $bookId)
            ->whereNull('returned_at')
            ->get(['borrowed_at', 'returned_at']);
    }
}
