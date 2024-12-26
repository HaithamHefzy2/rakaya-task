<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Get counts for users, books, and borrows
        $users = User::count();
        $books = Book::count();
        $borrows = Borrow::count();


        return view('dashboard', compact('users', 'books', 'borrows'));
    }

}
