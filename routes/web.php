<?php

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
use Illuminate\Support\Facades\Input;

// Route responsible for INITIALIZATION of list in database
Route::post('init-list', function () {
	$list = Input::get('groceryList');

	$insertedId = DB::table('grocery_list')->insertGetId(
		['list' => json_encode($list)]
	);

	return ['Id' => $insertedId];
});


// Route responsible for UPDATING list in database
Route::post('update-list', function () {
	$id 	= Input::get('listId');
	$list = Input::get('groceryList');

	$status = DB::table('grocery_list')
		->where('id', $id)
		->update(['list' => json_encode($list)]);

	return ['Id' => $id];
});

// Route responsible for LOADING SAVED list in database
Route::get('/{id}', function ($id) { 
	$list = DB::table('grocery_list')->select('list')->where('id', $id)->get();

	if(count($list)){
		return view('lindex', compact('id', 'list'));
	}else{
		return view('index');
	}
});

// Route returning index site
Route::get('/', function () {	
	return view('index');
});
