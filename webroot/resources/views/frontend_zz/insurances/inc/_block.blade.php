<div class="row {{ $insuranceBlock->position }}">
    <div class="col-md-5 col-sm-5 col-xs-12 insurance-about-img pull-{{ $insuranceBlock->position == 'left' ? 'right' : 'left' }} hidden-xs">
        <div class="insurance-about-img">
            <img src="{{ $insuranceBlock->getImageUrl() }}" class="img-responsive">
        </div>
    </div>

    <div class="col-md-7 col-sm-7 col-xs-12 pull-{{ $insuranceBlock->position }}">
        <div class="white-div">
            <div class="insurance-about-img visible-xs">
                <img src="{{ $insuranceBlock->getImageUrl() }}" class="img-responsive">
            </div>
            <div class="nav-points">
                <span class="box-decoration-break-clone">{{ $insuranceBlock->title }}</span>
            </div>

            <div class="white-div-content">
                <div class="simple-text">
                    {!! $insuranceBlock->summary !!}

                    @if(count($insuranceBlock->files) > 0)
                    <div class="pdf-download">
                        <p>PDF download</p>
                        @foreach($insuranceBlock->files as $insuranceBlockFile)
                        <div class="one-pdf">
                            <a href="{{ $insuranceBlockFile->getFileUrl() }}" target="_blank">{{ $insuranceBlockFile->getFileName() }}</a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <a class="btn btn-cover-me" href="{{ $insuranceBlock->button_link }}" style="text-decoration: none;">{{ $insuranceBlock->button_title }}</a>
        </div>
    </div>
</div>