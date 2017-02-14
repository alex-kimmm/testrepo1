@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

<h3>User info</h3>

<table class="details-table">
    <tr>
        <td>User:</td>
        <td><a href="/admin/users/{{ $model->user->id }}/edit">{{ $model->user->userTitle->title }} {{ $model->user->first_name }} {{ $model->user->last_name }}</a></td>
    </tr>
    <tr>
        <td>User Registered at:</td>
        <td>{{ \Carbon\Carbon::parse($model->user->created_at)->format('m/d/Y, H:m')}}</td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
        <td>Claimer's Name: </td>
        <td>{{ $model->name }}</td>
    </tr>
    <tr>
        <td>Claimer's Email:</td>
        <td>{{ $model->email }}</td>
    </tr>
    <tr>
        <td>Claimer's Phone:</td>
        <td>{{ $model->contact_number }}</td>
    </tr>

</table>

<hr>

<h3>Claim info</h3>

<table class="details-table">
    <tr>
        <td style="width: 13%">Submission date:</td>
        <td>{{ \Carbon\Carbon::parse($model->created_at)->format('m/d/Y, H:m')}}</td>
    </tr>
    <tr>
        <td>Gadget:</td>
        <td>{{ $model->gadget->category }}, {{ $model->gadget->brand }} {{ $model->gadget->version }}</td>
    </tr>
    <tr>
        <td>Reason:</td>
        <td>was {{ $model->was }}</td>
    </tr>

    <?php
        $dirname = public_path() . env("CLAIM_FILE_UPLOAD_PATH") . $model->id . "/";
    ?>

    @if( \Illuminate\Support\Facades\File::exists($dirname) )
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
        <td style="vertical-align: top;">Files:</td>
        <td>
            <?php $files = glob($dirname."*"); ?>
            @foreach($files as $file)
                <?php $file = str_replace(public_path(), "", $file); ?>
                <?php $file_name_parts = explode( "/", $file ); $file_name = end( $file_name_parts ); ?>
                <a href="{{ $file }}" target="_blank">{{ $file_name }}</a><br>
            @endforeach
        </td>
    </tr>
    @endif

    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
        <td style="vertical-align: top;">Order:</td>
        <td>
        @if(!is_null($model->order()))
            <a target="_blank" href="/admin/orders/{{$model->order->id}}/edit"> <b>Order</b>: {{$model->order->id}}&nbsp;&nbsp;&nbsp;<b>Reference Number</b>: {{ $model->order->ref_number }}</a>
        @else
            Unknown
        @endif

        </td>
    </tr>

    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
        <td style="vertical-align: top;">Claim:</td>
        <td>{{ $model->description }}</td>
    </tr>


    <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
            <td style="vertical-align: top;">Status:</td>
            <td>
                {!! BootForm::open()->put()->action(route('admin.' . $model->getTable() . '.update', $model->id))->role('form') !!}
                {!! BootForm::bind($model) !!}
                    {!! BootForm::hidden('id') !!}
                    <input type="hidden" name="redirect_back" value="1">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        {!! BootForm::select(trans('validation.attributes.status'), 'status_id', TypiCMS\Modules\Claims\Models\ClaimStatus::all()->pluck('name', 'id')->all(), null, array('class' => 'form-control col-lg-6'))->hideLabel() !!}
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <button class="btn-default btn btn-success" type="submit">Update Status</button>
                    </div>
                {!! BootForm::close() !!}
            </td>
        </tr>
</table>
