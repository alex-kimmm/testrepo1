<section class="great-stuff-mobile visible-xs">
    <a id="b51"></a>
    <div class="row">
        <h2>More great stuff...</h2>
    </div>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($stuffCards as $index => $stuffCard)
            @include('frontend_zz.inc.cards._stuff-card-mobile', [ 'isActive' => ($index == 0 ? 'active' : ''),  'stuffCard' => $stuffCard ])
            @endforeach
        </div>
    </div>
</section>