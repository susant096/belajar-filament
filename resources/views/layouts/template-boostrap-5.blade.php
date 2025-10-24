 @include('layouts.header')
 @include('layouts.navbar')
 <section class="hero">
     @yield('hero')
 </section>
 <section class="content container my-5">
     @yield('content')
 </section>
 @include('layouts.footer')
