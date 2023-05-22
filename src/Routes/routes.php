<?php

Route::group(['middleware'=>'web'], function(){
	Route::resource('/admin/clients', 'Locomotif\Clients\Controller\ClientsController');	
});
