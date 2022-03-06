<?php

use Illuminate\Support\Facades\Route;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {


    $user_ip = getenv('REMOTE_ADDR');
    $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
    $country = ($geo) ? $geo['geoplugin_countryName'] : '';

    $timezone = ($geo) ? $geo['geoplugin_timezone'] : '';

    if ($timezone != '') {
        date_default_timezone_set($timezone);
    }

    if($country == ''){
        $user_ip = get_client_ip();
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
        $country = ($geo) ? $geo['geoplugin_countryName'] : '';
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    $tasks = Tasks::where(['type' => 'public'])->orWhere('user_country', $country)->get();
    return view('welcome', ['tasks' => $tasks, 'session_country' => $country]);
});

Route::get('/dashboard', function () {
    $tasks = Tasks::where(['user_id' => Auth::user()->id])->get();
    return view('dashboard', ['tasks' => $tasks]);
})->middleware(['auth'])->name('dashboard');

Route::resource('tasks', TasksController::class);

require __DIR__ . '/auth.php';
