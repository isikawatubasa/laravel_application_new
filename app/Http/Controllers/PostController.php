<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;  //Postモデルを使う
use App\Post;                       //削除していました。mm
use Illuminate\Support\Facades\Auto;//ログイン機能を使う
class PostController extends Controller
{
    public function index()//投稿一覧画面表示
    {
        $posts = Post::all();//モデルから投稿を全件取得として表示する
        return view('posts.index', ['posts' => $posts]);//取得したデータをビューに変数として渡す
    }

    public function create()//登録画面表示（投稿）
    {
        return view('posts.create');//create.blade.phpを表示する（これを作成）
    }

    public function store(PostRequest $request)//登録処理（投稿）
    {
        $post = new post;//postのインスタンスを生成//ユーザーが入力したリクエストの情報を格納していく
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id();//Auth::id()でログインユーザーのIDが取得できる
        $post->save();//インスタンスをDBのレコードとして保存
        return redirect()->route('post.index');//投稿一覧画面にれダイレクトさせる
    }
}
