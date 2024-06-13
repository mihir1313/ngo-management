<?php



Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['guest:admin']], function () {

    // login

    Route::get('/login', [App\Http\Controllers\admin\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\admin\AuthController::class, 'dologin'])->name('dologin');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth:admin']], function () {

    // logout

    Route::get('/logout', [App\Http\Controllers\admin\AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [App\Http\Controllers\admin\DashbordController::class, 'index'])->name('dashboard');





    // Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'list'])->name('product.list');
    // Route::any('/product/save', [App\Http\Controllers\Admin\ProductController::class, 'save'])->name('product.save');
    // Route::any('/product/delete', [App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product.delete');
    // Route::any('/product/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');

    // users

    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.view');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'list'])->name('user.list');
    Route::post('/user/save', [App\Http\Controllers\Admin\UserController::class, 'save'])->name('user.save');
    Route::post('/user/delete', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('user.delete');
    Route::post('/user/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');

    Route::get('/causes', [App\Http\Controllers\Admin\CausesController::class, 'index'])->name('causes.view');
    Route::post('/causes/list', [App\Http\Controllers\Admin\CausesController::class, 'causesList'])->name('causes.list');
    Route::post('/causes/save', [App\Http\Controllers\Admin\CausesController::class, 'save'])->name('causes.save');
    Route::post('/causes/edit', [App\Http\Controllers\Admin\CausesController::class, 'edit'])->name('causes.edit');
    Route::post('/causes/delete', [App\Http\Controllers\Admin\CausesController::class, 'delete'])->name('causes.delete');



    // Category

    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.view');
    Route::post('/category', [App\Http\Controllers\Admin\CategoryController::class, 'list'])->name('category.list');
    Route::post('/category/save', [App\Http\Controllers\Admin\CategoryController::class, 'save'])->name('category.save');
    Route::post('/category/delete', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete');
    Route::post('/category/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');



    Route::get('/contact', [App\Http\Controllers\Admin\VolunteerController::class, 'contact'])->name('contact');
    Route::post('/contact/list', [App\Http\Controllers\Admin\VolunteerController::class, 'contactList'])->name('contact.list');
    Route::get('/volunteer', [App\Http\Controllers\Admin\VolunteerController::class, 'index'])->name('volunteer.view');
    Route::post('/volunteer', [App\Http\Controllers\Admin\VolunteerController::class, 'list'])->name('volunteer.list');
    Route::post('/volunteer/save', [App\Http\Controllers\Admin\VolunteerController::class, 'save'])->name('volunteer.save');
    Route::post('/volunteer/delete', [App\Http\Controllers\Admin\VolunteerController::class, 'delete'])->name('volunteer.delete');
    Route::post('/volunteer/edit', [App\Http\Controllers\Admin\VolunteerController::class, 'edit'])->name('volunteer.edit');

    // Brand

    Route::get('/brand', [App\Http\Controllers\Admin\BrandControlle::class, 'index'])->name('brand.view');
    Route::post('/brand', [App\Http\Controllers\Admin\BrandControlle::class, 'list'])->name('brand.list');
    Route::post('/brand/save', [App\Http\Controllers\Admin\BrandControlle::class, 'save'])->name('brand.save');
    Route::post('/brand/delete', [App\Http\Controllers\Admin\BrandControlle::class, 'delete'])->name('brand.delete');
    Route::post('/brand/edit', [App\Http\Controllers\Admin\BrandControlle::class, 'edit'])->name('brand.edit');


    // products
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.view');
    Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'list'])->name('product.list');
    Route::post('/product/save', [App\Http\Controllers\Admin\ProductController::class, 'save'])->name('product.save');
    Route::post('/product/delete', [App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product.delete');
    Route::post('/product/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');

    // product images
    Route::get('/product/images/{id}', [App\Http\Controllers\Admin\ProductImageController::class, 'index'])->name('product.image.view');
    Route::post('/product/image/save', [App\Http\Controllers\Admin\ProductImageController::class, 'save'])->name('product.image.save');
    Route::post('/product/images', [App\Http\Controllers\Admin\ProductImageController::class, 'list'])->name('product.image.list');
    Route::post('/product/image/delete', [App\Http\Controllers\Admin\ProductImageController::class, 'delete'])->name('product.image.delete');


    //  Orders
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'orders'])->name('orders');
    Route::post('/orders', [App\Http\Controllers\Admin\OrderController::class, 'list'])->name('orders.list');




    Route::get('/orders/items/{id}', [App\Http\Controllers\Admin\OrderItemController::class, 'orders_items'])->name('orders.items');

    Route::post('/orders/items', [App\Http\Controllers\Admin\OrderItemController::class, 'orders_list'])->name('orders.items.list');
});
