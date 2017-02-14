<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a href="{{ route('admin.' . $module . '.create') }}" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only">New</span></a>
    <h1>
        <span>@{{ models.length }} @choice('claims::global.claims', 2)</span>
    </h1>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">

        <table st-persist="claimsTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    {{--<th class="delete"></th>--}}
                    <th st-sort="title" class="title st-sort">Claim</th>
                    <th st-sort="order_id" class="order_id st-sort">Order</th>
                    <th st-sort="user_name" class="user_name st-sort">User</th>
                    <th st-sort="status_name" class="status_name st-sort">Status</th>
                    <th st-sort="created_at" class="created_at st-sort">Date</th>
                    <th st-sort="gadget_version" class="gadget_version st-sort">Gadget</th>
                </tr>

                <tr>
                    <td colspan="1"></td>
                    <td>
                        <input st-search="order_id" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="user_name" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="status_name" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="created_at" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="gadget_version" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    {{--<td typi-btn-delete action="delete(model)"></td>--}}

                    <td><a class="btn btn-default" href="{{ $module }}/@{{ model.id }}/view">View</a>&nbsp;&nbsp;@{{ model.description }}</td>
                    <td>@{{ (model.order_id > 0)? model.order_id : '-' }}</td>
                    <td>@{{ model.user_name }}</td>
                    <td>@{{ model.status_name }}</td>
                    <td>@{{ model.created_at }}</td>
                    <td>@{{ model.gadget_version }}</td>

                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>
