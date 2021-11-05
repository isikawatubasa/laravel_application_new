<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;  //Postモデルを使う
use App\Post;                       //削除していました。mm
use Illuminate\Support\Facades\Auth;//ログイン機能を使う  //タイプミスmm
class PostController extends Controller
{
    public function index()//投稿一覧画面表示
    {
        $posts = Post::all();//モデルから投稿を全件取得として表示する
        return view('posts.index', ['posts' => $posts]);//取得したデータをビューに変数として渡す
    }

    public function create()//登録画面表示（投稿）
    {
        dd('「投稿画面だよ！」');   //課題11
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

    public function show($id)
    {
        $post = Post::findOrFail($id);    // 投稿データのIDでモデルから投稿を1件取得
        return view('posts.show', ['post' => $post]); // show.blade.phpを表示する(これから作成)
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);  //投稿データのIDでモデルから投稿を1件取得
        if ($post->user_id !== Auth::id()) {  //投稿者以外の編集を防ぐ
            return redirect('/');
        }
        dd($post);   //課題11
        return view('posts.edit', ['post' => $post]);  //edit.blade.phpを表示する（これから作成）
        //dd($post);   //課題11　修正
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);  //投稿データのIDでモデルから投稿を1件取得
        if ($post->user_id !== Auth::id()) {  //投稿者以外の更新を防ぐ
            return redirect('/');
        }
        $post->title = $request->title;  //編集者画面から受け取ったデータをインスタンスに反映
        $post->body = $request->body;
        $post->save();  //DBのレコードを更新
        return redirect('/');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            return redirect('/');
        }
        $post->delete();
        return redirect('/');
    }
}
