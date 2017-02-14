@if(Session::has('fail'))
<div id="sw" class="row" style="background-color: #9c3328; padding: 15px;">
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="document.getElementById('sw').style.visibility = 'hidden';">&times;</button>
            <i class="fa fa-info-circle"></i> {{ Session::get('fail') }}
        </div>
    </div>
</div>
@endif