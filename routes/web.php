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

use App\Notifications\SomeNotification;
// use App\Notifications\InvoicePaid;
use App\User;
use \Illuminate\Support\Facades\DB;
// use \Illuminate\Support\Facades\Request;

Route::get('/', function () {
// dd('123');
    // event(new SomeNotification());
    // $a = new SomeNotification;
    // $a->toFcm();


    // $work = 1;
    // $user = App\User::find(1);

    // $user->notify(new SomeNotification($work));
    return view('welcome');
});

Route::get('/pushpage',function(){
    
    define( 'API_SERVER_ACCESS_KEY', 'AAAAESTa12M:APA91bEqFl3UyL20fc1TV7qNP9s9jn6Ljumfqq2Hsc1hoT-GSxnnTJ4yo8_SUcNw1u20ju5aAuEG0rbQsS727LZVhQ1EI-7m74hiraoivs_GqJdpjZ9muboOIVdYWIAl33O-2e--vpAF' );
    $tokenlist = DB::select('select * from tokenlist ');
    // dd($tokenlist);
    foreach($tokenlist as $key => $value)
    {
        // dd($value->remember_token);
        // $token 	 = $_GET['id'];/*FCM 接收端的token*/
        $token 	 = $value->remember_token;/*FCM 接收端的token*/
        $message = $value->id;/*要接收的內容*/
        $title 	 = $key;  /*要接收的標題*/
        
        /*
        notification組成格式 官方範例
        {
        "message":{
            "token":"bk3RNwTe3H0:CI2k_HHwgIpoDKCIZvvDMExUdFQ3P1...",
            "notification":{
            "title":"Portugal vs. Denmark",
            "body":"great match!"
            }
        }
        }
        */
        
        $content = array
        (
            'title'	=> $title,
            'body' 	=> $message
        );
        $fields = array
        (
            'to'		    => $token,
            'notification'	=> $content
        );
        
        //firebase認證 與 傳送格式
        $headers = array
        (
            'Authorization: key='. API_SERVER_ACCESS_KEY,
            'Content-Type: application/json'
        );
        
        /*curl至firebase server發送到接收端*/
        $ch = curl_init();//建立CURL連線
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
        var_dump($ch,json_encode( $fields ),$headers);
        $result = curl_exec($ch );
        $headers1 = curl_getinfo($ch, CURLINFO_HEADER_OUT);
        echo "\n\n=====请求返回=====\n";
        echo "out headers：\t".$headers1 ."\n";
        $hearLen = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        echo "header len：\t".$hearLen ."\n";
        $statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo "httpcode:\t".$statuscode."\n";
        echo "\n===================\n";
        curl_close( $ch );//關閉CURL連線}
        //result 是firebase server的結果
        dump($result);
        echo $result;
    }
});

Route::get('postfcmtoken',function(Request $request){
    $fcmtoken = $_GET['fcmtoken'];
    // dd( $_GET['fcmtoken']);
    $checkexist = DB::select('select remember_token from tokenlist where remember_token = ?', [$fcmtoken]);
    // dd($checkexist);
    if(empty($checkexist))
    {
        DB::insert('insert into tokenlist (id,remember_token) values (?,?)', [null,$fcmtoken]);
    }
    return $fcmtoken;
    
});
