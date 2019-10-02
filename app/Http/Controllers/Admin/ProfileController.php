<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでProfile Modelが扱えるようになる
use App\Profile;

class ProfileController extends Controller
{
    //
     public function add()
  {
      return view('admin.profile.create');
  }

  public function create(Request $request)
  {
      
  // 以下を追記
      // Varidationを行う
      $this->validate($request, Profile::$rules);
    
    $profile = new Profile;
    $form = $request->all();
    

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
  
    
    
    $profile->name=$form['name'];
    $profile->gender=$form['gender'];
    $profile->hobby=$form['hobby'];
    $profile->introduction=$form['introduction'];
    $profile->save();
    
    
      return redirect('admin/profile/create');
  }

// 以下を追記
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Profile::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }


}
