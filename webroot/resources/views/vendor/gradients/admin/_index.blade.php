<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a href="{{ route('admin.' . $module . '.create') }}" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only">New</span></a>
    <h1>
        <span>@{{ models.length }} @choice('gradients::global.gradients', 2)</span>
    </h1>

    <div class="btn-toolbar">
        <p class="pull-left gradient-description">These gradients are used in insurance pages to control gradient background of the whole pages.<br> Please make sure you know what you are doing before making changes to this section.</p>
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">

        <table st-persist="gradientsTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="status" class="status st-sort">Status</th>
                    <th st-sort="title" class="title st-sort">Title</th>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <input st-search="title" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td ng-if="model.pagesCount > 0"></td>
                    <td typi-btn-delete action="delete(model)" ng-if="model.pagesCount == 0"></td>
                    <td>
                        @include('core::admin._button-edit')
                    </td>
                    <td typi-btn-status action="toggleStatus(model)" model="model"></td>
                    <td>@{{ model.title }}</td>
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
