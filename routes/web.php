<?php

use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function (Request $request) {

    $isPaginate = filter_var($request->paginate, FILTER_VALIDATE_BOOLEAN);
    $search = $request->search;
    $limit = $request->limit ?? 10;

    $users = User::getData($search, $isPaginate, $limit);

    return UserCollection::make($users);
});
