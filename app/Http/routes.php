<?php

Use App\Photo;
Use App\Product;
Use App\Staff;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Create


Route::get('/create/{staff_id}', function($staff_id){

$staff = Staff::findorFail($staff_id);

$staff->photos()->create(['path'=>'example.jpg']);

});



//Read

Route::get('/read/{staff_id}', function($staff_id){

$staff=Staff::findorFail($staff_id);

foreach ($staff->photos as $photo) {

    echo $photo->path."<br>";

  }


});


//Update

Route::get('/update/{staff_id}', function($staff_id){

  $staff=Staff::findOrFail($staff_id);

  $photo = $staff->photos()->whereId(1)->first();

  $photo->path = "Updated example.jpg";

  $photo->save();

});

//Delete

Route::get('/delete/{staff_id}', function($staff_id){

   $staff = Staff::findOrFail($staff_id);

   $staff->photos()->delete();

   //Another way below

   //$staff->photos()->whereId(1)->delete();



});


//Assign

Route::get('/assign/{staff_id}/{photo_id}',function($staff_id, $photo_id){

   $staff=Staff::findOrFail($staff_id);

   $photo = Photo::findOrFail($photo_id);

   $staff->photos()->save($photo);

});

//Unassign

Route::get('/un-assign/{staff_id}/{photo_id}', function($staff_id,$photo_id){

  $staff = Staff::findorFail($staff_id);

  //$photo = Photo::findorFail($photo_id);

  $staff->photos()->whereId($photo_id)->update(['imageable_id'=>'','imageable_type'=>'']);





});