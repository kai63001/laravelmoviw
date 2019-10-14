<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Video;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Movie_backup;
use App\tag;
use App\Http\Controllers\Hash;
use App\Anime;
use App\Anime_backup;
use App\Setting;
use App\ReportVideo;
use App\Ads;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $li = file_get_contents('https://raw.githubusercontent.com/kai63001/lic/master/licenmovie1');
        $gg = request()->getHost();
        $checkli = strpos($li,$gg);
        if($checkli != ""){
            
        }else{
            echo "701 Error pls contact Kuro";
            exit();
        }
    }
    public function showChangePasswordForm(){
        return view('auth.changePassword');
    }
    
    public function changePassword(Request $request){
        if (!(\Hash::check($request->get('current-password'), \Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        $user = \Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }

    public function index(){
        $video_lastupdate = Video::orderBy('updated_at','desc')->paginate(2);
        $report = ReportVideo::count();
        $view_all = Video::sum('v_view');
        $setting = Setting::find('1');
        $allvideo = Video::count();
        $tag = Tag::orderBy('t_name','desc')->get();
        return view('admin.dashboard',compact('setting','video_lastupdate','tag','report','view_all','allvideo'));
    }

    public function findmove($name){
        error_reporting(0);
        return view('admin.find_movie',compact('name'));
    }

    public function addmovie(Request $request){
        $this->validate($request,[
            'v_name' => 'required',
            'v_detail' => 'required',
            'v_img' => 'required',
            'v_type' => 'required',
            'v_tags' => 'required',
            'v_trailer' => 'required',
            'v_imdb' => 'required',
            
        ]);
        if($request->get('v_iframe') != ""){
            $video = new Video([
                'v_name' => $request->get('v_name'),
                'v_detail' => $request->get('v_detail'),
                'v_img' => $request->get('v_img'),
                'v_type' => $request->get('v_type'),
                'v_tags' => $request->get('v_tags'),
                'v_trailer' => $request->get('v_trailer'),
                'v_imdb' => $request->get('v_imdb'),
                'v_movie' => ('1'),
                'v_view' => ('1'),
    
            ]);
            $video->save();
            $v_id = DB::getPdo()->lastInsertId();
    
            $video_next = Video::find($v_id);
            $movie = new Movie([
                'm_iframe' => $request->get('v_iframe'),
                'm_vid' => $v_id
            ]);
            $movie->save();

            return redirect('/admin/stealall/list')
            ->with('successimovie','Steal Success');
        }else{
            $video = new Video([
                'v_name' => $request->get('v_name'),
                'v_detail' => $request->get('v_detail'),
                'v_img' => $request->get('v_img'),
                'v_type' => $request->get('v_type'),
                'v_tags' => $request->get('v_tags'),
                'v_trailer' => $request->get('v_trailer'),
                'v_imdb' => $request->get('v_imdb'),
                'v_movie' => ('1'),
                'v_view' => ('1'),
    
            ]);
            $video->save();
            $v_id = DB::getPdo()->lastInsertId();
    
            $video_next = Video::find($v_id);
            $bg = $request->get('v_bg');
            return view('admin.addvideomovie',compact('v_id','video_next','bg'));
        }
       
    }

    public function addmovier(Request $request){
        $v_id = $request->get('m_vid');

        $date = Video::find($v_id);
        $date->touch();
        if($request->get('a_name') != ""){
            $this->validate($request,[
                'a_name' => 'required',
                'm_iframe' => 'required',
                'm_vid' => 'required'
            ]);
            $movie = new Anime([
                'a_name' => $request->get('a_name'),
                'a_iframe' => $request->get('m_iframe'),
                'a_vid' => $request->get('m_vid')
            ]);
            $v_id = $request->get('m_vid');
            $view_update = Video::find($v_id);
            $view_update->save();
            $movie->save();
            $id =DB::getPdo()->lastInsertId();
            
            return redirect('admin')
                ->with('successanime','Add Success')
                ->with('a_id',$id)
            ;
        }else{


            $this->validate($request,[
                'm_iframe' => 'required',
                'm_vid' => 'required'
            ]);
            $movie = new Movie([
                'm_iframe' => $request->get('m_iframe'),
                'm_vid' => $request->get('m_vid')
            ]);
            $movie->save();
            
            
            return redirect('admin')
                ->with('success','Add Movie Success')
                ->with('m_id',$request->get('m_vid'))
            ;
        }


    }

    public function findmovie($name){
        error_reporting(0);
        return view('admin.system.searchmovie',compact('name'));

    }

    public function addmoviebackup($v_id){

        $movie = Video::find($v_id);

        return view('admin.addmoviebackup',compact('movie','v_id'));
    }

    public function addbackup_movie(Request $request){
        $this->validate($request,[
            'mb_iframe' => 'required',
            'mb_vid' => 'required'
        ]);

        $movie_backup = new Movie_backup([
            'mb_name' => $request->get('mb_name'),
            'mb_iframe' => $request->get('mb_iframe'),
            'mb_vid' => $request->get('mb_vid')

        ]);

        $movie_backup->save();
        return redirect('admin')
        ->with('success','Add [BACKUP] Movie Success')
        ->with('m_id',$request->get('mb_vid'))
        ;
    }

    public function delete_movie($v_id){
        $video_movie_delete = DB::table('videos')->where('v_id',$v_id)->delete();
        $movie_delete = DB::table('movies')->where('m_vid',$v_id)->delete();
        $backup_movie_delete = DB::table('movie_backups')->where('mb_vid',$v_id)->delete();
        $delete_anime = DB::table('animes')->where('a_vid',$v_id)->delete();

        error_reporting(0);

        return redirect()->back();
    }

    public function addtags(Request $request){
        $this->validate($request,[
            't_name' => 'required',
        ]);
        
        $tags = new Tag([
            't_name' => $request->get('t_name')
        ]);
        $tags->save();

        return redirect()->back()->with('tags','Add Tags Success');
    }
    
    public function deletetags($t_id){
        $tags = Tag::find($t_id);

        $tags->delete();

        return redirect()->back()->with('tags','Delete Tags Success');
    }

    public function findanime($name){
        
        error_reporting(0);
        return view('admin.find_anime',compact('name'));
    }

    public function addanime(Request $request){
        $this->validate($request,[
            'v_name' => 'required',
            'v_detail' => 'required',
            'v_img' => 'required',
            'v_type' => 'required',
            'v_tags' => 'required',
            'v_trailer' => 'required',
            'v_imdb' => 'required',
        ]);
        
        $anime_add = new Video([
            'v_name' => $request->get('v_name'),
            'v_detail' => $request->get('v_detail'),
            'v_img' => $request->get('v_img'),
            'v_type' => $request->get('v_type'),
            'v_tags' => $request->get('v_tags'),
            'v_trailer' => $request->get('v_trailer'),
            'v_imdb' => $request->get('v_imdb'),
            'v_movie' => ('0'),
            'v_view' => ('1'),

        ]);

        $anime_add->save();
        $v_id = DB::getPdo()->lastInsertId();

        $video_next = Video::find($v_id);
        $bg = $request->get('v_bg');
        if($request->get('v_hdzero') == 1){
            $animehdzero = file_get_contents('https://www.animehdzero.com/catagory/'.$request->get('v_idhdzero'));
    
            $ep_name_for = $animehdzero;
            $start = strpos($ep_name_for,'<div style="text-align:center;">');
            $ep_name_for = substr($ep_name_for,$start);
            $ep_name_for = str_replace('<div style="text-align:center;">','',$ep_name_for);
            $stop = strpos($ep_name_for,'</div>');
            $ep_name_for = substr($ep_name_for,0,$stop);
            $ex_ep_name = explode('<a href="',$ep_name_for);

            $count_ex_ep = count($ex_ep_name) - 1;

            for($i=1;$i<=$count_ex_ep;$i++){
                $url_name = $ex_ep_name[$i];
                $bh_url_name = strstr($url_name,'"');
                $url_name = str_replace($bh_url_name,'',$url_name);
                
                // echo $url_name;
                $name_title = $url_name;
                $name_title = str_replace('https://animehdzero.com/watch/','',$name_title);
                $check_typename = strpos($name_title,$request->get('v_type'));
                if($check_typename == ""){
                    $name_title.' '.$request->get('v_type');
                }
                // echo $name_title;
                $url_name = str_replace(' ','+',$url_name);
                
                $url_hd_video = file_get_contents($url_name);
                $start = strpos($url_hd_video,'https://www.animehdzero.com/player/embed.php?link=');
                $url_hd_video = substr($url_hd_video,$start);
                $url_hd_video = str_replace('https://www.animehdzero.com/player/embed.php?link=','',$url_hd_video);
                $stop = strpos($url_hd_video,'"');
                $url_hd_video = substr($url_hd_video,0,$stop);
                $url_hd_video = str_rot13($url_hd_video);
                $url_hd_video = str_replace('/','-',$url_hd_video);
                $iframe = '<iframe height="460px" sandboxscrolling="no" frameborder="0"allowfullscreen="true" webkitallowfullscreen="true"  mozallowfullscreen="true" class="embed-responsive-item" width="100%" src="'.url('').'/'.'play/'.$url_hd_video.'/run" allowfullscreen></iframe>';
                
                $anime_add_hd = new Anime([
                    'a_name' => $name_title,
                    'a_iframe' => $iframe,
                    'a_vid' => $v_id
                ]);
                $anime_add_hd->save();
            }

            return redirect('admin/stealall/list')
                ->with('successhdzero','Add Anime HdZero')
            ;

        }else{
            return view('admin.addvideoanime',compact('v_id','video_next','bg'));
        }
    }
    function curl($url) {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.animehdzero.com/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        header('Content-Type: text/html; charset=UTF-8');
        header("Access-Control-Allow-Origin: *");
        $data = curl_exec($ch); 
        curl_close($ch); 
        return $data;   
    }

    public function searchanime($name,$ep){
        error_reporting(0);
        return view('admin.system.searchanime',compact('name','ep'));
    }

    public function animebackup($a_id){
        error_reporting(0);
        $video_next = Anime::find($a_id);
        $v_id = $video_next['a_vid'];
        $video_video = Video::find($v_id);
        if($video_video['v_movie'] == 2){
            $series = "ok";
        }else{
            $series = "no";
        }
        return view('admin.animebackup',compact('video_next','video_video','a_id','series'));
    }
    public function addvideoanime($v_id){
        error_reporting(0);
        $video_next = Video::find($v_id);
        return view('admin.addvideoanime',compact('v_id','video_next'));

    }
    public function addanimebackup(Request $request){

        $this->validate($request,[
            'ab_name' => 'required',
            'ab_iframe' => 'required',
            'a_id' => 'required',
        ]);

        $anime_backup = new Anime_backup([
            'ab_name' => $request->get('ab_name'),
            'ab_iframe' => $request->get('ab_iframe'),
            'ab_aid' => $request->get('a_id')
        ]);
        $anime_backup->save();

        return redirect('admin')
            ->with('backup','success')
        ;
    }
    
    public function search_series($name,$ep){
        error_reporting(0);

        return view('admin.system.searchseries',compact('name','ep'));
    }
    
    public function findseries($name){
        error_reporting(0);
        return view('admin.find_series',compact('name'));
    }

    public function addseries(Request $request){
        $this->validate($request,[
            'v_name' => 'required',
            'v_detail' => 'required',
            'v_img' => 'required',
            'v_type' => 'required',
            'v_tags' => 'required',
            'v_trailer' => 'required',
            'v_imdb' => 'required',
        ]);

        $anime_add = new Video([
            'v_name' => $request->get('v_name'),
            'v_detail' => $request->get('v_detail'),
            'v_img' => $request->get('v_img'),
            'v_type' => $request->get('v_type'),
            'v_tags' => $request->get('v_tags'),
            'v_trailer' => $request->get('v_trailer'),
            'v_imdb' => $request->get('v_imdb'),
            'v_movie' => ('2'),
            'v_view' => ('1'),

        ]);

        $anime_add->save();
        $v_id = DB::getPdo()->lastInsertId();

        $video_next = Video::find($v_id);

        return redirect('admin/seriesvideo/'.$v_id);
    }
    public function addvideoSeries($id){
        $v_id = $id;
        $video_next = Video::find($v_id);
        return view('admin.addvideoseries',compact('v_id','video_next'));
    }

    // public function addseriesep(Request $request){
    //     $this->validate($request,[
    //         ''
    //     ]);
    // }

    public function backupfind($id){
        $v_id = $id;
        $vide_find_ep = Video::find($v_id);

        $ep = Anime::where('a_vid',$v_id)->orderBy('updated_at','ASC')->get();

        if($vide_find_ep['v_movie'] == 2){
            $series = "ok";
        }else{
            $series = "no";
        }

        return view('admin.findbackup',compact('vide_find_ep','ep','series'));
    }

    public function editep($a_id,$v_id){

        $vide_find_ep = Video::find($v_id);
        $ep = Anime::find($a_id);

        if($vide_find_ep['v_movie'] == 2){
            $series = "ok";
        }else{
            $series = "no";
        }
        
        return view('admin.editep',compact('vide_find_ep','ep','series'));
    }

    public function leteditep(Request $request){

        $ep = Anime::find($request->get('a_id'));
        $ep->a_name = $request->get('a_name');
        $ep->a_iframe = $request->get('a_iframe');

        $ep->save();

        return redirect()->back()->with('success','Edit Success');
    }

    public function backupep($a_id,$v_id){
        $video_backup = Video::find($v_id);
        $now = Anime::find($a_id);
        $ep = Anime_backup::where('ab_aid',$a_id)->get();

        return view('admin.backup',compact('video_backup','ep','now','a_id'));
    }

    public function backupedit($ab_id,$a_id){

        $video = Video::find($a_id);
        $backup = Anime_backup::find($ab_id);

        if($video['v_movie'] == 2){
            $series = "ok";
        }else{
            $series = "no";
        }

        return view('admin.editbackup',compact('backup','video','series'));

    }

    public function leteditbackupep(Request $request){
        $ep = Anime_backup::find($request->get('a_id'));
        $ep->ab_name = $request->get('a_name');
        $ep->ab_iframe = $request->get('a_iframe');

        $ep->save();

        return redirect()->back()->with('success','Edit Success');
    }

    public function deleteep($a_id){
        $ep = Anime::find($a_id)->delete();

        return redirect()->back()->with('success','Delete Success');
    }

    public function deleteepbackup($ab_id){

        $backup = Anime_backup::find($ab_id)->delete();

        return redirect()->back()->with('success','Delete Success');

    }

    public function editvideo($v_id){
        $video = Video::find($v_id);

        return view('admin.edit_video',compact('video'));
    }

    public function editvideoedit(Request $request){
        $v_id = $request->get('v_id');
        $video = Video::find($v_id);

        $video->v_name = $request->get('v_name');
        $video->v_detail = $request->get('v_detail');
        $video->v_type = $request->get('v_type');
        $video->v_trailer = $request->get('v_trailer');
        $video->v_tags = $request->get('v_tags');
        $video->v_img = $request->get('v_img');

        $video->save();

        return redirect()->back()->with('success','Update Video Success');
    }

    public function allvideo(){

        $video = Video::orderBy('updated_at','desc')->paginate(24);
        $search = "none";
        $searched = "ok";
        return view('admin.allvideo',compact('video','search','searched'));
    }

    public function allvideosearch(Request $request){

        $video = Video::where('v_name','LIKE','%'.$request->get('search').'%')->orderBy('updated_at','desc')->paginate(24);
        $search = "ok";
        $searched = $request->get('search');
        return view('admin.allvideo',compact('video','search','searched'));
    }

    public function stealall_list(){

        return view('admin.stealall.stealall');
    }

    public function dashboard(Request $request){
        
        $setting = Setting::find('1');

        $setting->s_title = $request->get('s_title');
        $setting->s_des = $request->get('s_des');
        $setting->s_keyword = $request->get('s_keyword');

        $setting->save();

        return redirect()->back()->with('successedit','Edit Success');

        
    }

    public function advance(Request $request){
        $setting = Setting::find('1');

        $setting->s_bg = $request->get('s_bg');
        $setting->s_maincolor = $request->get('s_maincolor');
        $setting->s_fanpage = $request->get('s_fanpage');
        $setting->s_coverplayer = $request->get('s_coverplayer');
        $setting->s_adsplayer = $request->get('s_adsplayer');

        $setting->save();

        return redirect()->back()->with('successedit','Update Success');
    }

    public function animehdzero(){
        return view('admin.stealall.animehdzero');
    }
    
    public function animehdzerofind($url){
        error_reporting(0);
        return view('admin.stealall.animehdzero_find',compact('url'));
    }

    public function reportshow(){
        error_reporting(0);
        $re = ReportVideo::paginate(24);
        if($re['a_id'] == '-'){
            $report = Video::find($re['v_id']);
        }else{
            $report = Anime::find($re['a_id']);
        }
        return view('admin.report.report',compact('report','re'));
    }

    public function editrerpotmovie($v_id,$r_id){
        error_reporting(0);
        $deletereport = ReportVideo::where('r_id',$r_id)->delete();
        return redirect('/admin/edit/movie/'.$v_id);
    }

    public function editmovie($v_id){
        $edit = Video::find($v_id);
        $movie = Movie::where('m_vid',$v_id)->get();
        return view('admin.edit.editmovie',compact('edit','movie'));
    }

    public function editmovie_start(Request $request){
        $editmovie = Movie::find($request->get('m_id'));
        $editmovie->m_iframe = $request->get('m_iframe');
        $editmovie->save();
        return redirect()->back()->with('success','Edit Success');
    }

    public function editreportanime($v_id,$a_id,$r_id){
        error_reporting(0);
        $deletereport = ReportVideo::where('r_id',$r_id)->delete();
        return redirect('/admin/edit/ep/'.$a_id.'/'.$v_id);
    }

    public function stealimovie(){
        return view('admin.stealall.imovie_find');
    }

    public function urlimovie($url){
        error_reporting(0);
        return view('admin.stealall.imovie',compact('url'));
    }
    
    public function settingsoption(){
        $setting = Setting::find(1);
        $ads = Ads::get();
        return view('admin.edit.setting',compact('setting','ads'));
    }

    public function savescript(Request $request){
        $setting = Setting::find(1);

        $setting->s_header = $request->get('s_header');
        $setting->s_body = $request->get('s_body');

        $setting->save();

        return redirect()->back()->with('success','Success Update');

    }
    
    public function saveads(Request $request){
        $this->validate($request,[
            'ad_name' => 'required',
            'ad_img' => 'required',
            'ad_url' => 'required',
        ]);

        $ads = new Ads([
            'ad_name' => $request->get('ad_name'),
            'ad_img' => $request->get('ad_img'),
            'ad_url' => $request->get('ad_url'),
        ]);
        $ads->save();

        return redirect()->back()->with('successads','Success Update');

    }

    public function deleteads($id){
        $ads = Ads::find($id)->delete();
        

        return redirect()->back()->with('successads','Success Update');
    }

    public function autoaddnewep($v_id,$v_name){
        $checkname = strpos($v_name,'ตอนที่');
        if($checkname != ""){
            $v_name = substr($v_name,0,$checkname);
            $c_name = strlen($v_name) -1 ;
            $v_name = substr($v_name,0,$c_name);
        }
        $v_name = str_replace(' ','+',$v_name);
        $hdzeroaddnewep = file_get_contents('https://www.animehdzero.com/search.php?key='.$v_name);
        $start = strpos($hdzeroaddnewep,'<a href="https://animehdzero.com/catagory/');
        $hdzeroaddnewep = substr($hdzeroaddnewep,$start);
        $hdzeroaddnewep = str_replace('<a href="','',$hdzeroaddnewep);
        $stop = strpos($hdzeroaddnewep,'"');
        $hdzeroaddnewep = substr($hdzeroaddnewep,0,$stop);
        $hdzeroaddnewep = file_get_contents($hdzeroaddnewep);
        $start = strpos($hdzeroaddnewep,'<div style="text-align:center;">');
        $hdzeroaddnewep = substr($hdzeroaddnewep,$start);
        $stop = strpos($hdzeroaddnewep,'</div>');
        $hdzeroaddnewep = substr($hdzeroaddnewep,0,$stop);
        $hdzeroaddnewep = str_replace('<div style="text-align:center;">','',$hdzeroaddnewep);
        $hd_exploit = explode('<a href="',$hdzeroaddnewep);
        $count_hd_ep = count($hd_exploit)-1;

        // check how many ep
        $myep = Anime::where('a_vid','=',$v_id)->count();
        $sucauto = 0;
        if($myep < $count_hd_ep){
            $nowep = $myep + 1;
            $autonowep = $hd_exploit[$nowep];
            $bh_autonowep = strstr($autonowep,'"');
            $autonowep = str_replace($bh_autonowep,'',$autonowep);
            $autoname = str_replace('https://animehdzero.com/watch/','',$autonowep);
            $autonowep = str_replace(' ','+',$autonowep);
            $url_hd_video = file_get_contents($autonowep);
            $start = strpos($url_hd_video,'https://www.animehdzero.com/player/embed.php?link=');
            $url_hd_video = substr($url_hd_video,$start);
            $url_hd_video = str_replace('https://www.animehdzero.com/player/embed.php?link=','',$url_hd_video);
            $stop = strpos($url_hd_video,'"');
            $url_hd_video = substr($url_hd_video,0,$stop);
            $url_hd_video = str_rot13($url_hd_video);
            $url_hd_video = str_replace('/','-',$url_hd_video);
            $iframe = '<iframe height="460px" sandboxscrolling="no" frameborder="0"allowfullscreen="true" webkitallowfullscreen="true"  mozallowfullscreen="true" class="embed-responsive-item" width="100%" src="'.url('').'/'.'play/'.$url_hd_video.'/run" allowfullscreen></iframe>';
            
            $update_anime_auto = Video::find($v_id);
            $change_name_ep = $update_anime_auto['v_name'];
            $change_name_ep = str_replace('-'.$myep.' ','-'.$nowep.' ',$change_name_ep);
            $update_anime_auto->v_name = $change_name_ep;
            $update_anime_auto->save();

            $anime_add_hd = new Anime([
                'a_name' => $autoname,
                'a_iframe' => $iframe,
                'a_vid' => $v_id
            ]);
            $anime_add_hd->save();
            $sucauto = 1;
            

            // dd($autonowep);
        }elseif($myep == $count_hd_ep){
            $sucauto = 2;

        }
        // dd($count_hd_ep);
        // dd($myep);
        return redirect()->back()->with('botsuccess',$sucauto);

    }

    public function autofixanime($v_id,$v_name){
        $checkname = strpos($v_name,'ตอนที่');
        if($checkname != ""){
            $v_name = substr($v_name,0,$checkname);
            $c_name = strlen($v_name) -1 ;
            $v_name = substr($v_name,0,$c_name);
        }
        $v_name = str_replace(' ','+',$v_name);
        $hdzeroaddnewep = file_get_contents('https://www.animehdzero.com/search.php?key='.$v_name);
        $start = strpos($hdzeroaddnewep,'<a href="https://animehdzero.com/catagory/');
        $hdzeroaddnewep = substr($hdzeroaddnewep,$start);
        $hdzeroaddnewep = str_replace('<a href="','',$hdzeroaddnewep);
        $stop = strpos($hdzeroaddnewep,'"');
        $hdzeroaddnewep = substr($hdzeroaddnewep,0,$stop);
        $hdzeroaddnewep = file_get_contents($hdzeroaddnewep);
        $start = strpos($hdzeroaddnewep,'<div style="text-align:center;">');
        $hdzeroaddnewep = substr($hdzeroaddnewep,$start);
        $stop = strpos($hdzeroaddnewep,'</div>');
        $hdzeroaddnewep = substr($hdzeroaddnewep,0,$stop);
        $hdzeroaddnewep = str_replace('<div style="text-align:center;">','',$hdzeroaddnewep);
        $checkton = strpos($hdzeroaddnewep,'ตอนที่');
        $fixed = 0;
        if($checkton != ""){
            $delete_anime_fix = Anime::where('a_vid','=',$v_id)->delete();
            $explode_anime_fix = explode('<a href="',$hdzeroaddnewep);
            $count_explode_anime = count($explode_anime_fix)-1;
            for($i=1;$i<=$count_explode_anime;$i++){
                $nowanime_fix = $explode_anime_fix[$i];
                $bh_nowanime = strstr($nowanime_fix,'"');
                $nowanime_fix = str_replace($bh_nowanime,'',$nowanime_fix);
                $autoname = str_replace('https://animehdzero.com/watch/','',$nowanime_fix);
                $nowanime_fix = str_replace(' ','+',$nowanime_fix);   
                $url_hd_video = file_get_contents($nowanime_fix);
                $start = strpos($url_hd_video,'https://www.animehdzero.com/player/embed.php?link=');
                $url_hd_video = substr($url_hd_video,$start);
                $url_hd_video = str_replace('https://www.animehdzero.com/player/embed.php?link=','',$url_hd_video);
                $stop = strpos($url_hd_video,'"');
                $url_hd_video = substr($url_hd_video,0,$stop);
                $url_hd_video = str_rot13($url_hd_video);
                $url_hd_video = str_replace('/','-',$url_hd_video);
                $iframe = '<iframe height="460px" sandboxscrolling="no" frameborder="0"allowfullscreen="true" webkitallowfullscreen="true"  mozallowfullscreen="true" class="embed-responsive-item" width="100%" src="'.url('').'/'.'play/'.$url_hd_video.'/run" allowfullscreen></iframe>';

                $anime_add_hd = new Anime([
                    'a_name' => $autoname,
                    'a_iframe' => $iframe,
                    'a_vid' => $v_id
                ]);

                $anime_add_hd->save();

                // echo $iframe;

                // echo $nowanime_fix;

            }
            $fixed = 1;

        }else{
            $fixed = 2;
        }
        return redirect()->back()->with('fixed',$fixed);
    }


}
