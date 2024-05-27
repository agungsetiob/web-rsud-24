    @extends('layouts.page-layout')
        @section('content')
            @fragment('beranda')
            <div id="app">
                @include('main.partials.carousels')
                @include('main.partials.blog')
                @include('main.partials.profile')
                @include('main.partials.services')
                @include('main.partials.contact')
                @include('main.partials.doctors')
                @include('main.partials.faqs')
            </div>
            <script>
                $(".header-carousel").owlCarousel({
                    animateOut: 'slideOutDown',
                    items: 1,
                    autoplay: true,
                    smartSpeed: 1000,
                    dots: false,
                    loop: true,
                    nav : true,
                    navText : [
                        '<i class="bi bi-arrow-left"></i>',
                        '<i class="bi bi-arrow-right"></i>'
                    ],
                });
            </script>
            @endfragment
        @endsection