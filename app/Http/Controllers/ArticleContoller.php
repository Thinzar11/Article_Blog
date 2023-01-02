<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class ArticleContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','detail']);
    }
    public function index()
    {
        $data = Article::latest()->paginate(5);

        return view('articles.index', [
            'articles' =>$data
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view('articles.detail',[
            'article' => $article
        ]);
    }

    public function delete($id)
    {

        $article = Article::find($id);
        if(Gate::allows('article-delete', $article)){
            $article->delete();
            return redirect('/articles')->with('info','An article deleted');
        }
        return back()->with("info","Unthorize to delete");
    }

    public function add()
    {
        $article = Article::all();
        $category = Category::all();
        return view('articles.add',[
            'articles' => $article,
            'categories' => $category
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(),[
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();
        return redirect('/articles');
    }

    public function edit($id){
        $category = Category::All();
        $user = User::All();
        $article = Article::find($id);
        return view('articles.edit',[
            'article' => $article,
            'category' => $category,
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $validator = validator(request()->all(),[
            "title" => "required",
            "body" => "required",

        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = Article::find($id);
        $data->title = request()->title;
        $data->body = request()->body;
        $data->category_id = request()->category_id;
        $data->user_id = auth()->user()->id;
        $data->save();
        // detail_id
        return redirect('/articles')->with("info","A message created");
    }
}
