<section class="insurance-landing cd-intro">
    <div class="row">
        <div class="header" @if($insurance_page->getImageUrl() && !$insurance_page->getVideoUrl() ) style="background-image: url('{{$insurance_page->getImageUrl()}}');" @endif>
            <div class="top-label"><span class="general">{!! $insurance_page->subtitle !!}</span></div>
            @if($insurance_page->getVideoUrl())
                <video autoplay id="bgvid" loop class="hidden-xs">
                    <source src="{{$insurance_page->getVideoUrl()}}" type="video/mp4">
                </video>
                <div class="video-mobile insurance-step1-head-img hidden-lg hidden-md hidden-sm" style="background-image: url('{{$insurance_page->getImageUrl()}}');"></div>
            @endif
        </div>
    </div>
</section>

@include('frontend.insurances.inc.step_menu_btns', ['current_step' => 1])

<div class="row white-bg">
    <nav class="navbar navbar-white">
         <ul class="nav navbar-nav list-navbar-white">
            @foreach($insurance_page->blocks as $key=>$block)
                @if($block->in_menu)
                    @if($key == 1 && count($insurance_page->blocks) > 1)
                        <li class="active insurance-menu-item insurance-menu-item-separator">|</li>
                    @endif
                    <li class="active insurance-menu-item" data-scroll="I{{$key}}"><a href="javascript:void(0)">{{$block->menu_title}}</a></li>
                    @if($key == 1 && count($insurance_page->blocks) > 2)
                        <li class="active insurance-menu-item insurance-menu-item-separator">|</li>
                    @endif
                @endif
            @endforeach
        </ul>
    </nav>
</div>

<section class="insurance-desc" style="{{ $insurance_page->gradient->summary }}">
    @foreach($insurance_page->blocks as $key=>$block)
        <div id="I{{$key}}" class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 @if( $key%2 != 0 ) pull-right @endif">
                @if($block->title)
                    <div class="nav-points @if( $key%2 != 0 ) right @endif">
                        <span>{{$block->title}}</span>
                    </div>
                @endif
                <div class="info @if( $key%2 != 0 ) right @endif">
                    <div class="title">{{$block->heading}}</div>
                    <p>{{$block->summary}}</p>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 @if( $key%2 != 0 ) pull-left @endif" style="overflow: hidden;">
                @if($block->getImageUrl())
                    <img src="{{$block->getImageUrl()}}" class="img-responsive">
                @endif
            </div>
        </div>
    @endforeach
</section>
