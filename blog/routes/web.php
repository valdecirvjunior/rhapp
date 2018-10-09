<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Funcionario;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/funcionarios', 'FuncionarioController@index')->name('funcionarios');
Route::get('/funcionarios/novo', 'FuncionarioController@novo');
Route::post('funcionarios/salvar', 'FuncionarioController@salvar');
Route::get('funcionarios/download', function(){
    $table = Funcionario::all();
    $filename = "funcionarios.csv";
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('id', 'idCargo', 'name', 'idade', 'sexo', 'endereco'));
    foreach($table as $row) {
        fputcsv($handle, array($row['id'],$row['idCargo'], $row['name'], $row['idade'],$row['sexo'],$row['endereco']));
    }
    fclose($handle);
    $headers = array(
        'Content-Type' => 'text/csv',
    );
    return Response::download($filename, 'funcionarios.csv', $headers);
});

Route::get('/cargos', 'CargosController@index')->name('cargos');
Route::get('/cargos/novo', 'CargosController@novo');
Route::post('cargos/salvar', 'CargosController@salvar');

