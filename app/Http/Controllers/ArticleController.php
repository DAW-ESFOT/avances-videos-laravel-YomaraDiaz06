<?php


namespace App\Http\Controllers;
use App\Article;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Http\Request;


class ArticleController extends Controller
{

    private static $messages=[
        'requerid' => 'el campo :attribute es obligatorio',
        'body.requerid' =>'el body no es valido',
        ];

    public function index()
    {
        return new ArticleCollection(Article::paginate(3));
    }
    public function show(Article $article)
    {
        return response()->json(new ArticleResource($article));
    }
    public function store(Request $request)
    {

        $request->validate([
            'tittle' =>'required|string|unique:articles|max:255',
            'body' =>'required|string',
            'category_id' =>'required|exists:categories,id'
        ],self::$messages);

        $article = Article::create($request->all());
        return response()->json($article, 201);
    }
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        $request->validate([
            'tittle' =>'required|string|unique:articles,tittle,'.$article->id.'|max:255',
            'body' =>'required|string',
            'category_id' =>'required|exists:categories,id'
        ],self::$messages);
        $article->update($request->all());
        return response()->json($article, 200);
    }
    public function delete(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
