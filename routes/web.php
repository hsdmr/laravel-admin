<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Slug;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $page = Page::find(1);
    return view('index',compact('page'));
})->name('home');

Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/giris', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/giris', [App\Http\Controllers\LoginController::class, 'loginCheck'])->name('login.check');
Route::get('/kayit-uye', [App\Http\Controllers\LoginController::class, 'registerUser'])->name('register.user');
Route::post('/kayit', [App\Http\Controllers\LoginController::class, 'register'])->name('register');

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {

    Route::get('/home', [App\Http\Controllers\LoginController::class, 'admin'])->name('home');
    Route::post('/media/storeMedia', [App\Http\Controllers\Admin\FileController::class, 'storeMedia'])->name('media.storeMedia');
    Route::resource('/media', 'App\Http\Controllers\Admin\FileController');
    Route::resource('/category', 'App\Http\Controllers\Admin\CategoryController');

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

    Route::prefix('/setting')->name('setting.')->group(function(){
        Route::get('/index', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('index');
        Route::post('/update', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('update');

        Route::get('/contact', [App\Http\Controllers\Admin\SettingController::class, 'contact'])->name('contact');
        Route::post('/contactUpdate', [App\Http\Controllers\Admin\SettingController::class, 'contactUpdate'])->name('contactUpdate');

        Route::get('/social', [App\Http\Controllers\Admin\SettingController::class, 'social'])->name('social');
        Route::post('/socialUpdate', [App\Http\Controllers\Admin\SettingController::class, 'socialUpdate'])->name('socialUpdate');

        Route::get('/menu/position', [App\Http\Controllers\Admin\MenuController::class, 'position'])->name('menu.position');
        Route::get('/menu/delete/{id}', [App\Http\Controllers\Admin\MenuController::class, 'delete'])->name('menu.delete');
        Route::resource('/menu', 'App\Http\Controllers\Admin\MenuController');

        Route::get('/widget', [App\Http\Controllers\Admin\SettingController::class, 'widget'])->name('widget');
        Route::post('/widgetUpdate', [App\Http\Controllers\Admin\SettingController::class, 'widgetUpdate'])->name('widgetUpdate');
    });
});

Route::get('/{url}/{url2?}/{url3?}', function ($url,$url2=null,$url3=null) {
    $slug = Slug::firstWhere('slug','=',$url);
    if($slug==null) return view('404');
    else{
        $owner = $slug->owner;
        if($owner=='page'){
            $page = Page::firstWhere('slug_id','=',$slug->id);
            if($page->statu==0) return view('404');
            else{
                $template = $page->template;
                if($template=='iletisim'){
                    $contact = Contact::find(1);
                    return  view('contact',compact('contact','page'));
                }
                else if($template=='blog'){
                    $categories = Category::all();
                    $articles = Article::orderBy('created_at', 'desc')->where('statu','=',1)->simplePaginate(8);
                    return  view('blog',compact('articles','page','categories'));
                }
                else
                return  view('page',compact('page'));
            }
        }
        if($owner=='category'){
            $categories = Category::all();
            $category = Category::firstWhere('slug_id','=',$slug->id);
            $articles = Article::orderBy('created_at', 'desc')->where('category_id','=',$category->id)->simplePaginate(8);
            return  view('category',compact('articles','category','categories'));
        }
        if($owner=='article'){
            $categories = Category::all();
            $article = Article::firstWhere('slug_id','=',$slug->id);
            if($article->statu==0) return view('404');
            else return view('article',compact('article','categories'));
        }
    }
})->name('front');
