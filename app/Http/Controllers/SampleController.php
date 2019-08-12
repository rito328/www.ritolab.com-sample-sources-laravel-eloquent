<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Framework;

use App\Events\AccessDetection;

class SampleController extends Controller
{
    public function index()
    {
        // 全てのデータを取得する
        $data = Framework::all();


        // category = PHP のデータを取得する
        $data = Framework::where('category', 'PHP')->get();


        // id が 10 未満のデータを取得する
        $data = Framework::where('id', '<',  10)->get();


        // id = 1 のレコードを取得する
        $data = Framework::find(1);


        // 1件のレコードを挿入する
        $fw = new Framework();
        $fw->name = "D3";
        $fw->category = "Javascript";
        $fw->save();


        // create()によるレコード挿入
        Framework::create([
            'name' => 'Ice Framework',
            'category' => 'PHP'
        ]);


        // レコード更新
        // id=24 のレコードを取得
        $target = Framework::find(12);
        // nameカラムを変更
        $target->name = "D3.js";
        // 更新
        $target->save();


        // category が 'Javascript' のレコードを 'JS' へ更新する
        Framework::where('category', 'Javascript')
                 ->update(['category' => 'JS']);


        // firstOrCreate
        $data = Framework::firstOrCreate(
                    ['name' => 'Laravel'],
                    ['category' => 'PHP']
                );


        // firstOrNew
        $data = Framework::firstOrNew(
                    ['name' => 'Kohana'],
                    ['category' => 'PHP']
                );
        // 保存
        $data->save();


        // updateOrCreate
        Framework::updateOrCreate(
            ['name' => 'React', 'category' => 'JS'],
            ['category' => 'Javascript']
        );


        // delete
        // id=29 のレコードを取得
        $model = Framework::find(6);
        // 削除
        $model->delete();


        // 条件式で複数取得＋deleteメソッドをチェインして削除
        Framework::where('category', 'JS')->delete();


        // １件の削除
        Framework::destroy(27);


        // 複数件まとめて削除 - 1（配列で渡す）
        Framework::destroy([23, 25, 26]);


        // 複数件まとめて削除 - 2（１つずつ渡す）
        Framework::destroy(20, 21, 22);


        $data = Framework::all();
        // =>  SELECT * FROM `frameworks` WHERE `category` = 'PHP';


        // グローバルスコープをスキップ
        $data = Framework::withoutGlobalScope(\App\Scopes\CategoryScope::class)->get();


        // 複数のグローバルスコープをスキップ
        $data = Framework::withoutGlobalScopes([
            \App\Scopes\OneScope::class, \App\Scopes\TwoScope::class
        ])->get();


        // 全てのグローバルスコープをスキップ
        $data = Framework::withoutGlobalScopes()->get();


        // CategoryInPhpスコープを適用する
        $data = Framework::CategoryInPhp()->get();


        // CategoryInPhpスコープとCategoryInPythonスコープの両方を適用する
        $data = Framework::CategoryInPhp()->CategoryInPython()->get();


        // 取得したいカテゴリを配列で渡す
        $data = Framework::CategoryInSomething(['PHP', 'Javascript'])->get();
    }
}
