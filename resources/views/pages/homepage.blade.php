@extends('layout.app')

@section('title', 'Homepage')

@section('description', 'this is the meta description')

@section('keywords', 'this is the meta keywords')

@section('mobile', 'width=device-width, initial-scale=1')

@section('body-class', 'home-page')

@section('content')

    @include('pages.pagesections.banner')

    <section class="how-section__parent">
        @include('components.howsection', [
            'hideButton'    => false,
            'sectionTitle' => 'How does it work?',
            'howsections' => [
            [
                'iconImg'       => 'doctor',
                'step'          => 'One',
                'title'         => 'Your rights to choose:',
                'color'         => 'turq',
                'description'   => '
                            <ul class="tick-list">
                                <li>if NHS funded treatment</li>
                                <li>if self-pay</li>
                                <li>if covered by a health insurance policy</li>
                            </ul>'
            ],
            [
                'iconImg'       => 'search',
                'step'          => 'Two',
                'title'         => 'Search & compare:',
                'color'         => 'violet',
                'description'   => '<p>Use this site to search and compare both NHS and private (self-pay) hospitals across England. You can also search and compare by your health insurance policy.</p>'],
            [
                'iconImg'       => 'hospital-compare',
                'step'          => 'Three',
                'title'         => 'Make enquiry:',
                'color'         => 'pink',
                'description'   => '<p>Contact your chosen hospital(s) and ask any questions before deciding the one that’s right for you.</p>'],
            [
                'iconImg'       => 'confirm',
                'step'          => 'Four',
                'title'         => 'Request a referral:',
                'color'         => 'blue',
                'description'   => '<p>Request a referral from your GP if you selected an NHS hospital, or wait for your chosen private hospital to contact you about your appointment.</p>'
            ]
        ]
    ])
    </section>

    <section class="why-use-parent">
        <div class="why-use-content">
            <div class="why-use container">
                <div class="row">
                    <div class="why-use-text col col-12 col-md-6">
                        <h2 class="section-title">Why use Hospital Compare?</h2>
                        <p>Hospital Compare helps you make the best possible choice when it comes to choosing a suitable
                            hospital for your treatment.</p>
                        <p>Many people in the UK are not aware that they could have the option of an NHS funded
                            operation
                            in a private hospital. We are here to help you understand your rights and make the right
                            choice.</p>
                        <p>Whether you are searching for the best NHS hospital or the best private hospital, Hospital
                            Compare is the best place that provides an accurate, up-to-date and unbiased assessment of
                            all
                            hospitals in the UK.</p>
                    </div>
                    <div class="why-use-video col col-12 col-md-6">
                        <div class="video-wrapper">
                            <video muted class="content" poster="{{ url('images/video_placeholder.jpg') }}">
                                <source src="{{ asset('video/For_Wes.mp4') }}" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                            {{--                            <div class="player-button toggle"></div>--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="testimonial-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">3 great reasons to use Hospital Compare</h2>
                </div>
                <div class="col-4">
                    <div class="col-inner text-center">
                        <p>
                            "Use Hospital Compare to make the very best choice for your treatment"
                        </p>
                        <div class="star-rating mb-3">
                            {!! \App\Helpers\Utils::getHtmlStars(5) !!}
                        </div>
                        <div class="signature mb-2">
                            Dr Stevini
                        </div>
                        <div class="job-title text-uppercase">
                            Hospital Compare,<br>
                            Head of development
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="col-inner text-center">
                        <p>
                            "Use Hospital Compare to make the very best choice for your treatment"
                        </p>
                        <div class="star-rating mb-3">
                            {!! \App\Helpers\Utils::getHtmlStars(5) !!}
                        </div>
                        <div class="signature mb-2">
                            Dr Stevini
                        </div>
                        <div class="job-title text-uppercase">
                            Hospital Compare,<br>
                            Head of development
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="col-inner text-center">
                        <p>
                            "Use Hospital Compare to make the very best choice for your treatment"
                        </p>
                        <div class="star-rating mb-3">
                            {!! \App\Helpers\Utils::getHtmlStars(5) !!}
                        </div>
                        <div class="signature mb-2">
                            Dr Stevini
                        </div>
                        <div class="job-title text-uppercase">
                            Hospital Compare,<br>
                            Head of development
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="btn-area text-center">
                        @include('components.basic.button', [
                            'classTitle'        => 'btn btn-squared btn-turq',
                            'buttonText'        => 'Find the right hospital',
                            'hrefValue'         => '/results-page'
                        ])
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!empty($data['faqs']))
        <section class="faqs-section bg-greylight mt-5 py-5">
            <div class="container container-980">
                <div class="row">
                    <div class="col hc-content">
                        <h2>Frequently asked questions</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque eligendi in nihil quibusdam!
                            veritatis voluptas. Doloremque id ipsum labore quibusdam quo quod repudiandae voluptatem!</p>
                        <div class="accordion" id="faqs_accordion">
                            @foreach($data['faqs'] as $faq)
                                <div class="card">
                                    {!! $faq->question !!}
                                    {!! $faq->answer !!}
                                </div>
                            @endforeach
                        </div>{{-- Accordion --}}
                        @include('components.basic.button', [
                            'buttonText'    => 'View all FAQs',
                            'classTitle'    => 'btn btn-turq btn-squared mt-4',
                            'hrefValue'     => '/faqs'
                        ])
                    </div>{{-- hc-content --}}
                </div>
            </div>
        </section>
    @endif

    {{--    <section class="choose-health-parent">--}}
    {{--        @include('components.healthchoice', [--}}
    {{--            'choosehealthbanner' => '',--}}
    {{--            'buttonName' => 'Choose your health',--}}
    {{--            'classTitle' => 'btn btn-icon btn-arrow-right mx-auto' ] )--}}

    {{--    </section>--}}

    {{--    <div class="blogSectionParent">--}}
    {{--        <h1 class="pageTitle">Making the right choice</h1>--}}
    {{--        <div class="blogContent">--}}
    {{--            @include('components.blogs', ['blogs' =>--}}
    {{--            [--}}
    {{--                ['iconImg'=> 'images/Layer_16.png' , 'title'=>'Blog', 'description' => 'Lorem ipsum dolor sit amet elit. In sit amet sem ut magna ornare.', 'url' => url('/blog/1')],--}}
    {{--                ['iconImg'=> 'images/Layer_17.png' , 'title'=>'Blog', 'description' => 'Lorem ipsum dolor sit amet elit. In sit amet sem ut magna ornare.', 'url' => url('/blog/2')],--}}
    {{--                ['iconImg'=> 'images/Layer_18.png' , 'title'=>'Blog', 'description' => 'Lorem ipsum dolor sit amet elit. In sit amet sem ut magna ornare.', 'url' => url('/blog/3')]--}}
    {{--            ], 'classTitle'=> '', 'buttonTitle' => 'Read more', 'buttonClass' => 'btn btn-block btn-read-more' ])--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
