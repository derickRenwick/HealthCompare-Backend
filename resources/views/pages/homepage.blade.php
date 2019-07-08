@extends('layout.app')

@section('title', 'Page Test')

@section('description', 'this is the meta description')

@section('keywords', 'this is the meta keywords')

{{--creates path for CSS file --}}
@push('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush


{{--creates path for JS file --}}
@push('main')
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
@endpush

@push('jquery')
    <script src="{{ asset('js/library/jquery-3.4.1.min.js') }}"></script>

@endpush

@push('font-awesome')
    <script src="{{ asset('js/library/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('https://kit.fontawesome.com/d4b841dc1e.js') }}"></script>
@endpush

@push('banner')
   <section class="banner">
        <div class="bannerData">
            <div class="homePostCodeParent">
                <div class="homePostCodeBox">

                </div>
            </div>
            <div class="homePromo">
                <p>The quality of care in England varies greatly
                    between hospitals. You have the legal right to choose
                    where to have your elective surgery*. It can be at:</p>
                <ul class="promoList">
                    <li>An NHS hospital of your choice</li>
                    <li>A private hospital funded by NHS</li>
                    <li>A private hospital paid by you or
                        your insurance provider</li>
                </ul>
            </div>
        </div>
   </section>
@endpush










