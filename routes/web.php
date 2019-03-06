<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Http\Request;

$router->get('/', ['as' => 'home', function () {
    return view('index');
}]);

$router->post('/domains', ['as' => 'domainsAdd', function (Request $request) {
    $name = $request->input('url');
    $date = date('Y-m-d H:i:s');
    $id = DB::table('domains')->insertGetId([
        'name' => $name,
        'updated_at' => $date,
        'created_at' => $date
    ]);
    return redirect()->route('domainsShow', ['id' => $id]);
}]);

$router->get('/domains', ['as' => 'domainsAll',  function () {
    $domains = DB::table('domains')->paginate(10);
    return view('domain', ['domains' => $domains, 'pagination' => true]);
}]);

$router->get('/domains/{id}', ['as' => 'domainsShow',  function ($id) {
    $domains = DB::table('domains')->where('id', $id)->get();
    return view('domain', ['domains' => $domains]);
}]);
