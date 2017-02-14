<link href="{{ asset('css/bootstrap-glyphicons.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a href="{{ route('admin.' . $module . '.create') }}" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only">New</span></a>
    <h1>
        <span>@{{ models.length }} @choice('orders::global.orders', 2)</span>
    </h1>

    <div class="btn-toolbar">
        <div>&nbsp;</div>
        <div class="pull-left">
            <form method="post" action="/admin/orders/csv">
                {{ csrf_field() }}
                <div class="orders-form-top orders-form-top-text">From</div>
                <div class='input-group date orders-form-top' id='datetimepicker1' style="float: none; display: inline-flex">
                    <input type='text' class="form-control" name="from" readonly/>
                    <span class="input-group-addon" style="height: 34px; width: 34px; padding: 8px;">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
                <div class="orders-form-top orders-form-top-text">to</div>
                <div class='input-group date orders-form-top' id='datetimepicker2' style="float: none; display: inline-flex">
                    <input type='text' class="form-control" name="to" readonly/>
                    <span class="input-group-addon" style="height: 34px; width: 34px; padding: 8px;">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
                <div class="orders-form-top">
                    <button class="btn btn-default" type="submit" style="float: none;">Get CSV</button>
                </div>
            </form>
        </div>
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">

        <table st-persist="ordersTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="edit" style="width: 7%">Preview</th>
                    <th st-sort="id" class="id st-sort" style="width: 7%">Order ID</th>
                    <th st-sort="user_name" class="user_name st-sort">User</th>
                    <th>Products</th>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td>
                        <input st-search="id" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="user_name" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td>
                        <a class="btn btn-default btn-xs" href="{{ $module }}/@{{ model.id }}/edit">Preview</a>
                    </td>
                    <td>@{{ model.id }}</td>
                    <td>@{{ model.user_name }}</td>
                    <td>
                        <div ng-repeat="product in model.products">
                            @{{ product.title }}
                        </div>
                    </td>
                </tr>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="4" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>

@section('js')
<script src="{{ asset('js/public/moment.min.js') }}"></script>
<script src="{{ asset('js/public/bootstrap-datetimepicker.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datetimepicker1, #datetimepicker2').datetimepicker({
            allowInputToggle:true,
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true,
            ignoreReadonly: true
        });
    });
</script>
@endsection
