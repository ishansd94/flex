<?php

    use App\Framework\Core\Routes;



    Routes::get( 'auth/login/{username}/{name}' , 'AuthController@login' );
    Routes::get( 'auth/login/{username}' , 'AuthController@login' );
    Routes::get( 'auth/login' , 'AuthController@login' );