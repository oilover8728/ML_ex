<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MovieController;
#database
use App\Models\Movie;
use App\Models\Recommend_list;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$database_movie=Movie::all()->first();
	$database_recommend_list=Recommend_list::all()->first();
	$recommend_error = "";
	$recommend_output= array();
	if(session('recommend_error')){
		$recommend_error = session('recommend_error');
		session()->forget('recommend_error');
	}
	if(session('top_movie')){
		$recommend_output = session('top_movie');
		session()->forget('top_movie');
	}
    return view('welcome',['movie_data_exist'=> $database_movie,'recommend_list_exist'=>$database_recommend_list, 'top_movie'=> $recommend_output,'recommend_error'=>$recommend_error]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get ('/insert', function () {
	$i=0;
	if (($handle = fopen ( public_path () . '/table.csv', 'r' )) !== FALSE) {
		$data = fgetcsv ( $handle, 1000, ',' );
		while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE && $i < 1000 ) {
			$csv_data = new Movie ();
			$csv_data->index_id = $data [0];
			$csv_data->userId = $data [1];
			$csv_data->movieId = $data [2];
			$csv_data->rating = $data [3];
			$csv_data->timestamp = $data [4];
			$csv_data->save ();
            $i = $i + 1 ;
		}
		fclose ( $handle );
	}
	
	$finalData = $csv_data::all ();
	
	return redirect ('/index');
} );

Route::get('/kill', function(){
	$movies = Movie::getQuery()->delete();
	return redirect('/');
});

Route::get('/recommend_insert', function () {
	$i=0;
	if (($handle = fopen ( public_path () . '/user_recommend.csv', 'r' )) !== FALSE) {
		$data = fgetcsv ( $handle, 1000, ',' );
		while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE && $i < 672 ) {
			$csv_data = new Recommend_list ();
			$csv_data->index_id = $data [0];
			$csv_data->user = $data [1];
			$csv_data->top1_movie = $data [2];
			$csv_data->top2_movie = $data [3];
			$csv_data->save ();
            $i = $i + 1 ;
		}
		fclose ( $handle );
	}
	
	$finalData = $csv_data::all ();
	
	return redirect ('/');
} );

Route::post('/recommend_movie', function(Request $request){
	$input = $request->username;
	#防呆
	if($input == ""){
		session(['recommend_error'=>"Error : input is empty!"]);
		return redirect('/');
	}
	else if ( !ctype_digit($input)){
		session(['recommend_error'=>"Error : input is not legal!"]);
		return redirect('/');
	}

	else if($input > "671"){
		session(['recommend_error'=>"Error : no such user!"]);
		return redirect('/');
	}
	#取出資料
	$data = Recommend_list::where('user', '=', $input)->get();
	session(['top_movie' => $data]);
	return redirect('/');
});

#=========================================================================================================================================================================================

#index (database頁面)的功能
Route::get('/index', function(){
	$delete_output="";
	$static_output="";
	#防呆
	$delete_error="";
	$search_error="";
	$modify_error="";
	if(session('text')){
		$delete_output = session('text');
		$static_output = session('static');
		session()->forget('text');
		session()->forget('static');
	}
	if(session('delete_error')){
		$delete_error = session('delete_error');
		session()->forget('delete_error');
	}
	if(session('search_error')){
		$search_error = session('search_error');
		session()->forget('search_error');
	}
	if(session('modify_error')){
		$modify_error = session('modify_error');
		session()->forget('modify_error');
	}
	#取出資料
	$data = Movie::all();
	return view('index',['movies'=> $data],['static'=> $static_output,'text'=> $delete_output,'delete_error'=>$delete_error,'search_error'=>$search_error,'modify_error'=>$modify_error ]);
});

Route::post('/index', function(){
	return redirect('index');
});

Route::post('/delete', function(Request $request){
	$input = $request->index;
	#防呆
	if($input == ""){
		session(['delete_error'=>"Error : input is empty!"]);
		return redirect('index');
	}
	else if ( !ctype_digit($input)){
		session(['delete_error'=>"Error : input is not legal!"]);
		return redirect('index');
	}

	else if($input > "671"){
		session(['delete_error'=>"Error : no such user!"]);
		return redirect('index');
	}
	#取出資料
	$movies = DB::table('movies')->where('index_id',$input)->delete();
	session(['text' => $input]);
	session(['static' => 'Delete : ']);
	return redirect('index');
});


//按鈕刪除用不了
Route::post('/delete_withrow', function(Request $request){
	$input = $request->delete_id;
	$movies = DB::table('movies')->where('id','=',$input)->delete();
	return redirect('index');
});


Route::post('/search', function(Request $request){
	$input = $request->index_search;
	#防呆
	if($input == ""){
		session(['search_error'=>"Error : input is empty!"]);
		return redirect('index');
	}
	else if ( !ctype_digit($input)){
		session(['search_error'=>"Error : input is not legal!"]);
		return redirect('index');
	}

	else if($input > "671"){
		session(['search_error'=>"Error : no such user!"]);
		return redirect('index');
	}
	#取出資料
	$data = Movie::where('userId', '=', $input)->get();
	if(count($data)==0){
		session(['search_error'=>"Error : no such data!"]);
		return redirect('index');
	}
	return view('search',['movies'=> $data]);
});

Route::post('/modify', function(Request $request){
	$userId = $request->userId;
	$movieId = $request->movieId;
	$rating = $request->rating;
	#防呆
	if($userId == "" || $movieId == "" || $rating == ""){
		session(['modify_error'=>"Error : input is empty!"]);
		return redirect('index');
	}
	$temp = Movie::where('userId', '=', $userId)->where('movieId', '=', $movieId)->get();
	if(count($temp)==0){
		session(['modify_error'=>"Error : no such combination!"]);
		return redirect('index');
	}
	#取出資料
	$data = Movie::where('userId', '=', $userId)->where('movieId', '=', $movieId);
	$data = $data->update(['rating' => $rating]);
	return redirect('index');
});

