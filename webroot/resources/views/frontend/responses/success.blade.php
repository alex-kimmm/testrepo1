@if(Session::has('success'))
<div id="sw" class="row" style="background-color: #008000; padding: 15px;">
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="document.getElementById('sw').style.visibility = 'hidden';">&times;</button>
            <i class="fa fa-info-circle"></i> {{ Session::get('success') }}
        </div>
    </div>
</div>
@endif