<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Link;
use App\Models\Option;
use App\Models\Page;
use App\Models\Slug;
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
        Route::get('/course/{course}/delete}', [App\Http\Controllers\Admin\TutorCourseController::class, 'destroy'])->name('course.delete');
        Route::get('/course/{course}/topic/{topic}', [App\Http\Controllers\Admin\TutorLessonController::class, 'create'])->name('lesson.create');
        Route::get('/lesson/{lesson}', [App\Http\Controllers\Admin\TutorLessonController::class, 'edit'])->name('lesson.edit');
        Route::post('/lesson/{lesson}', [App\Http\Controllers\Admin\TutorLessonController::class, 'update'])->name('lesson.update');
        Route::get('/lesson/{lesson}/delete', [App\Http\Controllers\Admin\TutorLessonController::class, 'delete'])->name('lesson.delete');
        Route::post('/course/{course}/topic/{topic}', [App\Http\Controllers\Admin\TutorLessonController::class, 'store'])->name('lesson.store');
        Route::get('/course/{course}/topic/{topic}/zoom', [App\Http\Controllers\Admin\TutorZoomController::class, 'create'])->name('zoom.create');
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
        Route::get('/menu/delete/{id}', [App\Http\Controllers\Admin\MenuController::class, 'delete'])->name('menu.delete');
        Route::resource('/menu', 'App\Http\Controllers\Admin\MenuController');

        Route::get('/widget', [App\Http\Controllers\Admin\OptionController::class, 'widget'])->name('widget');
        Route::post('/widgetUpdate', [App\Http\Controllers\Admin\OptionController::class, 'widgetUpdate'])->name('widgetUpdate');

        Route::resource('/redirect', 'App\Http\Controllers\Admin\RedirectController');
        Route::resource('/link', 'App\Http\Controllers\Admin\LinkController');
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
                if($template=='contact'){
                    $contact = Option::where('name','=','contact')->where('language','=','tr')->first();
                    return  view('contact',compact('contact','page'));
                }
                else if($template=='blog'){
                    $categories = Category::all();
                    $articles = Article::orderBy('created_at', 'desc')->where('statu','=',1)->simplePaginate(8);
                    return  view('blog',compact('articles','page','categories'));
                }
                else
                $linker = Link::all();
                $word = array();
                $to_url = array();
                foreach($linker as $link){
                    array_push($word, '/'.$link->word.'/');
                    array_push($to_url, '<a title="'.$link->word.'" href="'.$link->url.'">'.$link->word.'</a>');
                }
                $page->content = preg_replace($word, $to_url, $page->content, 1);
                return  view('page',compact('page'));
            }
        }
        if($owner=='article-category'){
            $categories = Category::all();
            $category = Category::firstWhere('slug_id','=',$slug->id);
            $articles = Article::orderBy('created_at', 'desc')->where('category_id','=',$category->id)->simplePaginate(8);
            return  view('category',compact('articles','category','categories'));
        }
        if($owner=='article'){
            $categories = Category::all();
            $article = Article::firstWhere('slug_id','=',$slug->id);
            $linker = Link::all();
            $word = array();
            $to_url = array();
            foreach($linker as $link){
                array_push($word, '/'.$link->word.'/');
                array_push($to_url, '<a title="'.$link->word.'" href="'.$link->url.'">'.$link->word.'</a>');
            }
            $article->content = preg_replace($word, $to_url, $article->content, 1);
            if($article->statu==0) return view('404');
            else return view('article',compact('article','categories'));
        }
    }
})->middleware('slashes')->middleware('redirect')->name('front');
