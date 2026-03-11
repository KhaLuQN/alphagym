<?php

use App\Http\Controllers\admin\ArticleCategoryController;
use App\Http\Controllers\admin\ArticleController;
use App\Http\Controllers\admin\CheckinController;
use App\Http\Controllers\admin\CommunicationLogController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\EmailTemplateController;
use App\Http\Controllers\admin\EquipmentController;
use App\Http\Controllers\admin\MemberController;
use App\Http\Controllers\admin\MemberEngagementController;
use App\Http\Controllers\admin\MembershipPlanController;
use App\Http\Controllers\admin\MemberSubscriptionController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\RFIDController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\TrainerController;
use App\Http\Controllers\admin\VnpayController;
use App\Http\Controllers\Auth\LoginTokenController;
use Illuminate\Support\Facades\Route;

// Default route
Route::get('/', function () {
    return redirect()->route('login');
});

// Home route for authenticated users (target for guest middleware)
Route::get('/home', function() {
    return redirect()->route('admin.dashboard.index');
})->name('home')->middleware('auth');

// Routes for guest users (not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginTokenController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginTokenController::class, 'sendLoginToken'])->name('login.send');
    Route::get('/login/{token}', [LoginTokenController::class, 'login'])->name('login.callback');
});

// Route for authenticated users to log out
Route::post('/logout', [LoginTokenController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Member routes
    Route::prefix('member')->name('members.')->group(function () {
        Route::get('/index', [MemberController::class, 'index'])->name('index');
        Route::get('/create', [MemberController::class, 'create'])->name('create');
        Route::post('/store', [MemberController::class, 'store'])->name('store');
        Route::get('/{member}/edit', [MemberController::class, 'edit'])->name('edit');
        Route::put('/{member}/update', [MemberController::class, 'update'])->name('update');
        Route::get('/{member}/show', [MemberController::class, 'show'])->name('show');
        Route::delete('/{member}', [MemberController::class, 'destroy'])->name('destroy');
        Route::get('/deleted', [MemberController::class, 'deleted'])->name('deleted');
        Route::post('/{member}/restore', [MemberController::class, 'restore'])->name('restore')->withTrashed();
    });

    Route::resource('membership-plans', MembershipPlanController::class);

    // Member Subscription routes
    Route::prefix('subscriptions')->name('subscriptions.')->group(function () {
        Route::get('/create', [MemberSubscriptionController::class, 'create'])->name('create');
        Route::post('/store', [MemberSubscriptionController::class, 'store'])->name('store');
    });

    // RFID routes
    Route::prefix('rfid')->name('rfid.')->group(function () {
        Route::get('/', [RFIDController::class, 'index'])->name('index');
        Route::put('/{id}', [RFIDController::class, 'update'])->name('update');
        Route::delete('/{id}', [RFIDController::class, 'destroy'])->name('destroy');
    });

    // Equipment routes
    Route::prefix('equipment')->name('equipment.')->group(function () {
        Route::get('/', [EquipmentController::class, 'index'])->name('index');
        Route::get('/create', [EquipmentController::class, 'create'])->name('create');
        Route::post('/', [EquipmentController::class, 'store'])->name('store');
        Route::post('/update', [EquipmentController::class, 'update'])->name('update');
        Route::delete('/{equipment}', [EquipmentController::class, 'destroy'])->name('destroy');
    });

    // trainers routes
    Route::prefix('trainers')->name('trainers.')->group(function () {
        Route::get('/', [TrainerController::class, 'index'])->name('index');
        Route::get('/create', [TrainerController::class, 'create'])->name('create');
        Route::post('/', [TrainerController::class, 'store'])->name('store');
        Route::get('/{trainer}/edit', [TrainerController::class, 'edit'])->name('edit');
        Route::put('/{trainer}', [TrainerController::class, 'update'])->name('update');
        Route::delete('/{trainer}', [TrainerController::class, 'destroy'])->name('destroy');
    });

    // Checkin routes
    Route::prefix('checkin')->name('checkin.')->group(function () {
        Route::post('/{checkin}/force-checkout', [CheckinController::class, 'forceCheckout'])->name('forceCheckout');
        Route::post('/force-checkout-all', [CheckinController::class, 'forceCheckoutAll'])->name('forceCheckoutAll');
        Route::get('/page', [CheckinController::class, 'checkinPage'])->name('checkinPage');
        Route::get('/index', [CheckinController::class, 'index'])->name('index');
        Route::post('/machine', [CheckinController::class, 'machineCheckin'])->name('machine');
    });

    Route::get('/engagement', [MemberEngagementController::class, 'index'])->name('engagement.index');
    Route::post('/engagement/send', [MemberEngagementController::class, 'send'])->name('engagement.send');

    Route::resource('email-templates', EmailTemplateController::class);

    Route::get('communication-logs', [CommunicationLogController::class, 'index'])->name('communication-logs.index');
    Route::get('communication-logs/{log}', [CommunicationLogController::class, 'show'])->name('communication-logs.show');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

    Route::resource('article-categories', ArticleCategoryController::class);
    Route::resource('articles', ArticleController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::post('/contacts/{contact}/resolve', [ContactController::class, 'resolve'])->name('contacts.resolve');
    Route::post('/contacts/{contact}/unresolve', [ContactController::class, 'unresolve'])->name('contacts.unresolve');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('/contacts/reply', [ContactController::class, 'reply'])->name('contacts.reply');

    Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::patch('testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
});

// Publicly accessible routes
Route::get('/vnpay/return', [VnpayController::class, 'handleReturn'])->name('vnpay.return');
