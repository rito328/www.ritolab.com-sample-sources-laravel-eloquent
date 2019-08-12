<?php

namespace App\Observers;

use App\Models\Framework;
use Illuminate\Support\Facades\Log;
use App\Events\AccessDetection;

class FrameworkObserver
{
    /**
     * モデル取得イベントのリッスン
     *
     * @param  \App\Models\Framework  $Framework
     * @return void
     */
    public function retrieved(Framework $Framework)
    {
        // ログの書き込み
        Log::debug($Framework->name);
        // イベント発火
        event(new AccessDetection(str_random(100)));
    }

    /**
     * 作成イベントのリッスン
     *
     * @param  \App\Models\Framework  $Framework
     * @return void
     */
    public function created(Framework $Framework)
    {
        //
    }

    /**
     * 作成イベントのリッスン
     *
     * @param  \App\Models\Framework  $Framework
     * @return void
     */
    public function updated(Framework $Framework)
    {
        //
    }

    /**
     * 削除イベントのリッスン
     *
     * @param  \App\Models\Framework  $Framework
     * @return void
     */
    public function deleting(Framework $Framework)
    {
        //
    }
}
