@extends('frontend.layouts.app')
@section('content')

<style>

/*    img {*/
/*        max-width: 100%;*/
/*        object-fit: cover;*/
/*    }*/
/*    .hom-head {*/
/*    padding: 8% 0 50px 0;*/
/*}*/

/*.hom-head::after {*/
    /* content: ""; Required for pseudo-element 
    position: absolute; */
/*    width: 100%;*/
/*    height: 100%;*/
/*    left: 0;*/
/*    top: 0;*/
/*    background-image: linear-gradient(358deg, black, rgba(0, 0, 0, 0.5));*/
/*}*/


</style>

    <!-- Homepage Slider Section -->
    @if (get_setting('show_homepage_slider') == 'on' && get_setting('home_slider_images') != null)
        <section  class="position-relative overflow-hidden min-vh-100 d-flex home-slider-area" data-aos="fade-up" >
            @php 
                $slider_images = json_decode(get_setting('home_slider_images'), true);  
                $slider_images_small = json_decode(get_setting('home_slider_images_small'), true);  
            @endphp
            <div class="absolute-full hom-head " >
                    <div class="aiz-carousel aiz-carousel-full h-100 d-none {{ get_setting('home_slider_images_small') != null ? 'd-md-block' : 'd-block' }}" data-fade='true' data-infinite='true' data-autoplay='true'>
                        @foreach ($slider_images as $key => $slider_image)
                            <img class="img-fit" src="{{ uploaded_asset($slider_image) }}">
                        @endforeach
                    </div>
                    @if (get_setting('home_slider_images_small') != null)
                        <div class="aiz-carousel aiz-carousel-full h-100 d-md-none" data-fade='true' data-infinite='true' data-autoplay='true'>
                            @foreach ($slider_images_small as $key => $slider_image)
                                <img class="img-fit" src="{{ uploaded_asset($slider_image) }}" >
                            @endforeach
                        </div>
                    @endif
                    <div class="absolute-full bg-white opacity-0 d-md-none"></div>
            </div>
            
            <div class="container position-relative d-flex flex-column ">
                <div class="row pt-11 pb-8 my-auto align-items-center">
                    
                    @if (!Auth::check() && get_setting('show_homepage_slider_registration') == 'on')
                        <div class=" col-lg-6 col-xxl-5 col-md-8 " data-aos="fade-up"  data-aos-duration="1500" >
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4 text-center">
                                        <h2 class="h3 text-primary mb-0" data-aos="fade-down"  data-aos-duration="1500" >{{ translate('Create Your Account') }}</h2>
                                        <p data-aos="fade-up"  data-aos-duration="2000" >{{ translate('Fill out the form to get started') }}.</p>
                                    </div>
                                    <form class="form-default" id="reg-form" role="form"
                                        action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                        for="on_behalf">{{ translate('On Behalf') }}</label>
                                                    @php $on_behalves = \App\Models\OnBehalf::all(); @endphp
                                                    <select
                                                        class="form-control aiz-selectpicker @error('on_behalf') is-invalid @enderror"
                                                        name="on_behalf" required>
                                                        @foreach ($on_behalves as $on_behalf)
                                                            <option value="{{ $on_behalf->id }}">{{ $on_behalf->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('on_behalf')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                        for="name">{{ translate('First Name') }}</label>
                                                    <input type="text"
                                                        class="form-control @error('first_name') is-invalid @enderror"
                                                        name="first_name" id="first_name"
                                                        placeholder="{{ translate('First Name') }}" required>
                                                    @error('first_name')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                        for="name">{{ translate('Last Name') }}</label>
                                                    <input type="text"
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        name="last_name" id="last_name"
                                                        placeholder="{{ translate('Last Name') }}" required>
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                        for="gender">{{ translate('Gender') }}</label>
                                                    <select
                                                        class="form-control aiz-selectpicker @error('gender') is-invalid @enderror"
                                                        name="gender" required>
                                                        <option value="1">{{ translate('Male') }}</option>
                                                        <option value="2">{{ translate('Female') }}</option>
                                                    </select>
                                                    @error('gender')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                        for="name">{{ translate('Date Of Birth') }}</label>
                                                    <input type="text"
                                                        class="form-control aiz-date-range @error('date_of_birth') is-invalid @enderror"
                                                        name="date_of_birth" id="date_of_birth"
                                                        placeholder="{{ translate('Date Of Birth') }}" data-single="true"
                                                        data-show-dropdown="true" data-max-date="{{ get_max_date() }}"
                                                        autocomplete="off" required>
                                                    @error('date_of_birth')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        @if (addon_activation('otp_system'))
                                            <div>
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <label class="form-label"
                                                        for="email">{{ translate('Email / Phone') }}</label>
                                                    <button class="btn btn-link p-0 opacity-50 text-reset fs-12"
                                                        type="button"
                                                        onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                                </div>
                                                <div class="form-group phone-form-group mb-1">
                                                    <input type="tel" id="phone-code"
                                                        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                        value="{{ old('phone') }}" placeholder="" name="phone"
                                                        autocomplete="off">
                                                </div>

                                                <input type="hidden" name="country_code" value="">

                                                <div class="form-group email-form-group mb-1 d-none">
                                                    <input type="email"
                                                        class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                        value="{{ old('email') }}"
                                                        placeholder="{{ translate('Email') }}" name="email"
                                                        autocomplete="off">
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label"
                                                            for="email">{{ translate('Email address') }}</label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" id="signinSrEmail"
                                                            placeholder="{{ translate('Email Address') }}">
                                                        @error('email')
                                                            <span class="invalid-feedback"
                                                                role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                        for="password">{{ translate('Password') }}</label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" placeholder="********" aria-label="********"
                                                        required>
                                                    <small>{{ translate('Minimun 8 characters') }}</small>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                        for="password-confirm">{{ translate('Confirm password') }}</label>
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation" placeholder="********" required>
                                                    <small>{{ translate('Minimun 8 characters') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        @if (addon_activation('referral_system'))
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label"
                                                            for="email">{{ translate('Referral Code') }}</label>
                                                        <input type="text"
                                                            class="form-control{{ $errors->has('referral_code') ? ' is-invalid' : '' }}"
                                                            value="{{ old('referral_code') }}"
                                                            placeholder="{{ translate('Referral Code') }}"
                                                            name="referral_code">
                                                        @if ($errors->has('referral_code'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('referral_code') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if (get_setting('google_recaptcha_activation') == 1)
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                                @error('g-recaptcha-response')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" name="checkbox_example_1" required>
                                                <span class=opacity-60>{{ translate('By signing up you agree to our') }}
                                                    <a href="{{ env('APP_URL') . '/terms-conditions' }}"
                                                        target="_blank">{{ translate('terms and conditions') }}.</a>
                                                </span>
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>
                                        @error('checkbox_example_1')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror

                                        <div class="">
                                            <button type="submit"
                                                class="btn btn-block btn-primary">{{ translate('Create Account') }}</button>
                                        </div>
                                        @if (get_setting('google_login_activation') == 1 || get_setting('facebook_login_activation') == 1 || get_setting('twitter_login_activation') == 1 || get_setting('apple_login_activation') == 1)
                                            <div class="mt-4">
                                                <div class="separator mb-3">
                                                    <span class="bg-white px-3">{{ translate('Or Join With') }}</span>
                                                </div>
                                                <ul class="list-inline social colored text-center">
                                                    @if (get_setting('facebook_login_activation') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}"
                                                                class="facebook"
                                                                title="{{ translate('Facebook') }}"><i
                                                                    class="lab la-facebook-f"></i></a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('google_login_activation') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                                                class="google"
                                                                title="{{ translate('Google') }}"><i
                                                                    class="lab la-google"></i></a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('twitter_login_activation') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}"
                                                                class="twitter"
                                                                title="{{ translate('Twitter') }}"><i
                                                                    class="lab la-twitter"></i></a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('apple_login_activation') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'apple']) }}"
                                                                class="apple"
                                                                title="{{ translate('Apple') }}"><i
                                                                    class="lab la-apple"></i></a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-6 col-xxl-7 my-4 col-md-3">
                        <div class="text-dark home-slider-text text-center" data-aos="fade-up"  data-aos-duration="2000" >
                            {!! get_setting('home_slider_text') !!}
                        </div>
                    </div>
                    
                </div>

                <!-- search  -->
                @if (Auth::check() && Auth::user()->user_type == 'member')
                    <div class="p-4 bg-white rounded-top border-bottom"
                        style="box-shadow: 0 -25px 50px -12px rgb(0 0 0 / 25%);">
                        <div class="row">
                            <div class="col-xl-10 mx-auto">
                                <form action="{{ route('member.listing') }}" method="get">
                                    <div class="row gutters-5">
                                        <div class="col-lg">
                                            <div class="form-group mb-3">
                                                <label class="form-label"
                                                    for="name">{{ translate('Age From') }}</label>
                                                <input type="number" name="age_from" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="name">{{ translate('To') }}</label>
                                                <input type="number" name="age_to" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg">
                                            <div class="form-group mb-3">
                                                <label class="form-label"
                                                    for="name">{{ translate('Religion') }}</label>
                                                @php $religions = \App\Models\Religion::all(); @endphp
                                                <select name="religion_id" id="religion_id"
                                                    class="form-control aiz-selectpicker" data-live-search="true"
                                                    data-container="body">
                                                    <option value="">{{ translate('Choose One') }}</option>
                                                    @foreach ($religions as $religion)
                                                        <option value="{{ $religion->id }}"> {{ $religion->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg">
                                            <div class="form-group mb-3">
                                                <label class="form-label"
                                                    for="name">{{ translate('Mother Tongue') }}</label>
                                                @php $mother_tongues = \App\Models\MemberLanguage::all(); @endphp
                                                <select name="mother_tongue" class="form-control aiz-selectpicker"
                                                    data-live-search="true" data-container="body">
                                                    <option value="">{{ translate('Select One') }}</option>
                                                    @foreach ($mother_tongues as $mother_tongue_select)
                                                        <option value="{{ $mother_tongue_select->id }}">
                                                            {{ $mother_tongue_select->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg">
                                            <button type="submit"
                                                class="btn btn-block btn-primary mt-4">{{ translate('Search') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif

    <!-- premium member Section -->
    @if (get_setting('show_premium_member_section') == 'on')
        <section class="pt-7 bg-white"  data-aos="fade-up"  data-aos-duration="2000">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-8 col-xxl-6 mx-auto">
                        <div class="text-center section-title mb-5">
                            <h2 class="fw-600 mb-3 text-dark">{{ get_setting('premium_member_section_title') }}</h2>
                            <p class="fw-400 fs-16 opacity-60">{{ get_setting('premium_member_section_sub_title') }}</p>
                        </div>
                    </div>
                </div>
                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="5" data-xl-items="4" data-lg-items="4"
                    data-md-items="3" data-sm-items="2" data-xs-items="1" data-dots='true' data-infinite='true'>
                    @foreach ($premium_members as $key => $member)
                        <div class="carousel-box">
                            @include('frontend.inc.member_box_1',['member'=>$member])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    
    <!--welcome section-->
    <style>
       .ab-wel {
            padding: 100px 0px;
        }
        .ab-wel-lhs {
            position: relative;
        }
        .ab-wel-lhs span {
            position: absolute;
        }
        
       
        .ab-wel-1 {
            position: absolute;
            width: 75%;
            height: 550px;
            object-fit: cover;
            left: 0px;
            top: 0px;
            border-radius: 15px;
        }
        .ab-wel-2 {
            width: 80%;
            height: 300px;
            object-fit: cover;
            z-index: 1;
            position: relative;
            margin: 47% 10% 5% 15%;
            border-width: 15px 0px 0px 15px;
            border-top-style: solid;
            border-left-style: solid;
            border-top-color: rgb(255, 255, 255);
            border-left-color: rgb(255, 255, 255);
            border-image: initial;
            border-right-style: initial;
            border-right-color: initial;
            border-bottom-style: initial;
            border-bottom-color: initial;
            border-radius: 0px 100px 15px;
        }
        .ab-wel-3 {
            width: 100px;
            height: 100px;
            border: 7px solid rgb(240, 168, 5);
            border-radius: 50%;
            left: -39px;
            top: -32px;
            z-index: 0;
        }
        .ab-wel-4 {
            width: 200px;
            height: 200px;
            border: 7px solid rgb(255, 226, 240);
            border-radius: 20px;
            right: 9px;
            bottom: -4px;
        }
        .ab-wel-rhs {
            float: left;
            width: 100%;
            padding-left: 25px;
        }
        .ab-wel-tit h2 {
            font-size: 58px;
            font-weight: 700;
            padding-bottom: 10px;
            color: #66451c;
            line-height: 44px;
            font-family: 'Cinzel Decorative', cursive;
        }
        .ab-wel-tit h2 em {
            display: block;
            color: #e5026b;
            font-weight: 700;
            font-size: 35px;
            font-family: var(--tit-font);
            font-family: 'Cinzel Decorative', cursive;
            line-height: 78px;
        }
        .ab-wel-rhs p {
            font-size: 15px;
            font-weight: 500;
            line-height: 25px;
        }
        .ab-wel-tit-1 {
            border-top: 1px solid rgb(217, 217, 217);
            margin-top: 25px;
            padding-top: 25px;
        }
        .ab-wel-tit-2 {
            float: left;
            width: 100%;
            padding-top: 30px;
        }
        .ab-wel-tit-2 ul{
            
            list-style:none;
        }
        .ab-wel-tit-2 ul li {
            float: left;
            width: 50%;
        }
        .ab-wel-tit-2 ul li div {
            position: relative;
        }
        .ab-wel-tit-2 ul li div i {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 42px;
            height: 42px;
            background: #000;
            border-radius: 50%;
            color: rgb(255, 255, 255);
            text-align: center;
            padding: 9px;
            box-shadow: rgb(0 0 0 / 10%) 0px 0px 0px 8px;
            font-size: 18px;
            line-height: 25px;
        }
        .ab-wel-tit-2 ul li div h4 {
            padding: 0px 0px 0px 60px;
            font-size: 15px;
            color: rgb(122, 122, 122);
        }
        .ab-wel-tit-2 ul li div h4 em {
            display: block;
            font-size: 18px;
            color: rgb(0, 0, 0);
            font-weight: 600;
            padding-top: 5px;
        }
        /*count*/
        .ab-cont {
            padding-bottom: 0;
        }
        .ab-cont ul {
            float: left;
            width: 100%;
            list-style:none;
        }
        .ab-cont ul li {
            float: left;
            width: 25%;
        }
        .ab-cont ul li .ab-cont-po {
            position: relative;
            border: 1px solid #d7d1be;
            border-left: 0;
            padding: 20px;
        }
        .ab-cont ul li:last-child .ab-cont-po {
            border-right: 0;
        }
        .ab-cont ul li .ab-cont-po i {
            font-size: 20px;
            position: absolute;
            left: 25px;
            top: 25px;
            color: #66451c;
            border: 1px solid #b79b79;
            padding: 8px 0px;
            border-radius: 10px;
            vertical-align: middle;
            width: 38px;
            height: 38px;
            text-align: center;
            transition: all 0.4s ease;
        }
        .ab-cont ul li .ab-cont-po div {
            padding: 0 0 0 55px;
        }
        .ab-cont ul li .ab-cont-po div h4 {
            font-weight: 700;
            font-size: 40px;
            /* color: #00306e; */
            font-family: 'Cinzel Decorative', cursive;
        }
        .ab-cont ul li .ab-cont-po div span {
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 400;
        }
        @media screen and (max-width: 1250px) {
            .ab-wel-tit-2 ul li div h4 em {
                font-size: 14px;
            }
        }
        @media screen and (max-width: 992px) {
            .ab-wel-lhs {
                margin-bottom: 50px;
            }
            /*count*/
            .ab-cont ul li .ab-cont-po i {
                position: relative;
                left: initial;
                top: initial;
                margin: 0 auto;
                display: table;
            }
            .ab-cont ul li .ab-cont-po div {
                padding: 25px 0 0 0;
                text-align: center;
            }
            .ab-cont ul li .ab-cont-po div h4 {
                font-size: 26px;
            }
        }
        
        @media screen and (max-width: 769px) {
            .ab-wel {
                padding: 70px 0;
            }
            .ab-wel-lhs {
                display: none;
            }
            .ab-wel-rhs {
                padding-left: 0;
            }
            .ab-wel-tit-2 ul li {
                width: 100%;
                padding-bottom: 30px;
            }
            .ab-wel-tit-2 ul li:last-child {
                padding-bottom: 0;
            }
            /*count*/
            .ab-cont {
                padding-bottom: 20px;
            }
            .ab-cont ul li {
                width: 50%;
            }
            .ab-cont ul li .ab-cont-po, .ab-cont ul li:last-child .ab-cont-po {
                border: 1px solid #d7d1be;
                margin: 10px;
                padding: 30px 20px 25px 20px;
            }
        }
        @media screen and (max-width: 550px) {
            .ab-wel-tit h2 {
                font-size: 34px;
                line-height: 40px;
            }
            .ab-wel-tit h2 em {
                line-height: 32px;
                font-size: 26px;
                padding-top: 10px;
            }
        }
        @media screen and (max-width: 400px) {
            .ab-cont ul li .ab-cont-po, .ab-cont ul li:last-child .ab-cont-po {
                margin: 3px;
                padding: 30px 10px 25px 10px;
            }
        }
        
    </style>
    <section>
      <div class="ab-wel">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="ab-wel-lhs">
                <span class="ab-wel-3"></span>
                <img data-aos="fade-down"  data-aos-duration="2000" src="https://rn53themes.net/themes/matrimo/images/about/1.jpg" alt="" loading="lazy" class="ab-wel-1">
                <img data-aos="fade-up"  data-aos-duration="2000" src="https://rn53themes.net/themes/matrimo/images/couples/20.jpg" alt="" loading="lazy" class="ab-wel-2">
                <span class="ab-wel-4"></span>
              </div>
            </div>
            <div class="col-lg-6"  data-aos="fade-left" data-aos-anchor="#example-anchor" data-aos-duration="1000">
              <div class="ab-wel-rhs">
                <div class="ab-wel-tit">
                  <h2>Welcome to <em>Wedding matrimony</em>
                  </h2>
                  <p>Best wedding matrimony It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                  <p>
                    <a href="packages">Click here to</a> Start you matrimony service now.
                  </p>
                </div>
                <div class="ab-wel-tit-1">
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                </div>
                <div class="ab-wel-tit-2">
                  <ul>
                    <li>
                      <div>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <h4>Enquiry <em>+01 2242 3366</em>
                        </h4>
                      </div>
                    </li>
                    <li>
                      <div>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <h4>Get Support <em>info@example.com</em>
                        </h4>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!--welcome section end-->
    
    <!--count -->
    <section>
        <div class="ab-cont"  data-aos="fade-up"  data-aos-duration="1000"  data-aos-anchor-placement="top-bottom">
            <div class="container">
                <div class="row">
                    <ul>
                        <li>
                            <div class="ab-cont-po">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                <div>
                                    <h4>2K</h4>
                                    <span>Couples pared</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ab-cont-po">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <div>
                                    <h4>4000+</h4>
                                    <span>Registerents</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ab-cont-po">
                                <i class="fa fa-male" aria-hidden="true"></i>
                                <div>
                                    <h4>1600+</h4>
                                    <span>Mens</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ab-cont-po">
                                <i class="fa fa-female" aria-hidden="true"></i>
                                <div>
                                    <h4>2000+</h4>
                                    <span>Womens</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--count end-->

    <!-- Banner section 1 -->
    @if (get_setting('show_home_banner1_section') == 'on' && get_setting('home_banner1_images') != null)
        <section class="pt-7 bg-white d-none">
            <div class="container">
                <div class="row gutters-10">
                    @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                    @foreach ($banner_1_imags as $key => $value)
                        <div class="col-xl col-md-6">
                            <div class="mb-3">
                                <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}"
                                    class="d-block text-reset">
                                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                        data-src="{{ uploaded_asset($banner_1_imags[$key]) }}"
                                        alt="{{ env('APP_NAME') }}" class="img-fluid lazyload w-100">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- How It Works Section -->
    @if (get_setting('show_how_it_works_section') == 'on' && get_setting('how_it_works_steps_titles') != null)
    <style>
        .inn {
            margin: 0 auto;
            width: 70%;
        }
        .inn ul {
            position: relative;
            float: left;
            width: 100%;
            list-style: none;
        }
        .inn ul:before {
            content: '';
            background: #ddcebc;
            position: absolute;
            width: 1px;
            top: 5px;
            bottom: 0;
            height: 98%;
            left: 50%;
        }
        .inn ul li {
            position: relative;
            float: left;
            width: 100%;
            padding-bottom: 50px;
        }
        .inn ul li:before {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            background: #66451c;
            z-index: 1;
            border-radius: 50px;
            border: 5px solid #fff;
            box-sizing: border-box;
            margin-top: 2px;
            box-shadow: 0 0px 10px 0.6px rgb(40 30 20 / 8%);
            left: calc(50% - 32px); /* Center the dot */
        }
        .tline-inn {
            display: flex;
            align-items: center;
        }
        .tline-im {
            width: 50%;
            padding-right: 70px;
        }
        .tline-con {
            width: 50%;
            padding: 0 0 0 70px;
        }
        .tline-inn div p {
            padding: 20px 0 15px 0;
            margin: 0;
            font-size: 16px;
            line-height: 27px;
        }
        .tline-inn div h5 {
            font-family: var(--tit-font);
            font-size: 30px;
        }
        .tline-inn img {
            width: 128px;
            height: 128px;
            object-fit: contain;
            max-width: 100%;
        }
    
        /* Alternate left-right layout */
        .inn ul li:nth-child(odd) .tline-im {
            order: 1;
            padding-right: 70px;
            padding-left: 0;
        }
        .inn ul li:nth-child(odd) .tline-con {
            order: 2;
            padding-left: 70px;
            padding-right: 0;
        }
        .inn ul li:nth-child(even) .tline-im {
            order: 2;
            padding-left: 70px;
            padding-right: 0;
        }
        .inn ul li:nth-child(even) .tline-con {
            order: 1;
            padding-right: 70px;
            padding-left: 0;
        }
    
        @media screen and (max-width: 769px) {
            .tline-inn div h5 {
                font-size: 22px;
            }
            .inn {
                width: 100%;
                padding-top: 20px;
            }
        }
        
        @media screen and (max-width: 650px) {
            .tline-im {
                width: 74px;
                padding: 0;
            }
            .tline-con {
                width: calc(100% - 74px);
                padding: 0 0 0 60px;
            }
            .inn ul:before {
                left: 140px;
            }
            .inn ul li:before {
                left: 88px;
            }
            .tline-im img {
                width: 74px;
            }
            /* Alternate left-right layout */
            .inn ul li:nth-child(odd) .tline-im {
                order: 1;
                padding-right: 0;
                padding-left: 0;
            }
            .inn ul li:nth-child(odd) .tline-con {
                order: 2;
                padding-left: 70px;
                padding-right: 0;
            }
            .inn ul li:nth-child(even) .tline-im {
                order: 1;
                padding-left: 0;
                padding-right: 0;
            }
            .inn ul li:nth-child(even) .tline-con {
                order: 2;
                padding-left: 70px;
                padding-right: 0;
            }
        }
        @media screen and (max-width: 480px) {
            .tline-inn div h5 {
                font-size: 24px;
            }
        }
    </style>
    
        <section class="py-7 bg-white">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-10 col-xl-8 col-xxl-6 mx-auto">
                       
                        <div class="text-center section-title mb-5">
                            <h2 class="fw-600 mb-3">{{ get_setting('how_it_works_title') }}</h2>
                            <p class="fw-300 fs-16 opacity-60">{{ get_setting('how_it_works_sub_title') }}</p>
                        </div>
                    </div>
                </div>

                <div class="inn">
                    <ul>
                        @php
                            $how_it_works_steps_titles = json_decode(get_setting('how_it_works_steps_titles'));
                            $step = 1;
                        @endphp
                        @foreach ($how_it_works_steps_titles as $key => $how_it_works_steps_title)
                            <li data-aos="fade-up"  data-aos-duration="2000"  data-aos-anchor-placement="top-bottom">
                                <div class="tline-inn">
                                    <div class="tline-im">
                                        <img src="{{ uploaded_asset(json_decode(get_setting('how_it_works_steps_icons'), true)[$key]) }}" loading="lazy">
                                    </div>
                                    <div class="tline-con">
                                        <div class="text-primary fw-600 h1 d-none">{{ $step++ }}</div>
                                        <h5>{{ $how_it_works_steps_title }}</h5>
                                        <p>
                                            {{ json_decode(get_setting('how_it_works_steps_sub_titles'), true)[$key] }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    @endif

    <!-- Trusted by Millions Section -->
    @if (get_setting('show_trusted_by_millions_section') == 'on')
        <section class="bg-center bg-cover min-vh-100 py-7 text-white d-flex align-items-center bg-fixed"
            style="background-image: url('{{ uploaded_asset(get_setting('trusted_by_millions_background_image')) }}')">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="text-center pb-12">
                            <h2 class="fw-600">{{ get_setting('trusted_by_millions_title') }}</h2>
                            <div class="fs-16 fw-400">{{ get_setting('trusted_by_millions_sub_title') }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $homepage_best_features = json_decode(get_setting('homepage_best_features'));
                    @endphp
                    @if (!empty($homepage_best_features))
                        @foreach ($homepage_best_features as $key => $homepage_best_feature)
                            <div class="col-lg">
                                <div class="border rounded position-relative z-1 border-gray-600 overflow-hidden mt-4">
                                    <div class="absolute-full bg-dark opacity-60 z--1"></div>
                                    <div class="px-4 py-5 d-flex align-items-center justify-content-center">
                                        <img src="{{ uploaded_asset(json_decode(get_setting('homepage_best_features_icons'), true)[$key]) }}"
                                            class="img-fluid h-20px">
                                        <span class="fs-17 ml-2">{{ $homepage_best_feature }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- New Member Section -->
    @if (get_setting('show_new_member_section') == 'on')
        <section class="py-7 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-8 col-xxl-6 mx-auto">
                        <div class="text-center section-title mb-5">
                            <h2 class="fw-600 mb-3 text-dark">{{ get_setting('new_member_section_title') }}</h2>
                            <p class="fw-400 fs-16 opacity-60">{{ get_setting('new_member_section_sub_title') }}</p>
                        </div>
                    </div>
                </div>
                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="5" data-xl-items="4" data-lg-items="4"
                    data-md-items="3" data-sm-items="2" data-xs-items="1" data-dots='true' data-infinite='true'>
                    @foreach ($new_members as $key => $member)
                        <div class="carousel-box">
                            @include('frontend.inc.member_box_1',['member'=>$member])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- happy Story Section -->
    @if (get_setting('show_happy_story_section') == 'on')
        <section class="py-7 bg-dark text-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-8 col-xxl-6 mx-auto">
                        <div class="text-center section-title mb-5">
                            <h2 class="fw-600 mb-3">Happy Stories</h2>
                        </div>
                    </div>
                </div>
                <div
                    class="card-columns column-gap-10 card-columns-xxl-4 card-columns-lg-3 card-columns-md-2 card-columns-1">
                    @php
                        $happy_stories = \App\Models\HappyStory::where('approved', '1')
                            ->latest()
                            ->limit(get_setting('max_happy_story_show_homepage'))
                            ->get();
                    @endphp
                    @foreach ($happy_stories as $key => $happy_story)
                        @php
                            $photo = explode(',', $happy_story->photos);
                        @endphp
                        <div class="card border-gray-800 overflow-hidden mb-2">
                            <a href="{{ route('story_details', $happy_story->id) }}"
                                class="text-reset d-block position-relative">
                                <img src="{{ uploaded_asset($photo[0]) }}" class="img-fluid">
                                <div class="absolute-bottom-left p-3">
                                    <div class="position-relative z-1 p-3">
                                        <div class="absolute-full z--1 bg-dark opacity-60"></div>
                                        <div class="text-primary text-truncate">
                                            {{ $happy_story->user->first_name . ' & ' . $happy_story->partner_name }}</div>
                                        <h2 class="h5 mb-0 fs-14 fw-400 lh-1-5 text-truncate-3">
                                            {{ $happy_story->title }}
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('happy_stories') }}" class="btn btn-primary">{{ translate('View More') }}</a>
                </div>
            </div>
        </section>
    @endif

    @if (get_setting('show_homapege_package_section') == 'on')
        <section class="py-7 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-xxl-6 mx-auto">
                        <div class="text-center pb-6">
                            <h2 class="fw-600 text-dark">{{ get_setting('homepage_package_section_title') }}</h2>
                            <div class="fs-16 fw-400">{{ get_setting('homepage_package_section_sub_title') }}</div>
                        </div>
                    </div>
                </div>
                <div class="aiz-carousel" data-items="4" data-xl-items="3" data-md-items="2" data-sm-items="1"
                    data-dots='true' data-infinite='true' data-autoplay='true'>
                    @foreach (\App\Models\Package::where('active', '1')->get() as $key => $package)
                        <div class="carousel-box">
                            <div class="overflow-hidden shadow-none mb-3 border-right">
                                <div class="card-body">
                                    <div class="text-center mb-4 mt-3">
                                        <img class="mw-100 mx-auto mb-4" src="{{ uploaded_asset($package->image) }}"
                                            height="130">
                                        <h5 class="mb-3 h5 fw-600">{{ $package->name }}</h5>
                                    </div>
                                    <ul class="list-group list-group-raw fs-15 mb-5">
                                        <li class="list-group-item py-2">
                                            <i class="las la-check text-success mr-2"></i>
                                            {{ $package->express_interest }} {{ translate('Express Interests') }}
                                        </li>
                                        <li class="list-group-item py-2">
                                            <i class="las la-check text-success mr-2"></i>
                                            {{ $package->photo_gallery }} {{ translate('Gallery Photo Upload') }}
                                        </li>
                                        <li class="list-group-item py-2">
                                            <i class="las la-check text-success mr-2"></i>
                                            {{ $package->contact }} {{ translate('Contact Info View') }}
                                        </li>
                                        <li class="list-group-item py-2 text-line-through">
                                            @if ($package->auto_profile_match == 0)
                                                <i class="las la-times text-danger mr-2"></i>
                                                <del
                                                    class="opacity-60">{{ translate('Show Auto Profile Match') }}</del>
                                            @else
                                                <i class="las la-check text-success mr-2"></i>
                                                {{ translate('Show Auto Profile Match') }}
                                            @endif
                                        </li>
                                    </ul>
                                    <div class="mb-5 text-dark text-center">
                                        @if ($package->id == 1)
                                            <span class="display-4 fw-600 lh-1 mb-0">{{ translate('Free') }}</span>
                                        @else
                                            <span
                                                class="display-4 fw-600 lh-1 mb-0">{{ single_price($package->price) }}</span>
                                        @endif
                                        <span class="text-secondary d-block">{{ $package->validity }}
                                            {{ translate('Days') }}</span>
                                    </div>
                                    <div class="text-center mb-3">
                                        @if ($package->id != 1)
                                            @if (Auth::check())
                                                <a href="{{ route('package_payment_methods', encrypt($package->id)) }}"
                                                    type="submit"
                                                    class="btn btn-primary">{{ translate('Purchase This Package') }}</a>
                                            @else
                                                <button type="submit" onclick="loginModal()"
                                                    class="btn btn-primary">{{ translate('Purchase This Package') }}</button>
                                            @endif
                                        @else
                                            <a href="javascript:void(0);"
                                                class="btn btn-light"><del>{{ translate('Purchase This Package') }}</del></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (get_setting('show_homepage_review_section') == 'on' && get_setting('homepage_reviews') != null)
        <style>
            .cus-revi-box {
                border: 1px solid rgb(219, 204, 187);
                padding: 90px 35px 30px;
                border-radius: 10px;
                position: relative;
                margin: 0px 15px;
            }

            .cus-revi-box .revi-im {
                position: absolute;
                top: -65px;
            }
             .cus-revi-box .revi-im img {
                width: 130px;
                height: 130px;
                object-fit: cover;
                border-radius: 10px;
                clip-path: polygon(50% 0px, 100% 50%, 50% 100%, 0px 50%);
            }
            .cus-revi-box .revi-im i.cir-1 {
                border: 3px solid rgb(253, 134, 134);
                left: -5px;
                top: 1px;
            }
            .cus-revi-box .revi-im i.cir-2 {
                border: 3px solid rgb(189, 204, 255);
                left: 114px;
                top: 12px;
            }
            .cus-revi-box .revi-im i.cir-3 {
                border: 3px solid rgb(255, 198, 0);
                left: -17px;
                top: 86px;
            }
            .cus-revi-box .revi-im i {
                position: absolute;
                width: 12px;
                height: 12px;
                transition: all 0.5s ease 0s;
            }
           
            
            .cus-revi-box p {
                font-size: 15px;
                line-height: 23px;
            }
        </style>
        <section class="py-7 bg-cover bg-center text-white"
            style="background-image: url('{{ uploaded_asset(get_setting('homepage_review_section_background_image')) }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-9 col-xxl-6 mx-auto">
                        <div class="text-center section-title mb-5">
                            <h2 class="fw-600 mb-3">{{ get_setting('homepage_review_section_title') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up"  data-aos-duration="2000"  data-aos-anchor-placement="top-bottom">
                    <div class="col-xxl-10 mx-auto">
                        <div class="aiz-carousel large-arrow" data-items="1" data-arrows='true' data-infinite='true'
                            data-autoplay='true'>
                            @foreach (json_decode(get_setting('homepage_reviews')) as $key => $review)
                                <div class="carousel-box">
                                    <div style="display: ruby-text;">
                                        <div class="cus-revi-box">
                                            <div class="revi-im">
                                                <img src="{{ uploaded_asset(json_decode(get_setting('homepage_reviewers_images'), true)[$key]) }}" alt="" loading="lazy">
                                                <i class="cir-com cir-1"></i>
                                                <i class="cir-com cir-2"></i>
                                                <i class="cir-com cir-3"></i>
                                            </div>
                                            <p>{{ $review }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (get_setting('show_blog_section') == 'on')
        <section class="py-7 bg-white text-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-8 col-xxl-6 mx-auto">
                        <div class="text-center section-title mb-5">
                            <h2 class="fw-600 mb-3 text-dark">{{ get_setting('blog_section_title') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="aiz-carousel gutters-10" data-items="4" data-xl-items="3" data-md-items="2" data-sm-items="1"
                    data-arrows='true'>
                    @php
                        $blogs = \App\Models\Blog::query()
                            ->where('status', 1)
                            ->latest()
                            ->limit(get_setting('max_blog_show_homepage'))
                            ->get();
                    @endphp
                    @foreach ($blogs as $key => $blog)
                        <div class="caorusel-box p-1">
                            <div class="card mb-3 overflow-hidden shadow-sm text-dark">
                                <a href="{{ route('blog.details', $blog->slug) }}" class="text-reset d-block">
                                    <img src="{{ uploaded_asset($blog->banner) }}" alt="{{ $blog->title }}"
                                        class="h-200px img-fit">
                                </a>
                                <div class="p-4">
                                    <h2 class="fs-18 fw-600 mb-1">
                                        <a href="{{ route('blog.details', $blog->slug) }}" class="text-reset">
                                            {{ $blog->title }}
                                        </a>
                                    </h2>
                                    @if ($blog->category != null)
                                        <div class="mb-2 opacity-50">
                                            <i>{{ $blog->category->category_name }}</i>
                                        </div>
                                    @endif
                                    <p class="opacity-70 mb-4">{{ $blog->short_description }}</p>
                                    <a href="{{ route('blog.details', $blog->slug) }}"
                                        class="btn btn-soft-primary">{{ translate('View More') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('blog') }}" class="btn btn-primary">{{ translate('View More') }}</a>
                </div>
            </div>
        </section>
    @endif

@endsection

@section('modal')
    @include('modals.login_modal')
    @include('modals.package_update_alert_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function loginModal() {
            $('#LoginModal').modal();
        }

        function package_update_alert() {
            $('.package_update_alert_modal').modal('show');
        }
    </script>
    @if(get_setting('google_recaptcha_activation') == 1)
        @include('partials.recaptcha')
    @endif
    @if(addon_activation('otp_system'))
        @include('partials.emailOrPhone')
    @endif
@endsection
