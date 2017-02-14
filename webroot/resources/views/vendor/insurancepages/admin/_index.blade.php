<div ng-app="typicms" ng-cloak ng-controller="ListController">

    {{--<a href="{{ route('admin.' . $module . '.create') }}" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only">New</span></a>--}}
    <h1>
        <span>@{{ models.length }} @choice('insurancepages::global.insurancepages', 2)</span>
    </h1>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">

        <table st-persist="insurancepagesTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    {{--<th class="delete"></th>--}}
                    <th class="edit"></th>
                    {{--<th st-sort="status" class="status st-sort">Status</th>--}}
                    <th st-sort="image" class="image st-sort">Image</th>
                    <th st-sort="title" class="title st-sort">Title</th>
                    <th st-sort="subtitle" class="subtitle st-sort">Sub Title</th>
                    <th st-sort="menu_title" class="menu_title st-sort">Menu Title</th>
                    <th st-sort="step" class="step st-sort">Step</th>
                    <th st-sort="category" class="category st-sort">Category</th>
                    <th st-sort="gradient" class="gradient st-sort">Gradient</th>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="6">
                        <input st-search="title" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    {{--<td typi-btn-delete action="delete(model)"></td>--}}
                    <td>
                        @include('core::admin._button-edit')
                    </td>
                    {{--<td typi-btn-status action="toggleStatus(model)" model="model"></td>--}}
                    <td>
                        <img ng-src="@{{ model.thumb }}" alt="">
                    </td>
                    <td>@{{ model.title }}</td>
                    <td>@{{ model.subtitle }}</td>
                    <td>@{{ model.menu_title }}</td>
                    <td>@{{ model.step }}</td>
                    <td>@{{ model.category.title }}</td>
                    <td>@{{ model.gradient.title }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>
