{{--{{ dd($data['hospitals']) }}--}}

@extends('layout.app')

@section('title', 'Results Page')

@section('description', 'this is the meta description')

@section('keywords', 'this is the meta keywords')

@section('mobile', 'width=device-width, initial-scale=1')

@section('body-class', 'results-page results-page-mobile')

@section('content')
    <div class="results">
        <div class="container">
            <div class="row">
                @if(!empty($data['hospitals']))
                    @foreach($data['hospitals'] as $d)
                        @include('mobile.components.itemmobile', [
                            'id'                    => $d['id'],
                            'itemImg'               => 'images/alder-1.jpg',
                            'title'                 => !empty($d['display_name'])? $d['display_name'] : $d['name'],
                            'location'              => (!empty($d['radius'])) ? number_format($d['radius'], 1 ) . ' miles from postcode' : '',
                            'town'                  => (!empty($d['address']['city']) ? ', ' . $d['address']['city'] : ''),
                            'county'                => (!empty($d['address']['county']) ? $d['address']['county'] : ''),
                            'postcode'              => (!empty($d['address']['postcode']) ? $d['address']['postcode'] : ''),
                            'latitude'              => $d['address']['latitude'],
                            'longitude'             => $d['address']['longitude'],
                            'findLink'              => 'Find on map',
                            'waitTime'              => !empty($d['waitingTime'][0]['perc_waiting_weeks']) ? number_format((float)$d['waitingTime'][0]['perc_waiting_weeks'], 1) : 0,
                            'waitingTimeRanking'    => !empty($d['waitingTime'][0]['perc_waiting_weeks']) ? \App\Helpers\Utils::getRankingPosition($data['waitingTimeRankings'], $d['id']).' of '.$data['hospitals']->total() : '-',
                            'outpatient'            => !empty($d['waitingTime'][0]['outpatient_perc_95']) ? number_format((float)$d['waitingTime'][0]['outpatient_perc_95'], 1) : '-',
                            'outpatientRank'        => !empty($d['waitingTime'][0]['outpatient_perc_95']) ? \App\Helpers\Utils::getRankingPosition($data['outpatientRankings'], $d['id']).' of '.$data['hospitals']->total() : '-',
                            'inpatient'             => !empty($d['waitingTime'][0]['inpatient_perc_95']) ? number_format((float)$d['waitingTime'][0]['inpatient_perc_95'], 1) : '-',
                            'inpatientRank'         => !empty($d['waitingTime'][0]['inpatient_perc_95']) ? \App\Helpers\Utils::getRankingPosition($data['inpatientRankings'], $d['id']).' of '.$data['hospitals']->total() : '-',
                            'diagnosticRank'        => !empty($d['waitingTime'][0]['diagnostics_perc_6']) ? \App\Helpers\Utils::getRankingPosition($data['diagnosticRankings'], $d['id']).' of '.$data['hospitals']->total() : '-',
                            'diagnostic'            => !empty($d['waitingTime'][0]['diagnostics_perc_6']) ? $d['waitingTime'][0]['diagnostics_perc_6'].'%' : '-',
                            'userRating'            => !empty($d['rating']['avg_user_rating']) ? $d['rating']['avg_user_rating'] : 0,
                            'stars'                 => !empty($d['rating']['avg_user_rating']) ? \App\Helpers\Utils::getHtmlStars($d['rating']['avg_user_rating']) : "No data",
                            'opCancelled'           => !empty($d['cancelledOp']['perc_cancelled_ops'])? number_format((float)$d['cancelledOp']['perc_cancelled_ops'], 1).'%': 0,
                            'qualityRating'         => !empty($d['rating']['latest_rating']) ? $d['rating']['latest_rating'] : 0,
                            'FFRating'              => !empty($d['rating']['friends_family_rating']) ? number_format((float)$d['rating']['friends_family_rating'], 1).'%' : 0,
                            'NHSFunded'             => ($d['hospitalType']['name'] === 'NHS' || ($d['hospitalType']['name'] === 'Independent' && !empty($d['waitingTime'][0]['perc_waiting_weeks']))) ? 1 : 0,
                            'privateSelfPay'        => $d['hospitalType']['name'] === 'Independent' ? 1 : 0,
                            'specialOffers'         => $d['special_offers'],
                            'btnText'               => 'Make enquiry',
                            'NHSClass'              => $d['hospitalType']['name'] == 'NHS' ? 'nhs-hospital' : 'private-hospital',
                            'fundedText'            => ($d['hospitalType']['name'] == 'NHS') ? 'NHS': 'Private',
                            'url'                   => $d['url'],
                            'safe'                  => $d['rating']['safe'],
                            'safeIcon'              => \App\Helpers\Utils::getDiscOrStar($d['rating']['safe']),
                            'effective'             => $d['rating']['effective'],
                            'effectiveIcon'         => \App\Helpers\Utils::getDiscOrStar($d['rating']['effective']),
                            'caring'                => $d['rating']['caring'],
                            'caringIcon'            => \App\Helpers\Utils::getDiscOrStar($d['rating']['caring']),
                            'responsive'            => $d['rating']['responsive'],
                            'responsiveIcon'        => \App\Helpers\Utils::getDiscOrStar($d['rating']['responsive']),
                            'well_led'              => $d['rating']['well_led'],
                            'wellLedIcon'           => \App\Helpers\Utils::getDiscOrStar($d['rating']['well_led']),
                            'procedures'            => $data['filters']['procedures'],
                            'locationSpecialism'    => $d['location_specialism'],
                            'popoverDelay'          => 2000
                           ])
                    @endforeach
                @endif
            </div><!-- row -->
        </div><!-- container -->
        @if($data['hospitals']->total() < 10)
            <div class="container">
                <h1>Try tweaking the filters for more results</h1>
            </div>
        @endif
    </div><!-- results -->

    @include('components.solutionsbar', [
      'specialOffers' => $data['special_offers']
      ])
    @include('components.modals.modalenquirenhs')
    {{--    @include('components.modals.modalspecial')--}}
    @include('components.modals.modalenquireprivate', [
        'procedures' => $data['filters']['procedures']])
    {{--  Maps modal  --}}
    {{--    @include('components.modals.modalmaps')--}}
    {{--    @include('components.modals.modalvideo')--}}
    @include('components.modals.modaltour')
    {{--    @include('components.doctor')--}}
    @include('components.basic.modalbutton', [
        'classTitle'    => 'btn btn-hanblue position-fixed',
        'buttonText'    => 'Help?',
        'modalTarget'   => '#hc_modal_tour',
        'style'         => 'z-index: 1040; bottom: 100px; left: 100px'])
@endsection