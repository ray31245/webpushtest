<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <p>
                    <button id="button">点击出现提示</button>
                </p>
                <a href="pushpage">發送頁面</a>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
        {{-- <script>
            if (window.Notification) {
                // 获得权限
                Notification.requestPermission();
                // 点击按钮
                document.querySelector('#button').addEventListener('click', function () {
                    new Notification("Hi，帅哥：", {
                        body: '可以加你为好友吗？',
                        icon: 'https://avatars6.githubusercontent.com/u/496048?v=4&s=460'
                    });
                });
            } else {
                document.getElementById('result').innerHTML = '浏览器不支持Web Notification';
            }
            </script> --}}

            <!-- The core Firebase JS SDK is always required and must be listed first -->
            <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>
            {{-- <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase-app.js"></script> --}}
            <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>
            <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-messaging.js"></script>

            <!-- TODO: Add SDKs for Firebase products that you want to use
                https://firebase.google.com/docs/web/setup#config-web-app -->

            <script>
            // import * as firebase from 'firebase/app';
            // import '@firebase/messaging';
            // Your web app's Firebase configuration
            var firebaseConfig = {
                apiKey: "AIzaSyCfgBHK4_U1pizaeIGKG4azCEaDW_fbDIc",
                authDomain: "laravelpushtest.firebaseapp.com",
                databaseURL: "https://laravelpushtest.firebaseio.com",
                projectId: "laravelpushtest",
                storageBucket: "",
                messagingSenderId: "73632765795",
                appId: "1:73632765795:web:be47a783e68d81bb"
            };
            // console.log(firebase);
            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);

// console.log(firebase);
            const messaging = firebase.messaging();

            var postToken = function(fcmtoken){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    // document.getElementById("demo").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "postfcmtoken?fcmtoken="+fcmtoken, true);
                xhttp.send();
            };
            messaging.requestPermission()
            .then(res => {
                // 若允許通知 -> 向 firebase 拿 token
                return messaging.getToken();
            }, err => {
                // 若拒絕通知
                console.log(err);  
            })
            .then(token => {
                // 成功取得 token
                // console.log(token);
                postToken(token); // 打給後端 api
                console.log(token);
            });

            // messaging.setBackgroundMessageHandler(function(payload) {
            // console.log('[firebase-messaging-sw.js] Received background message ', payload);
            // // Customize notification here
            // var notificationTitle = 'Background Message Title';
            // var notificationOptions = {
            //     body: 'Background Message body.',
            //     icon: '/firebase-logo.png'
            // };

            // return self.registration.showNotification(notificationTitle,
            //     notificationOptions);

            // });

            messaging.onMessage(function(payload) {
            console.log("Message received. ", payload);
            // ...
            });
            </script>
    </body>
</html>
