@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
    <script>
        function removeImage(imageId){

            if(!confirm('Are you sure?')) return;

            $.ajax({
                url    : '/api/products/image/delete/' + imageId,
                method : 'get',
                beforeSend : function() {
                    // todo : show loader, set interactions to false
                }
            })
            .done(function(rsp) {
                if(rsp.success == 1) {
                    $('.div-product-image-' + imageId).remove();
                }
                else {
                    alert("Something went wrong, try again later");
                }
            })
            .fail(function(rsp) {
                alert("Something went wrong, try again later");
            })
            .always(function() {
                // todo : hide loader, set interactions to true
            });
        }
    </script>
@endsection

<div class="btn-toolbar">
    <button class="btn-primary btn" value="true" id="exit" name="exit" type="submit">@lang('validation.attributes.save and exit')</button>
    <button class="btn-default btn" type="submit">@lang('validation.attributes.save')</button>
    @include('core::admin._lang-switcher', ['js' => true])
</div>

{!! BootForm::hidden('id') !!}

@include('core::admin._image-fieldset', [ 'field_title' => trans('products::global.product_theme'), 'field_name' => 'image' ])

@if($model != null && $model->id != null)
<div class="image-list row">
    @if(count($model->images) != 0)
        @foreach($model->images as $image)
        <div class="col-md-2 div-product-image-{{$image->id}}">
            <a href="javascript:removeImage('{{$image->id}}')">Remove</a>
            <img class="img-responsive product-images" src="{{$image->getImageUrl()}}">
        </div>
        @endforeach
    @else
        <div class="col-md-12">There are no images</div>
    @endif
</div>
@endif
@include('core::admin._images-fieldset', [ 'field_title' => trans('products::global.product_photo'), 'field_name' => 'product_photo' ])

<div>&nbsp;</div>

{!! BootForm::text(trans('validation.attributes.sku'),'sku') !!}
{!! BootForm::text(trans('validation.attributes.price'),'price') !!}

{!! BootForm::select(
        'Color',
        'colors[]',
        $model->colors->pluck('title', 'id')->all() + TypiCMS\Modules\Colors\Models\Color::all()->pluck('title', 'id')->all()
    )
    ->select($model->colors->pluck('id')->all())
    ->multiple(true)
    ->id('colors')
!!}

{!! BootForm::select(
        'Sizes',
        'sizes[]',
        $model->sizes->pluck('title', 'id')->all() + TypiCMS\Modules\Sizes\Models\Size::all()->pluck('title', 'id')->all()
    )
    ->select($model->sizes->pluck('id')->all())
    ->multiple(true)
    ->id('sizes')
!!}

{!! BootForm::hidden('featured')->value(0) !!}
{!! BootForm::checkbox(trans('validation.attributes.featured'),'featured') !!}
{!! BootForm::select(trans('validation.attributes.category'), 'category_id', TypiCMS\Modules\Categories\Models\Category::orderBy('parent_id')->get()->nest()->listsFlattened(), null, array('class' => 'form-control')) !!}

{!! TranslatableBootForm::text(trans('validation.attributes.title'), 'title') !!}
{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}

<div style="display: none !important;">
{!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}
</div>
