<?php
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use App\Http\Requests\SearchByRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Client\ConnectionException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (SearchByRequest $request) {
    return $request->user();
});


//Grouping the api endpoints for organization
Route::get('/breweries', function(SearchByRequest $request){

    $open_brewery_db = env('OPEN_DB_BREW_ENDPOINT');

    if($request->has(strtolower('by_state'))){

        return call_open_brewery_db_api('by_state', $request->by_state);

    }elseif($request->has(strtolower('by_type'))) {

        return call_open_brewery_db_api('by_type', $request->by_type);

    } elseif($request->has(strtolower('by_city'))) {

        return call_open_brewery_db_api('by_city', $request->by_city);
    }
    else {
        $breweries = Http::get($open_brewery_db);
        return response()->json(['breweries' => $breweries->json()]);
    }
});



function call_open_brewery_db_api( string $key, string $value)
{
    $open_brewery_db = env('OPEN_DB_BREW_ENDPOINT');
    $open_brewery_db_response = Http::get($open_brewery_db, [
        $key => $value
    ]);


    if($open_brewery_db_response->successful()){

        return response()->json(['breweries' => $open_brewery_db_response->json()]);
    }else{
        return "Api is failing...";
    }
}

