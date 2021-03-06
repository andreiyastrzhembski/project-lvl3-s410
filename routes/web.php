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
use GuzzleHttp\Client;
use DiDom\Document;

$router->get('/', ['as' => 'home', function () {
    return view('index');
}]);

$router->post('/domains', ['as' => 'domainsAdd', function (Request $request) {
    $name = $request->input('url');
    $date = date('Y-m-d H:i:s');
    $container = app();
    $client = $container->make('GuzzleHttp\Client');
    try {
        $response = $client->get($name);
    } catch (\Exception $e) {
        return view('index', ['error' => $e->getMessage()]);
    }
    $statusCode = $response->getStatusCode();
    $body = $response->getBody()->getContents();
    if ($response->hasHeader('content-length')) {
        $contentLength = $response->getHeader('content-length')[0];
    } else {
        $contentLength = mb_strlen($body);
    }

    $document = new Document($body);
    if ($document->has('h1')) {
        $h1 = $document->first('h1')->text();
    } else {
        $h1 = null;
    }
    if ($document->has('meta[name="keywords"]')) {
        $keywords = $document->first('meta[name="keywords"]')->getAttribute('content');
    } else {
        $keywords = null;
    }
    if ($document->has('meta[name="description"]')) {
        $description = $document->first('meta[name="description"]')->getAttribute('content');
    } else {
        $description = null;
    }

    $id = DB::table('domains')->insertGetId([
        'name' => $name,
        'updated_at' => $date,
        'created_at' => $date,
        'status_code' => $statusCode,
        'content_length' => $contentLength,
        'body' => $body,
        'h1' => $h1,
        'keywords' => $keywords,
        'description' => $description
    ]);
    return redirect()->route('domainsShow', ['id' => $id]);
}]);

$router->get('/domains', ['as' => 'domainsAll',  function () {
    $domains = DB::table('domains')->paginate(10);
    return view('domain', ['domains' => $domains, 'pagination' => true]);
}]);

$router->get('/domains/{id}', ['as' => 'domainsShow',  function ($id) {
    $domains = DB::table('domains')->where('id', $id)->get();
    return view('domain', ['domains' => $domains, 'detailed' => true]);
}]);
