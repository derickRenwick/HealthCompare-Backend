@extends('layout.app')

@section('title', 'Blog')

@section('description', 'Discover all the latest information about Hospital Compare, as well as our views and comment on healthcare issues.')

@section('keywords', 'this is the meta keywords')

@section('mobile', 'width=device-width, initial-scale=1, user-scalable=no')

@section('body-class', 'blog-page hc-content')

{{--{{ dd($data['blogs']) }}--}}

@section('content')
    <section class="banner">
        <div class="container">
            <h1 class="mb-3">Latest <span class="col-brand-primary-1">healthcare</span> news</h1>
            <h2 class="page-subtitle col-grey mb-0">Informative, impartial and helpful information <br>
                surrounding the healthcare industry.</h2>
        </div>
    </section>
{{--    <section class="blog-filters border-bottom py-0 d-none d-md-block">--}}
{{--        <div class="container">--}}
{{--            <div class="row py-4">--}}
{{--                <div class="col ">--}}
{{--                    <div class="filters row">--}}
{{--                        <div class="text text-left col-12 col-lg-2 my-4 my-lg-auto">Filter articles</div>--}}
{{--                        <div class="categories col-12 col-lg-10">--}}
{{--                            @if(!empty($data['categories']))--}}
{{--                                <div class="row justify-content-lg-end row-categories">--}}
{{--                                    @foreach($data['categories'] as $cat)--}}
{{--                                        <div class="col-2">--}}
{{--                                            <a href="/blogs/category/{{$cat->id}}" class="btn btn-category category rounded text-center w-100" style="background-color: {{ (empty($data['categoryId']) ? $cat->colour : (($data['categoryId'] == $cat->id) ? $cat->colour : 'grey'))}}">{{$cat->name}}</a>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <section class="blog-list pt-4">
        <div class="container">
            <div class="blog-content row">
                @include('components.blogloop', [
                    'blogs'             => $data['blogs'],
                    'buttonClass'       => 'text-left',
                    'buttonTitle'       => 'Continue reading →'
                    ])
            </div>
            <div class="pagination-wrap">
                @if(!empty($data['blogs']))
                    {{ $data['blogs']->links('components.basic.pagination') }}
                @endif
            </div>
        </div>
    </section>
@endsection
