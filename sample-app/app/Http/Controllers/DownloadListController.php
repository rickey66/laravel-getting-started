<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DownloadListController extends Controller
{
    //prのテストのためコメントを追加してみました
    public function index(Request $request) {
        $data_type = 1;
        $ad_apps = DB::table('ad_apps')->get();
        $list = [];
        $ad_apps->each(function ($ad_apps) use (&$list, $data_type) {

            $list[$ad_apps->app_id] = [
                "app_id" => $ad_apps->app_id,
                "app_name" => $ad_apps->app_name,
                "sdk_id" => $ad_apps->sdk_id,
                "partner_id" => $ad_apps->partner_id,
                "is_asp" => $ad_apps->is_asp
            ];
            var_dump($list);

            $term = $this->getTerm();
            var_dump($term);

            $term->each(function ($term, $key) use ($ad_apps, &$list, $data_type) {
                $url_result = ["http://dl_sample", "apikey"];
                $list[$ad_apps->app_id]["dl_path"][$key] = $url_result[0];
                $list[$ad_apps->app_id]["dl_type"] = $url_result[1] ? 1 : 2;
                $csv_file_name = $term["start_date"] . "_" . Carbon::parse($term["end_date"])->endOfMonth()->format("Y-m-d") . ".csv";
                $list[$ad_apps->app_id]["csv_file_name"][$key] = $csv_file_name;
                $list[$ad_apps->app_id]["upload_path"][$key] = "development/1/2/3/";
                $list[$ad_apps->app_id]["start"][$key] = $term["start_date"];
                $list[$ad_apps->app_id]["end"][$key] = $term["end_date"];

            });
            var_dump('collection = ', collect($list));
            var_dump('array = ', $list);
        });
        exit;
        //return view('welcome');
    }

    private function getTerm(): Collection
    {

        //変数初期化
        $term = [];
        //envの指定どおり過去分を取得する（要は遡り期間）
        $count = 2;

        //さかのぼって取得する期間を指定
        for ($i = 0; $i <= $count; $i++) {

            //今日の日付を取得
            $dt = Carbon::now();

            //当月の場合
            if ($i == 0) {
                //月初、月末の日付を取得しセットする
                $term[$i]["end_date"] = $dt->addDays(-1)->format("Y-m-d");
                $term[$i]["start_date"] = (clone $dt->startOfMonth())->format("Y-m-d");
            } else {

                /**
                 * 1日の時は更に一日前倒ししないとおかしい　
                 *
                 * 例）10/1実行
                 *
                 * 当月は9/1〜9/30
                 * 先月は8/1〜8/31
                 *
                 * になるべき
                 */

                //月初初日のとき
                if($dt->format("j")==1){
                    //予め1ヶ月引いておく
                    $dt->subMonths(1);
                }

                //バックデート分のとき月初、月末の日付を取得しセットする
                $term[$i]["start_date"] = $dt->subMonths($i)->startOfMonth()->format("Y-m-d");
                $term[$i]["end_date"] = $dt->endOfMonth()->format("Y-m-d");
            }
        }

        //取得した値をコレクションにし返送
        return collect($term);

    }
}
