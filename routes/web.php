<?php

use App\Models\Page;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $page = Page::find(1);
    return view('index',compact('page'));
})->name('home');

Route::post('/ajax', [App\Http\Controllers\Admin\AjaxController::class, 'ajax'])->name('ajax')->middleware('isAdmin');

Route::get('/lang/{lang}', [App\Http\Controllers\LangController::class, 'lang'])->name('lang');

Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'loginCheck'])->name('login.check');
Route::get('/register', [App\Http\Controllers\LoginController::class, 'registerUser'])->name('register.user');
Route::post('/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {

    Route::get('/home', [App\Http\Controllers\LoginController::class, 'admin'])->name('home');
    Route::post('/media/storeMedia', [App\Http\Controllers\Admin\FileController::class, 'storeMedia'])->name('media.storeMedia');
    Route::resource('/media', 'App\Http\Controllers\Admin\FileController');
    Route::resource('/category', 'App\Http\Controllers\Admin\CategoryController');
    Route::resource('/slide', 'App\Http\Controllers\Admin\SlideController');

    Route::get('/article/switch', [App\Http\Controllers\Admin\ArticleController::class, 'switch'])->name('article.switch');
    Route::get('/article/trash', [App\Http\Controllers\Admin\ArticleController::class, 'trash'])->name('article.trash');
    Route::get('/article/delete/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'delete'])->name('article.delete');
    Route::get('/article/recover/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'recover'])->name('article.recover');
    Route::resource('/article', 'App\Http\Controllers\Admin\ArticleController');

    Route::get('/page/switch', [App\Http\Controllers\Admin\PageController::class, 'switch'])->name('page.switch');
    Route::get('/page/trash', [App\Http\Controllers\Admin\PageController::class, 'trash'])->name('page.trash');
    Route::get('/page/delete/{id}', [App\Http\Controllers\Admin\PageController::class, 'delete'])->name('page.delete');
    Route::get('/page/recover/{id}', [App\Http\Controllers\Admin\PageController::class, 'recover'])->name('page.recover');
    Route::resource('/page', 'App\Http\Controllers\Admin\PageController');

    Route::get('/comment/switch', [App\Http\Controllers\Admin\CommentController::class, 'switch'])->name('comment.switch');
    Route::get('/comment/trash', [App\Http\Controllers\Admin\CommentController::class, 'trash'])->name('comment.trash');
    Route::get('/comment/delete/{id}', [App\Http\Controllers\Admin\CommentController::class, 'delete'])->name('comment.delete');
    Route::get('/comment/recover/{id}', [App\Http\Controllers\Admin\CommentController::class, 'recover'])->name('comment.recover');
    Route::resource('/comment', 'App\Http\Controllers\Admin\CommentController');

    Route::get('/user/trash', [App\Http\Controllers\Admin\UserController::class, 'trash'])->name('user.trash');
    Route::get('/user/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('user.delete');
    Route::get('/user/recover/{id}', [App\Http\Controllers\Admin\UserController::class, 'recover'])->name('user.recover');
    Route::resource('/user', 'App\Http\Controllers\Admin\UserController');

    Route::prefix('/tutor')->name('tutor.')->group(function(){
        Route::resource('/category', 'App\Http\Controllers\Admin\TutorCategoryController');
        Route::resource('/course', 'App\Http\Controllers\Admin\TutorCourseController');
        Route::resource('/student', 'App\Http\Controllers\Admin\TutorStudentController');
        Route::resource('/announcement', 'App\Http\Controllers\Admin\TutorAnnouncementController');
        Route::get('/course/{course}/delete}', [App\Http\Controllers\Admin\TutorCourseController::class, 'destroy'])->name('course.delete');
        Route::get('/course/{course}/topic/{topic}', [App\Http\Controllers\Admin\TutorLessonController::class, 'create'])->name('lesson.create');
        Route::get('/lesson/{lesson}', [App\Http\Controllers\Admin\TutorLessonController::class, 'edit'])->name('lesson.edit');
        Route::post('/lesson/{lesson}', [App\Http\Controllers\Admin\TutorLessonController::class, 'update'])->name('lesson.update');
        Route::get('/lesson/{lesson}/delete', [App\Http\Controllers\Admin\TutorLessonController::class, 'delete'])->name('lesson.delete');
        Route::post('/course/{course}/topic/{topic}', [App\Http\Controllers\Admin\TutorLessonController::class, 'store'])->name('lesson.store');
        Route::get('/course/{course}/topic/{topic}/zoom', [App\Http\Controllers\Admin\TutorZoomController::class, 'create'])->name('zoom.create');
        Route::get('/zoom', [App\Http\Controllers\Admin\TutorZoomController::class, 'index'])->name('zoom.index');
        Route::get('/zoom/{lesson}', [App\Http\Controllers\Admin\TutorZoomController::class, 'edit'])->name('zoom.edit');
        Route::post('/zoom/{lesson}', [App\Http\Controllers\Admin\TutorZoomController::class, 'update'])->name('zoom.update');
        Route::get('/zoom/{lesson}/delete', [App\Http\Controllers\Admin\TutorZoomController::class, 'delete'])->name('zoom.delete');
        Route::post('/course/{course}/topic/{topic}/zoom', [App\Http\Controllers\Admin\TutorZoomController::class, 'store'])->name('zoom.store');
    });

    Route::prefix('/option')->name('option.')->group(function(){
        Route::get('/index', [App\Http\Controllers\Admin\OptionController::class, 'index'])->name('index');
        Route::post('/update', [App\Http\Controllers\Admin\OptionController::class, 'update'])->name('update');

        Route::get('/contact', [App\Http\Controllers\Admin\OptionController::class, 'contact'])->name('contact');
        Route::post('/contactUpdate', [App\Http\Controllers\Admin\OptionController::class, 'contactUpdate'])->name('contactUpdate');

        Route::get('/social', [App\Http\Controllers\Admin\OptionController::class, 'social'])->name('social');
        Route::post('/socialUpdate', [App\Http\Controllers\Admin\OptionController::class, 'socialUpdate'])->name('socialUpdate');

        Route::get('/menu/position', [App\Http\Controllers\Admin\MenuController::class, 'position'])->name('menu.position');
        Route::get('/menu/delete/{menu}', [App\Http\Controllers\Admin\MenuController::class, 'delete'])->name('menu.delete');
        Route::post('/menu/menu-name', [App\Http\Controllers\Admin\MenuController::class, 'menuName'])->name('menu.menuName');
        Route::resource('/menu', 'App\Http\Controllers\Admin\MenuController');

        Route::get('/widget', [App\Http\Controllers\Admin\OptionController::class, 'widget'])->name('widget');
        Route::post('/widgetUpdate', [App\Http\Controllers\Admin\OptionController::class, 'widgetUpdate'])->name('widgetUpdate');

        Route::resource('/redirect', 'App\Http\Controllers\Admin\RedirectController');
        Route::resource('/link', 'App\Http\Controllers\Admin\LinkController');
    });
});

Route::get('/{url}/{url2?}/{url3?}/', [App\Http\Controllers\RouteController::class, 'route'])->middleware('slashes')->middleware('redirect')->name('route');

