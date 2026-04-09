<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasAuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Petugas\BookController as PetugasBookController;
use App\Http\Controllers\UserBookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Petugas\CategoryController as PetugasCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\BookRequestController;
use App\Http\Controllers\Petugas\CategoryRequestController;
use App\Http\Controllers\Petugas\ApprovalController as PetugasApprovalController;
use App\Http\Controllers\Petugas\PeminjamanController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Petugas\UserController as PetugasUserController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;

use App\Models\Category;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
});

/*
|--------------------------------------------------------------------------
| AUTH USER
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('user.register');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:user'])->group(function () {

   Route::get('/user/dashboard', function () {

  $categories = Category::all(); // ambil semua kategori

  $books = \App\Models\Book::with(['categories', 'reviews.user'])->latest()->take(8)->get();
    return view('user.dashboard', compact('books','categories'));

})->middleware('auth');

    Route::get('/user/books', [UserBookController::class, 'index'])->name('user.books');

    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::post('/books/{book}/add-to-collection', [BookController::class, 'addToCollection'])->name('books.addToCollection');

    Route::get('/borrow/{book}', [BorrowingController::class, 'create'])->name('borrow.create');
    Route::post('/borrow', [BorrowingController::class, 'store'])->name('borrow.store');
    Route::post('/return/{id}', [BorrowingController::class, 'return'])->name('borrow.return');
    Route::get('/history', [BorrowingController::class, 'history'])->name('borrow.history');
    Route::post('/user/peminjaman/{id}/return', [BorrowingController::class, 'requestReturn'])
    ->name('user.peminjaman.return');

   Route::get('/book/{book}/review', [\App\Http\Controllers\ReviewController::class, 'create'])->name('book.review');
    Route::post('/book/{book}/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('book.review.store');
    
    Route::get('/koleksi-saya', [CollectionController::class, 'index'])->name('user.collections.index');
});

/*
|--------------------------------------------------------------------------
| PROFILE (LOGIN SEMUA ROLE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::put('/user/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');
    // if form uses POST directly instead of spoofing PUT:
    Route::post('/user/profile/update', [ProfileController::class, 'update']);
});

/*
|--------------------------------------------------------------------------
| PETUGAS LOGIN
|--------------------------------------------------------------------------
*/

Route::prefix('petugas')->middleware('web')->group(function () {

    // FORM LOGIN PETUGAS
    Route::get('/', [PetugasAuthController::class, 'showLogin'])
        ->name('petugas.petugas.login');

    // PROSES LOGIN PETUGAS
    Route::post('/login', [PetugasAuthController::class, 'login'])
        ->name('petugas.petugas.login.submit');

    // PROTECTED ROUTES (hanya petugas yang login)
    Route::middleware(['web','auth:petugas'])->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
            ->name('petugas.dashboard');

        Route::post('/logout', [PetugasAuthController::class, 'logout'])
            ->name('petugas.logout');

            Route::get('book-requests', [BookRequestController::class, 'index'])
                ->name('petugas.book_requests.index');
            Route::get('book-requests/create', [BookRequestController::class, 'create'])
                ->name('petugas.book_requests.create');
            Route::post('book-requests', [BookRequestController::class, 'store'])
                ->name('petugas.book_requests.store');

        // RESOURCE / BOOKS / APPROVAL DLL
        Route::resource('categories', PetugasCategoryController::class, [
    'names' => [
        'index' => 'petugas.categories.index',
        'create' => 'petugas.categories.create',
        'store' => 'petugas.categories.store',
        'show' => 'petugas.categories.show',
        'edit' => 'petugas.categories.edit',
        'update' => 'petugas.categories.update',
        'destroy' => 'petugas.categories.destroy',
    ]
    ]);

        Route::resource('books', PetugasBookController::class, [
    'names' => [
        'index' => 'petugas.books.index',
        'create' => 'petugas.books.create',
        'store' => 'petugas.books.store',
        'show' => 'petugas.books.show',
        'edit' => 'petugas.books.edit',
        'update' => 'petugas.books.update',
        'destroy' => 'petugas.books.destroy',
    ]

    ]);

        Route::resource('category-requests', CategoryRequestController::class, [
            'names' => [
                'index' => 'petugas.category_requests.index',
                'create' => 'petugas.category_requests.create',
                'store' => 'petugas.category_requests.store',
            ]
        ]);

        // APPROVAL
        Route::post('/approve/{id}', [PetugasApprovalController::class, 'approve'])->name('approve');
        Route::post('/reject/{id}', [PetugasApprovalController::class, 'reject'])->name('reject');
        Route::post('/approve-return/{id}', [PetugasApprovalController::class, 'approveReturn'])->name('approveReturn');
        Route::post('/reject-return/{id}', [PetugasApprovalController::class, 'rejectReturn'])->name('rejectReturn');

        // REVIEW DELETE
        Route::delete('/review/{review}', [ReviewController::class, 'destroy'])->name('petugas.review.destroy');

        // PEMINJAMAN & USERS & LAPORAN
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('petugas.peminjaman.index');
        Route::get('/users', [PetugasUserController::class, 'index'])->name('petugas.users.index');
        Route::get('/approvals', [PetugasApprovalController::class, 'index'])->name('petugas.approvals.index');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('petugas.laporan.index');
        Route::get('/laporan/print/{id}', [LaporanController::class, 'print'])->name('petugas.laporan.print');
        Route::get('/laporan/print-all', [LaporanController::class, 'printAll'])->name('petugas.laporan.printAll');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('books', AdminBookController::class);
    Route::resource('categories', AdminCategoryController::class);
    
    Route::resource('petugas', PetugasController::class)->parameters(['petugas' => 'petugas']);

    Route::patch('petugas/{petugas}/toggle-status', 
        [PetugasController::class, 'toggleStatus'])
        ->name('petugas.toggle-status');
        
    Route::get('admin/peminjaman', [AdminBorrowingController::class, 'index'])
        ->name('peminjaman.index');

        Route::post('/peminjaman/{id}/approve-return', [AdminBorrowingController::class, 'approveReturn'])
    ->name('peminjaman.approveReturn');
Route::post('/peminjaman/{id}/reject-return', [AdminBorrowingController::class, 'rejectReturn'])
    ->name('peminjaman.rejectReturn');


Route::get('/approvals', [ApprovalController::class, 'index'])
        ->name('approvals.index');
    Route::post('/approvals/{id}/approve', [AdminBorrowingController::class, 'approve'])->name('approvals.approve');
    Route::post('/approvals/{id}/reject', [AdminBorrowingController::class, 'reject'])->name('approvals.reject');

    Route::post('/approvals/{id}/approve-return', [AdminBorrowingController::class, 'approveReturn'])->name('approvals.approveReturn');
    Route::post('/approvals/{id}/reject-return', [AdminBorrowingController::class, 'rejectReturn'])->name('approvals.rejectReturn');


    Route::post('/approve-book/{id}', [ApprovalController::class, 'approveBook']);
    Route::post('/reject-book/{id}', [ApprovalController::class, 'rejectBook']);

    Route::post('/approve-category/{id}', [ApprovalController::class, 'approveCategory']);
    Route::post('/reject-category/{id}', [ApprovalController::class, 'rejectCategory']);

    Route::post('/admin/book-request/{id}/approve', [ApprovalController::class, 'approveBook'])
    ->name('admin.book.approve');

Route::post('/admin/book-request/{id}/reject', [ApprovalController::class, 'rejectBook'])
    ->name('admin.book.reject');

    Route::get('/laporan', [AdminBorrowingController::class, 'laporan'])
        ->name('laporan.index');

    Route::get('/laporan/{id}/print', [AdminBorrowingController::class, 'print'])
        ->name('laporan.print');
    Route::get('/laporan/print-all', [AdminBorrowingController::class, 'printAll'])
        ->name('laporan.printAll');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::delete('/review/{id}', [AdminReviewController::class, 'destroy'])
    ->name('review.destroy');
  });