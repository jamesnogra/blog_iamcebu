<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Crypt;
use Auth;
use App\Article;
use App\Comment;

class ArticleController extends Controller
{
    public function index($start=0)
    {
        $selectedArticles = Article::orderBy('id', 'desc')->paginate(5);
        return view('articles.index', ['articles'=>$selectedArticles]);
    }

    public function viewArticle($code=null, $title=null)
    {
        $article = Article::where('code', $code)->first();
        $comments = Comment::where('article_id', $article->id)->orderBy('id', 'desc')->get();
        return view('articles.view-article', ['article'=>$article, 'comments'=>$comments]);
    }

    public function viewArticlesWithTag($tag) {
        $selectedArticles = Article::where('tags', 'like', '%'.$tag.'%')->orderBy('id', 'desc')->paginate(5);
        return view('articles.index', ['articles'=>$selectedArticles]);
    }

    public function myArticles()
    {
        $userParam = Auth::user();
        $myArticles = Article::where('author_id', $userParam->id)->get();
        return view('articles.my-articles', ['articles'=>$myArticles]);
    }

    public function createArticle($code=null)
    {
        if (!is_null($code)) {
            $editArticle = Article::where('code', $code)->first();
            if (!empty($editArticle->password)) {
                $editArticle->password = Crypt::decrypt($editArticle->password);
            }
            return view('articles.edit-article', ['article'=>$editArticle]);
        } else {
            return view('articles.create-article');
        }
    }

    public function postCreateArticle(Request $request)
    {
        $titleParam = $request->input('title');
        $contentParam = $request->input('content');
        $tagsParam = $request->input('tags');
        $passwordParam = $request->input('password');
        $userParam = Auth::user();
        if (!empty($passwordParam)) {
            $passwordParam = Crypt::encrypt($passwordParam);
        }

        $newArticle = new Article;
        $newArticle->code = str_random(8);
        $newArticle->author_id = $userParam->id;
        $newArticle->title = $titleParam;
        $newArticle->content = $contentParam;
        $newArticle->tags = $tagsParam;
        $newArticle->password = $passwordParam;
        $newArticle->save();

        return redirect()->action('ArticleController@myArticles');
    }

    public function postEditArticle(Request $request)
    {
        $titleParam = $request->input('title');
        $contentParam = $request->input('content');
        $tagsParam = $request->input('tags');
        $passwordParam = $request->input('password');
        $idParam = $request->input('id');
        $codeParam = $request->input('code');
        $authorIdParam = $request->input('author_id');
        $userParam = Auth::user();
        if ($authorIdParam != $userParam->id) {
            abort(403, "Unauthorized action. You don't own this article.");
        }
        if (!empty($passwordParam)) {
            $passwordParam = Crypt::encrypt($passwordParam);
        }

        $editArticle = Article::where('id', $idParam)->where('code', $codeParam)->first();
        $editArticle->title = $titleParam;
        $editArticle->content = $contentParam;
        $editArticle->tags = $tagsParam;
        $editArticle->password = $passwordParam;
        $editArticle->save();

        return redirect()->action('ArticleController@myArticles');
    }

    public function deleteArticle($code, $id)
    {
        $userParam = Auth::user();
        Article::where('code', $code)->where('id', $id)->where('author_id', $userParam->id)->delete();
        return redirect()->action('ArticleController@myArticles');
    }
}