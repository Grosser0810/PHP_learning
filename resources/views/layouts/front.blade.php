<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Barbershop</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <script src="https://unpkg.com/vue-agile"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-agile/dist/VueAgile.css">



</head>
<body>
<div id="app">
<header>
    <router-link to="/" class="link-to-home">
        <img src="css/img/inner-logo.png" alt="logo">
    </router-link>
    <div class="container main-nav">
            <a href="" id="toggle-menu"><i class="fas fa-bars"></i></a>
        <nav class="nav">
                <ul class="menu">
                    <li><router-link to="/information" class="nav-link">Информаия</router-link></li>
                    <li><router-link to="/news" class="nav-link">Новости</router-link></li>
                    <li><router-link to="/price" class="nav-link">Прайс-лист</router-link></li>
                    <li><router-link to="/shop" class="nav-link">Магазин</router-link></li>
                    <li><router-link to="/contacts" class="nav-link">Контакты</router-link></li>
                </ul>
        </nav>
        @if(Auth::check())

            <div class="users-block">
                <div style="color: white">
                    {{ Auth::user()->name }}
                </div>
                <div class="users-block-flex">
                <div class="cart" style="color: white">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-power-off"></i>
                            <p>
                                {{ __('Logout') }}
                            </p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </div>
            </div>
        @else
            <div class="enter">
                <i class="fa fa-sign-in sign" aria-hidden="true"></i><a href="#">вход</a>
            </div>
        @endif

    </div>


</header>



    <router-view></router-view>




<footer class="inner-footer">
    <div class="container">

        <div class="map_block">
            <div id="map"></div>
            <i id="closeMap" class="fa fa-times"></i>
        </div>

        <div id="registration_block">

            <p class="size30">личный кабинет</p>
            <p class="size14 ">введите пожалуста свой логин и пароль</p>
            <form class="registration-form"  method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" placeholder="EMAIL" name="email" id="email" class="login-form size14 @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus><br>

                <input type="password" placeholder="PASSWORD" name="password" id="password" class="login-form size14 @error('password') is-invalid @enderror" required autocomplete="current-password">

                <div class="check">
                    <div id="checkbox">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="size14">запомните меня</label>

                    </div>
                    <a class="forget" href="" class="">я забыл пароль!</a>
                </div>
                <button type="submit"  class="size14">войти</button>
                <button class="size14 registration-link">регистрация</button>
            </form>
            <i class="fa fa-user" aria-hidden="true"></i>
            <i class="fa fa-lock" aria-hidden="true"></i>
            <i id="closeRegistration" class="fa fa-times" aria-hidden="true"></i>
        </div>

    </div>



    <div class="footer">
        <div class="container flex-footer">
            <section class="footer-contacts">
                <p>Барбершоп "Бородинский"<br>
                    Адрес: Г. Сестрорецк, ул. Красных Текстильщиков, д. 19/8<br>
                    <a href="#">Как нас найти?</a><br>
                    Телефон: +7 (812) 666-02-66</p>
            </section>
            <section class="footer-social">
                <p>Давайте дружить!</p>
                <a class="social-btn social-btn-fb">Facebook</a>
                <a class="social-btn social-btn-vk">ВКонтакте</a>
                <a class="social-btn social-btn-ig">Instagram</a>
            </section>
            <section class="footer-copyright">
                <p>Разработано:</p>
                <a class="btn" href="#">Hleb Bulanov</a>
            </section>
        </div>
    </div>
</footer>

</div>







<script src="https://api-maps.yandex.ru/2.1/?apikey=d096d518-617b-4b3a-af15-0b7fa5898075&lang=ru_RU" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/5675eab6b2.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/map.js')}}"></script>
</body>
