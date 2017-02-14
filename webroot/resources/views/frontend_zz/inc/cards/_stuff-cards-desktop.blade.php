<section class="great-stuff hidden-xs">
    <a id="b5"></a>
    <div class="container container-1024">
        <div class="great-stuff-content">
            <div class="row">
                <h2>More great stuff...</h2>
            </div>

            <div class="row great-stuff-container">
                @foreach($stuffCards as $stuffCard)
                @include('frontend_zz.inc.cards._stuff-card-desktop', [ 'stuffCard' => $stuffCard ])
                @endforeach
            </div>
        </div>
    </div>
</section>