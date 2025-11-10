<?php

use App\Http\Livewire\Admin\Collections\Index as AdminCollectionsIndex;
use App\Http\Livewire\Admin\Customers\Index as AdminCustomersIndex;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Orders\Index as AdminOrdersIndex;
use App\Http\Livewire\Admin\Products\Index as AdminProductsIndex;
use App\Http\Livewire\CheckoutPage;
use App\Http\Livewire\CheckoutSuccessPage;
use App\Http\Livewire\CollectionPage;
use App\Http\Livewire\Home;
use App\Http\Livewire\ProductPage;
use App\Http\Livewire\SearchPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Home::class);

Route::get('/collections/{slug}', CollectionPage::class)->name('collection.view');

Route::get('/products/{slug}', ProductPage::class)->name('product.view');

Route::get('search', SearchPage::class)->name('search.view');

Route::get('checkout', CheckoutPage::class)->name('checkout.view');

Route::get('checkout/success', CheckoutSuccessPage::class)->name('checkout-success.view');

// Admin Routes
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/products', AdminProductsIndex::class)->name('products.index');
    Route::get('/orders', AdminOrdersIndex::class)->name('orders.index');
    Route::get('/collections', AdminCollectionsIndex::class)->name('collections.index');
    Route::get('/customers', AdminCustomersIndex::class)->name('customers.index');
});
