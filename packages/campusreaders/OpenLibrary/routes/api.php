<?php

use Illuminate\Support\Facades\Route;

Route::get('/openlibrary/search/{query}', function ($query) {
    return app('openlibrary')->search($query);
});

Route::get('/openlibrary/book/{isbn}', function ($isbn) {
    return app('openlibrary')->book($isbn);
});
