<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller 
{
    public function index()
    {
        $articles = Article::paginate();
        return view('article.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    public function store (UpdateArticleRequest $request)
    {
        // Проверка введенных данных
        // Если будут ошибки, то возникнет исключение
        // Иначе возвращаются данные формы
        $data = $request->validated();

        $article = new Article();
        // Заполнение статьи данными из формы
        $article->fill($data);
        // При ошибках сохранения возникнет исключение
        $article->save();

        // Редирект на указанный маршрут
        return redirect()
            ->route('articles.index')->with('uccess', 'Article created');
    }

    public function create()
    {
        $article = new Article();
        return view('article.create', compact('article'));
    }

    public function edit($id)
    {
    $article = Article::findOrFail($id);
    return view('article.edit', compact('article'));
    }
    
    public function update(UpdateArticleRequest $request, $id)
    {
    $article = Article::findOrFail($id);
    $data = $request->validated();

    $article->fill($data);
    $article->save();
    return redirect()
        ->route('articles.index')->with('success', 'статья отредактирована');
    }

    public function destroy($id)
    {
    // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
    Article::where('id', $id)->firstOrFail()->delete();
   
    return redirect()->route('articles.index')->with('success', 'article deleted');
    }
}

