<?php

use Kysel\Events\Models\Event;
use Kysel\Events\Models\Following;

$auth = '\Tymon\JWTAuth\Middleware\GetUserFromToken';

//get requesty

Route::get('/events/few',function() { //ziskanie prvych troch eventov
    return Event::with(['user'=> function($q){
        $q->select('id','name');
    }])->limit(3)->get();
});

Route::get('/events/all',function() { //ziskanie vsetkych eventov
    return Event::with(['user'=> function($q){
        $q->select('id','name');
    }])->get();
});

Route::get('/event/{id}',function($id) { // ziskanie konkretneho eventu
    return Event::with(['user' => function($q){
        $q->select('id', 'name');
    }])->where(['id' => $id])->first();
});

Route::get('/events/{userId}', function($userId) { // ziskanie vsetkych eventov od konkretnej osoby
    return Event::where(['user_id' => $userId])->get();
});

Route::get('/following/{userId}', function($userId) { // ziskanie vsetkych eventov 
    return Following::with(['event' => function($q){
        $q->select('id','name','poster', 'address', 'description');
    }])->where(['user_id' => $userId])->get();
})->middleware($auth);

//post requesty

Route::post('/event', function(){ //Pridanie eventu
    $event = new Event;

    $img = post('poster');
    $img = str_replace('data:image/jpeg;base64,', '', $img);
    $img = str_replace(' ','+',$img);
    $imageData = base64_decode($img);
    
    $file = (new \System\Models\File)->fromData($imageData, 'poster.jpeg');

    $event->name = Input::get('name');
    $event->poster = $file;
    $event->user_id = Input::get('user_id');
    $event->address = Input::get('address');
    $event->date_start = Input::get('date_start');
    $event->date_end = Input::get('date_end');
    $event->description = Input::get('description');

    $event->save();
})->middleware($auth);

Route::post('/follow', function(){ //pridanie followu
    $following = new Following;

    $following->user_id = Input::get('user_id');
    $following->event_id = Input::get('event_id');

    $following->save();
})->middleware($auth);

//update requesty

Route::patch('/event/{id}', function($id){ //Update eventu
    $event = Event::where(['id' => $id])->first();

    $event->update([
        'name' => Input::get('name', $event->name),
        'address' => Input::get('address', $event->address),
        'date_start' => Input::get('date_start', $event->date_start),
        'date_end' => Input::get('date_end', $event->date_end),
        'description' => Input::get('description', $event->description), 
    ]);
})->middleware($auth);

//delete requesty

Route::delete('/event/{id}', function($id) { // vymazanie eventu
    return Event::where(['id' => $id])->delete();
})->middleware($auth);

Route::delete('/follow/{id}', function($id) { //vymazanie/odhlasenie od followu
    return Following::where(['id' => $id])->delete();
})->middleware($auth);


