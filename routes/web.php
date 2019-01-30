<?php
use Illuminate\Http\Request;

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
        'middleware' => 'auth',
        'prefix' => 'checklists/{checklistId}'
    ], function() use ($router) {
    $router->get('items', function ($checklistId, Request $request) {
        $checklist = App\Checklist::find($checklistId);
        $items = $checklist->items;
        $sort = $request->input('sort');
        if ($sort) {
            $items = $checklist->items($sort)->get();
        }
        $data = [
            'type' => 'checklists',
            'id' => $checklist->id,
            'attributes' =>  [
                'description' => $checklist->description,
                'is_completed' => $checklist->is_completed,
                'due' => $checklist->due,
                'items' => $items,
            ]
        ];
        $json = ['data' => $data];
        return response()->json($json);
    });
});