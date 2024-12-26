<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Services\BorrowService;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    protected BorrowService $borrowService;

    public function __construct(BorrowService $borrowService)
    {
        $this->middleware('auth');

        // Add permission-based middleware
        $this->middleware('permission:view-borrows')->only(['index', 'loadAjax']);
        $this->middleware('permission:borrow-books')->only(['create', 'store']);
        $this->borrowService = $borrowService;
    }

    /**
     * Display the borrows listing page.
     */
    public function index()
    {
        return view('borrows.index');
    }

    /**
     * Load borrows for DataTables.
     */
    public function loadAjax()
    {
        return $this->borrowService->loadAjax();
    }

    /**
     * Show the create borrow form.
     */
    public function create()
    {
        $users = $this->borrowService->getAllUsers();
        $books = $this->borrowService->getAvailableBooks();
        return view('borrows.form', compact('users', 'books'));
    }


    /**
     * Store a new borrow record.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Pass the data to the service layer
        $this->borrowService->create($data);

        return redirect()->route('borrows.index')->with('success', 'Book borrowed successfully.');
    }

    /**
     * Show the edit borrow form.
     */
    public function edit($id)
    {
        $borrow = $this->borrowService->find($id);
        $users = $this->borrowService->getAllUsers();

        // Include the currently borrowed book in the dropdown list
        $books = $this->borrowService->getAvailableBooks()->push($borrow->book);

        return view('borrows.form', compact('borrow', 'users', 'books'));
    }


    /**
     * Update a borrow record.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        // Pass the updated data to the service layer
        $this->borrowService->update($id, $data);

        return redirect()->route('borrows.index')->with('success', 'Borrow updated successfully.');
    }

    /**
     * Check availability for a specific book.
     */
    public function checkAvailability($bookId)
    {
        $borrows = Borrow::where('book_id', $bookId)
            ->get(['borrowed_at', 'returned_at']);

        $unavailableDates = $borrows->map(function ($borrow) {
            return [
                'start' => $borrow->borrowed_at->format('Y-m-d\TH:i'),
                'end' => $borrow->returned_at ? $borrow->returned_at->format('Y-m-d\TH:i') : null,
            ];
        });

        return response()->json([
            'unavailable_dates' => $unavailableDates,
            'available_from' => now()->format('Y-m-d\TH:i'),
            'available_until' => now()->addMonths(1)->format('Y-m-d\TH:i'),
        ]);
    }

}
