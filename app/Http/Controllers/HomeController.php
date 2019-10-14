<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Video;
use App\Movie;
use App\Anime;
use App\tag;
use App\Anime_backup;
use App\Setting;
use App\ReportVideo;
use App\Ads;
use App\Movie_backup;

class HomeController extends Controller
{

    public function index()
    {
        $ads = Ads::get();
        $video = Video::where('v_movie', '1')->orderBy('updated_at', 'desc')->paginate(24);
        $tag = tag::orderBy('t_name', 'desc')->get();
        $view_video = Video::orderBy('v_view', 'desc')->paginate(24);
        $anime = Video::where('v_movie', '0')->orderBy('updated_at', 'desc')->paginate(24);
        $series = Video::where('v_movie', '2')->orderBy('updated_at', 'desc')->paginate(24);
        $setting = Setting::find('1');
        $all_video = Video::orderBy('updated_at', 'desc')->paginate(24);

        // 

        $check_movie = Video::where('v_movie', '=', '1')->count();
        $check_anime = Video::where('v_movie', '=', '0')->count();
        $check_series = Video::where('v_movie', '=', '2')->count();

        // 
        return view('index', compact('setting'))
            ->with(compact('view_video'))
            ->with(compact('video'))
            ->with(compact('tag'))
            ->with(compact('series'))
            ->with(compact('all_video'))
            ->with(compact('anime'))
            ->with(compact('check_movie'))
            ->with(compact('check_anime'))
            ->with(compact('check_series'))
            ->with(compact('ads'));
    }
    public function detail($v_id, $v_name)
    {
        $ads = Ads::get();
        $video_detail = Video::find($v_id);
        $video_ifram1 = Movie::where("m_vid", $v_id)->first();
        if (!$video_ifram1) {
            $video_ifram1 = Anime::where("a_vid", $v_id)->paginate(999999);
        }
        $movie_backup = Movie_backup::where('mb_vid',$v_id)->get();
        $view = $video_detail['v_view'];
        $view += 1;
        $view_update = Video::find($v_id);
        $view_update->timestamps = false;
        $view_update->v_view = $view;
        $view_update->save();
        $tag = tag::orderBy('t_name', 'desc')->get();
        $setting = Setting::find('1');

        return view('detail', compact('ads', 'setting', 'video_detail', 'v_id', 'video_ifram1','movie_backup', 'tag'));
    }

    public function player($url)
    {
        error_reporting(0);
        $ads_player = Setting::find('1');
        return view('player', compact('url', 'ads_player'));
    }

    public function animeplayer($anime)
    {
        error_reporting(0);
        $ads_player = Setting::find('1');
        return view('player_sugoi', compact('anime', 'ads_player'));
    }

    public function watch($a_id, $a_name)
    {
        $anime = Anime::find($a_id);
        $tag = tag::orderBy('t_name', 'desc')->get();
        $setting = Setting::find('1');
        $v_id = $anime['a_vid'];
        $video_detail = Video::find($v_id);
        $ads = Ads::get();
        $anime_backup = Anime_backup::where('ab_aid', $a_id)->get();
        return view('watch', compact('ads', 'video_detail', 'setting', 'anime', 'anime_backup', 'tag'));
    }

    public function allmovie()
    {
        $ads = Ads::get();
        $tag = tag::orderBy('t_name', 'desc')->get();
        $movie = Video::where('v_movie', '1')->orderBy('updated_at', 'desc')->paginate(24);
        $setting = Setting::find('1');
        return view('allmovie', compact('ads', 'setting', 'tag', 'movie'));
    }

    public function allvideo()
    {
        $tag = tag::orderBy('t_name', 'desc')->get();
        $ads = Ads::get();
        $movie = Video::orderBy('updated_at', 'desc')->paginate(24);
        $setting = Setting::find('1');
        return view('allvideo', compact('ads', 'setting', 'tag', 'movie'));
    }


    public function allanime()
    {
        $tag = tag::orderBy('t_name', 'desc')->get();
        $ads = Ads::get();
        $anime = Video::where('v_movie', '0')->orderBy('updated_at', 'desc')->paginate(24);
        $setting = Setting::find('1');
        return view('allanime', compact('ads', 'setting', 'tag', 'anime'));
    }
    public function search(Request $request)
    {
        $tag = tag::orderBy('t_name', 'desc')->get();
        $search = Video::where('v_name', 'LIKE', '%' . $request->get('search') . '%')->orderBy('updated_at', 'desc')->paginate(24);
        $ads = Ads::get();
        $setting = Setting::find('1');
        $now_seach = $request->get('search');
        return view('search', compact('ads', 'setting', 'search', 'tag', 'now_seach'));
    }

    public function play_series($url)
    {
        $ads_player = Setting::find('1');
        return view('player_series', compact('url', 'ads_player'));
    }

    public function allseries()
    {

        $tag = tag::orderBy('t_name', 'desc')->get();
        $ads = Ads::get();
        $series = Video::where('v_movie', '2')->orderBy('updated_at', 'desc')->paginate(24);
        $setting = Setting::find('1');

        return view('allseries', compact('ads', 'setting', 'tag', 'series'));
    }
    public function tags($name)
    {

        $ads = Ads::get();
        $tag = tag::orderBy('t_name', 'desc')->get();
        $setting = Setting::find('1');
        $video_tag = Video::where('v_tags', 'LIKE', '%' . $name . '%')->paginate(24);
        return view('tags', compact('ads', 'setting', 'tag', 'video_tag', 'name'));
    }

    public function reportvideo(Request $request)
    {
        $check_aid = ReportVideo::where('r_aid', $request->get('r_aid'))->count();
        if ($check_aid == 1) { } else {
            $report = new ReportVideo([
                'r_name' => $request->get('r_name'),
                'r_img' => $request->get('r_img'),
                'r_aid' => $request->get('r_aid'),
                'r_vid' => $request->get('r_vid'),
            ]);
            $report->save();
        }

        return redirect()->back()
            ->with('successreport', 'Report Video Success');
    }
}
