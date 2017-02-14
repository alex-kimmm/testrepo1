<?php $cssSuccessClass = 'zz-message zz-message-white'; ?>
<?php $cssErrorClass = 'zz-error zz-error-white'; ?>
<?php $showMessage = $cssClass = '';  ?>
<?php $defaultErrorMessage = (isset($defaultErrorMessage))? $defaultErrorMessage : 'Please fill in all required fields.';  ?>

    @if( \Illuminate\Support\Facades\Session::has('success'))
        <?php $showMessage = \Illuminate\Support\Facades\Session::get('success');?>
        <?php $cssClass=$cssSuccessClass;?>
    @endif

    @if(\Illuminate\Support\Facades\Session::has('fail'))
        <?php $showMessage = \Illuminate\Support\Facades\Session::get('fail');?>
        <?php $cssClass=$cssErrorClass;?>
    @endif

    @if (count($errors) > 0)
        @if (count($errors) == 1)
            <?php $showMessage = $errors->first();?>
        @else
            <?php $showMessage = $defaultErrorMessage;?>
        @endif
        <?php $cssClass=$cssErrorClass;?>
    @endif

<p id="status-message" class="{{($showMessage!='')?'' : 'hidden-by-default'}} {{$cssClass}} ">{{$showMessage}}</p>
