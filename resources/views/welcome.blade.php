<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ngoccp1234</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            #fbLogout {
                width: 100px;
                height: 30px;
                display: none;
            }
        </style>
    </head>
    <body class="antialiased">
    <fb:login-button id="fbLogin" scope="public_profile,email" onlogin="checkLoginState();">
    </fb:login-button>

   <button id="fbLogout" type="submit" onclick="logoutFb()">Logout</button>

    <div id="status">
    </div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    <script type="text/javascript">
        function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
            console.log(response)
            console.log(response.authResponse.accessToken)
            console.log('statusChangeCallback');
            console.log(response.status);                   // The current login status of the person.
            if (response.status === 'connected') {
                // Logged into your webpage and Facebook.
                testAPI();
                document.getElementById("fbLogin").style.display = "none";
                document.getElementById("fbLogout").style.display = "block";
            } else {                                 // Not logged into your webpage or we are unable to tell.
                document.getElementById('status').innerHTML = 'Please log ' +
                    'into this webpage.';
            }
        }


        function checkLoginState() {               // Called when a person is finished with the Login Button.
            FB.getLoginStatus(function(response) {   // See the onlogin handler
                statusChangeCallback(response);
            });
        }


        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1977641332432828',
                cookie     : true,                     // Enable cookies to allow the server to access the session.
                xfbml      : true,                     // Parse social plugins on this webpage.
                version    : 'v14.0'           // Use this Graph API version for this call.
            });


            FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
                statusChangeCallback(response);        // Returns the login status.
            });
        };
        function logoutFb(){
            document.getElementById("fbLogin").style.display = "block";
            document.getElementById("fbLogout").style.display = "none";
            FB.logout(function(response) {
                document.getElementById("fbLogin").style.display = "block";
                console.log(response);
                console.log('logout success!')
            });
        }


        function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function(response) {
                console.log(response);
                console.log('Successful login for: ' + response.name);
                document.getElementById('status').innerHTML =
                    'Thanks for logging in, ' + response.name + '!';
            });
        }
    </script>
    </body>
</html>
