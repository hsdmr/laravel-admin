<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Link;
use App\Models\Option;
use App\Models\Page;
use App\Models\Slug;

class RouteController extends Controller
{
    public function route($url,$url2=null,$url3=null){
        $slug = Slug::firstWhere('slug','=',$url);
        if($slug==null) return view('404');
        else{
            $owner = $slug->owner;
            if($owner=='page'){
                $page = Page::firstWhere('slug_id','=',$slug->id);
                if($page->status==0) return view('404');
                else{
                    $template = $page->template;
                    if($template=='contact'){
                        $contact = Option::where('key','=','contact')->where('language','=','tr')->first();
                        return  view('contact',compact('contact','page'));
                    }
                    else if($template=='blog'){
                        $categories = Category::all();
                        $articles = Article::orderBy('created_at', 'desc')->where('status','=',1)->simplePaginate(8);
                        return  view('blog',compact('articles','page','categories'));
                    }
                    else if($template=='contract'){
                        $is_contract = false; // for remove menu and footer
                        return  view('contract',compact('is_contract','page'));
                    }
                    else if($template=='blank'){
                        $is_blank = false; //for remove headet and footer
                        return  view('blank',compact('is_blank','page'));
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
                if($article->status==0) return view('404');
                else return view('article',compact('article','categories'));
            }
        }
    }
}
