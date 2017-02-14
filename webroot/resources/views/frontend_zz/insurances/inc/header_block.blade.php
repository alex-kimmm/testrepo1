<style type="text/css">
    .insurance-about .header.header-1024 {
        background-image: url('{{ asset($insurancePage->image != null ? $insurancePage->getImageUrl() : '') }}');
    }
</style>

<section class="insurance-landing homepage-landing insurance-landing-02 cd-intro">
    <div class="container container-1024">
        <div class="row">
            <div class="header header-1024">
                @include('frontend_zz.insurances.inc.menu_steps', [ 'step' => $step, 'insuranceStepLink' => ('/insurance/' . $insurancePage->category->slug) ])

                <?php
                    $headerBlockStyles = 'top-80px'; // gadget cover
                    if($insurancePage->category->isXSCover()) {
<<<<<<< HEAD
                        $headerBlockStyles = 'xs-cover-label'; // xs cover
                    }
                ?>
                <div class="top-label width-50-percents">
=======
                        $headerBlockStyles = 'top-250px'; // xs cover
                    }
                ?>
                <div class="top-label width-50-percents {{ $headerBlockStyles }}">
>>>>>>> test
                    <span class="general blue-label">{{ $insurancePage->subtitle }}</span>
                </div>
                <div class="benefits-arrow-bottom">
                    <a href="#b2" class="anim-anchor">
                        <img src="{{ asset('img/benefits-arrow-bottom.png') }}">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>