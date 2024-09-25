<?php

use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

Route::get('/', function (Request $request) {

    $isPaginate = filter_var($request->paginate, FILTER_VALIDATE_BOOLEAN);
    $search = $request->search;
    $limit = $request->limit ?? 10;

    # Cache the result for 60 seconds
    $users = Cache::remember('users', 60, function () use ($search, $isPaginate, $limit) {
        return User::getData($search, $isPaginate, $limit);
    });

    return UserCollection::make($users);
});
