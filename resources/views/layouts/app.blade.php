<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body @yield('color')>
    <div id="app">
        @yield('navbar')
        <main>
            @yield('content')
        </main>
    </div>
</body>
<script>

    /*
        is responsible for developing and collapsing the product description
     */
    function readMore(param) {
        var moreText = param.getElementsByClassName('more')[0];
        var dots = param.getElementsByClassName('dots')[0];
        var btnText = param.getElementsByClassName('button')[0];;

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Więcej";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Mniej";
            moreText.style.display = "inline";
        }
    }

    /*
        is responsible for developing and collapsing the list of ingredients
    */
    function getMoreIngredients(param) {
        var moreItems = param.parentElement.getElementsByClassName('more');
        var btnText = param;

        if (moreItems[0].style.display === "list-item") {
            btnText.innerHTML = "Więcej";
            for  (i=0; i<moreItems.length; i++){
                moreItems[i].style.display = "none";
            }
        } else {
            btnText.innerHTML = "Mniej";
            for  (i=0; i<moreItems.length; i++){
                moreItems[i].style.display = "list-item";
            }
        }
    }

    /*
        validates the email
    */
    function validateEmail(){
        var emailInput = document.getElementById('email');
        var emailStatus = document.getElementById('emailStatus');

        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/;

        emailStatus.style.display = "flex";
        emailInput.classList.add("status-on");

        if(emailInput.value.match(mailformat)){
            emailStatus.innerHTML = "<i class=\"fa fa-check\"></i>";
            emailStatus.style.color = "#51CF66";

            return true;
        }
        else{
            emailStatus.innerHTML = "<i class=\"fa fa-times\"></i>";
            emailStatus.style.color = "#FB2E2E";

            return false;
        }
    }

    /*
        Password validation must contain 8 characters, including at least:
        - 1 uppercase and 1 lowercase
        - special character
        - number
    */
    function validatePassword(){
        var passwordInput = document.getElementById('password');
        var passwordStatus = document.getElementById('passwordStatus');

        var passwordFormat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        passwordStatus.style.display = "flex";
        passwordInput.classList.add("status-on");

        if(passwordInput.value.match(passwordFormat)){
            passwordStatus.innerHTML = "<i class=\"fa fa-check\"></i>";
            passwordStatus.style.color = "#51CF66";

            return true;
        }
        else{
            passwordStatus.innerHTML = "<i class=\"fa fa-times\"></i>";
            passwordStatus.style.color = "#FB2E2E";

            return false;
        }
    }

    /*
        checks if the email and password are correct
    */
    function validateRegisterForm(){
        var status = validateEmail() && validatePassword();

        if(! status){
            alert('Nieprawdiłowe dane w formularzu');
        }

        return status;
    }

</script>
</html>
