<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a href="{{ route('admin.' . $module . '.create') }}" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only">New</span></a>
    <h1>
        <span>@{{ models.length }} @choice('musiccards::global.musiccards', 2)</span>
    </h1>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <!-- Nested node template. Comment temporary -->
    {{--<div ui-tree="treeOptions">--}}
        {{--<ul ui-tree-nodes="" data-max-depth="3" ng-model="models" id="tree-root">--}}
            {{--<li ng-repeat="model in models" ui-tree-node ng-include="'/views/partials/listItemMusiccardlink.html'"></li>--}}
        {{--</ul>--}}
    {{--</div>--}}

    <div class="table-responsive" ui-tree="treeOptions">

        <table ui-tree-nodes="" data-max-depth="3" ng-model="models" id="tree-root" st-persist="musiccardsTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main table-ui-tree-nodes">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="status" class="status st-sort">Status</th>
                    <th st-sort="image" class="image st-sort">Image</th>
                    <th st-sort="title" class="title st-sort">Title</th>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>
                        <input st-search="title" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels" ui-tree-node class="tr-ui-tree-node">
                    <td typi-btn-delete action="delete(model)"></td>
                    <td>
                        @include('core::admin._button-edit')
                    </td>
                    <td typi-btn-status action="toggleStatus(model)" model="model"></td>
                    <td ui-tree-handle class="angular-ui-tree-handle">
                        <img ng-src="@{{ model.thumb }}" alt="">
                    </td>
                    <td ui-tree-handle class="angular-ui-tree-handle">@{{ model.title }}</td>
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
