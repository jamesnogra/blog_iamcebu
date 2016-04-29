<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\Comment;
use Auth;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function postComment(Request $request)
    {
        if (!$this->checkSession($request)) {
            abort(403, "Unauthorized action. Please wait for a few moments before posting another comment.");
        }
        $articleIdParam = $request->input('id');
        $articleCodeParam = $request->input('code');
        $authorIdParam = $request->input('author_id');
        $nameParam = $request->input('name');
        $websiteParam = $request->input('website');
        $commentParam = strip_tags($request->input('comment'));

        $checkArticle = Article::where('id', $articleIdParam)
            ->where('code', $articleCodeParam)
            ->where('author_id', $authorIdParam)
            ->first();

        if (empty($checkArticle)) {
            abort(403, "Unauthorized action.");
        }

        $newComment = new Comment;
        $newComment->code = str_random(32);
        $newComment->article_id = $articleIdParam;
        $newComment->name = $nameParam;
        $newComment->website = $websiteParam;
        $newComment->comment = $commentParam;
        $newComment->save();

        return redirect()->action('ArticleController@viewArticle', ['code'=>$checkArticle->code, 'title'=>$checkArticle->title]);
    }

    public function deleteComment($code, $id) {
        $checkComment = Comment::where('code', $code)->where('id', $id)->first();
        if (empty($checkComment)) {
            abort(403, "Unauthorized action.");
        }
        $userParam = Auth::user();
        $checkArticle = Article::where('id', $checkComment->article_id)->where('author_id', $userParam->id)->first();
        if (empty($checkArticle)) {
            abort(403, "Unauthorized action.");
        }
        Comment::where('code', $code)->where('id', $id)->delete();

        return redirect()->action('ArticleController@viewArticle', ['code'=>$checkArticle->code, 'title'=>$checkArticle->title]);
    }

    private function checkSession(Request $request) {
        $now = Carbon::now();
        $lengthExpiry = 30;
        if (!empty($request->session()->get('expiry'))) {
            $tempExpiry = $request->session()->get('expiry');
            if ($now->gt($tempExpiry)) {
                $request->session()->put('expiry', $now->addSeconds($lengthExpiry));
                return true;
            } else {
                return false;
            }
        } else {
            $request->session()->put('expiry', $now->addSeconds($lengthExpiry));
            return true;
        }
    }
}
