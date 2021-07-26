<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //追加

class BoughtItemsController extends Controller
{
    public function showBoughtItems()
    {
        $user = Auth::user();

        /*
        * ネストしたリレーションメソッドを使用する時はドット記法でつなぐ
        * ドットの前で記述したリレーションメソッドも動的プロパティーとして持つことができる
        */
        $items = $user->boughtItems()
        ->with('secondaryCategory.primaryCategory') // 変更
        ->orderBy('id', 'DESC')
        ->get();

        return view('mypage.bought_items')
            ->with('items', $items);
    }
}
