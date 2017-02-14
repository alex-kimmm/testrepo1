<section class="insurance-benefits cd-intro">
    <div class="row">
        <div class="header cd-intro-background" @if($insurance_page->getImageUrl() && !$insurance_page->getVideoUrl() ) style="background-image: url('{{$insurance_page->getImageUrl()}}');" @endif>
            <div class="text-deco">{{$insurance_page->title}}</div>
            <div class="benefits-label"><span class="general">{!!$insurance_page->subtitle!!}</span></div>
            <div class="row">
                <div class="benefits-arrow"></div>
            </div>
            @if($insurance_page->getVideoUrl())
                <video autoplay id="bgvid" loop class="hidden-xs">
                    <source src="{{$insurance_page->getVideoUrl()}}" type="video/mp4">
                </video>
                <div class="video-mobile hidden-lg hidden-md hidden-sm" style="background-image: url('{{$insurance_page->getImageUrl()}}');"></div>
            @endif
        </div>
    </div>
</section>

@include('frontend.insurances.inc.step_menu_btns', ['current_step' => 2])

<section class="insurance-benefits-desc insurance-desc" style="{{ $insurance_page->gradient->summary }}">

    <?php
    $alignVars = ['right','left'];
    $key = 0;
    ?>
    @if(count($insurance_page->blocks))
        @foreach($insurance_page->blocks as $insurance_block)

            <?php $align = $alignVars[$key%2];?>

            <div class="row">
                @if($insurance_block->getImageUrl())
                    <div class="col-md-6 col-sm-6 col-xs-6 pull-{{$alignVars[$key%2]}}" style="overflow: hidden;">
                        <div class="hidden-xs"><img src="{{$insurance_block->getImageUrl()}}" class="img-responsive"></div>
                        <div class="visible-xs"><img src="{{$insurance_block->getImageMobileUrl()? $insurance_block->getImageMobileUrl() : $insurance_block->getImageUrl()}}" class="img-responsive"></div>
                    </div>
                @endif
                <?php $col_XS_CSS_Class = ($insurance_block->getImageUrl())? 'col-xs-6' : 'col-xs-12'; ?>
                <?php $info_CSS_Class = ($insurance_block->getImageUrl())? 'left' : $alignVars[($key+1)%2] ; ?>
                <div class="col-md-6 col-sm-6 {{$col_XS_CSS_Class}} pull-{{$alignVars[($key+1)%2]}}">

                    @if(!$insurance_block->title_hidden && $insurance_block->title != '')
                        <div class="nav-points {{ $alignVars[($key+1)%2] }}">
                            <span>{{$insurance_block->title}}</span>
                        </div>
                    @endif

                    <div class="info {{$info_CSS_Class}}">
                        <div class="title">{{$insurance_block->heading}}</div>
                        <p>{{$insurance_block->summary}}</p>

                        @if(
                            $insurance_block->getFirstLogoImageUrl() ||
                            $insurance_block->getSecondLogoImageUrl() ||
                            $insurance_block->getThirdLogoImageUrl()
                        )
                        <div class="logos hidden-sm hidden-xs">
                            <div class="text-deco">{{$insurance_block->decor_heading}}</div>
                            <div class="row taste-it text-center">

                                @if($insurance_block->getFirstLogoImageUrl())
                                    <div class="col-lg-4 col-md-4 hidden-xs logo-block">
                                        <img src="{{$insurance_block->getFirstLogoImageUrl()}}" class="img-responsive">
                                        <p class="yellow-text">{{$insurance_block->first_logo_text}}</p>
                                        <p>{{$insurance_block->first_logo_description}}</p>
                                    </div>
                                @endif

                                @if($insurance_block->getSecondLogoImageUrl())
                                    <div class="col-lg-4 col-md-4 hidden-xs logo-block">
                                        <img src="{{$insurance_block->getSecondLogoImageUrl()}}" class="img-responsive">
                                        <p class="yellow-text">{{$insurance_block->second_logo_text}}</p>
                                        <p>{{$insurance_block->second_logo_description}}</p>
                                    </div>
                                @endif

                                @if($insurance_block->getThirdLogoImageUrl())
                                    <div class="col-lg-4 col-md-4 hidden-xs logo-block">
                                        <img src="{{$insurance_block->getThirdLogoImageUrl()}}" class="img-responsive">
                                        <p class="yellow-text">{{$insurance_block->third_logo_text}}</p>
                                        <p>{{$insurance_block->third_logo_description}}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif


                    </div>
                </div>
            </div>

            @if(
                $insurance_block->getFirstLogoImageUrl() ||
                $insurance_block->getSecondLogoImageUrl() ||
                $insurance_block->getThirdLogoImageUrl()
            )
            <div class="row visible-sm">
                <div class="logos">
                    <div class="text-deco text-center">{{$insurance_block->decor_heading}}</div>
                    <div class="row taste-it text-center">
                        @if($insurance_block->getFirstLogoImageUrl())
                            <div class="col-sm-4 logo-block">
                                <img src="{{$insurance_block->getFirstLogoImageUrl()}}" class="img-responsive">
                                <p class="yellow-text">{{$insurance_block->first_logo_text}}</p>
                                <p>{{$insurance_block->first_logo_description}}</p>
                            </div>
                        @endif
                        @if($insurance_block->getSecondLogoImageUrl())
                            <div class="col-sm-4 logo-block">
                                <img src="{{$insurance_block->getSecondLogoImageUrl()}}" class="img-responsive">
                                <p class="yellow-text">{{$insurance_block->second_logo_text}}</p>
                                <p>{{$insurance_block->second_logo_description}}</p>
                            </div>
                        @endif
                        @if($insurance_block->getThirdLogoImageUrl())
                            <div class="col-sm-4 logo-block">
                                <img src="{{$insurance_block->getThirdLogoImageUrl()}}" class="img-responsive">
                                <p class="yellow-text">{{$insurance_block->third_logo_text}}</p>
                                <p>{{$insurance_block->third_logo_description}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="row visible-xs">
                <div class="logos">
                    <div class="text-deco">{{$insurance_block->decor_heading}}</div>
                    <div class="row taste-it text-center">
                        @if($insurance_block->getFirstLogoImageUrl())
                            <div class="col-xs-12 logo-block">
                                <img src="{{$insurance_block->getFirstLogoImageUrl()}}" class="img-responsive inline-block">
                                <p class="yellow-text">{{$insurance_block->first_logo_text}}</p>
                                <p>{{$insurance_block->first_logo_description}}</p>
                            </div>
                        @endif
                         @if($insurance_block->getSecondLogoImageUrl())
                            <div class="col-xs-12 logo-block">
                                <img src="{{$insurance_block->getSecondLogoImageUrl()}}" class="img-responsive inline-block">
                                <p class="yellow-text">{{$insurance_block->second_logo_text}}</p>
                                <p>{{$insurance_block->second_logo_description}}</p>
                            </div>
                        @endif
                        @if($insurance_block->getThirdLogoImageUrl())
                            <div class="col-xs-12 logo-block">
                                <img src="{{$insurance_block->getThirdLogoImageUrl()}}" class="img-responsive inline-block">
                                <p class="yellow-text">{{$insurance_block->third_logo_text}}</p>
                                <p>{{$insurance_block->third_logo_description}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @endif

            <?php $key++;?>
        @endforeach
    @endif

</section>
