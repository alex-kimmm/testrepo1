<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a href="{{ route('admin.' . $module . '.create') }}" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only">New</span></a>
    <h1>
        <span>@{{ models.length }} @choice('headerblocks::global.headerblocks', 2)</span>
    </h1>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">

        <table st-persist="headerblocksTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="status" class="status st-sort">Status</th>
                    <th st-sort="image" class="image st-sort">Image</th>
                    <th st-sort="title" class="title st-sort">Title</th>
                    <th st-sort="video" class="video st-sort">Video</th>
                    <th st-sort="auto_play" class="auto_play st-sort">Auto play</th>
                    <th st-sort="quote_text" class="quote_text st-sort">Quote text</th>
                    <th st-sort="position" class="position st-sort">Position</th>

                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>
                        <input st-search="title" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td typi-btn-delete action="delete(model)"></td>
                    <td>
                        @include('core::admin._button-edit')
                    </td>
                    <td typi-btn-status action="toggleStatus(model)" model="model"></td>
                    <td>
                        <img ng-src="@{{ model.thumb }}" alt="">
                    </td>
                    <td>@{{ model.title }}</td>
                    <td>@{{ model.video != null ? 'Yes' : 'No' }}</td>
                    <td>@{{ model.auto_play == 1 ? 'Yes' : 'No' }}</td>
                    <td>@{{ model.quote_text }}</td>
                    <td>@{{ model.position }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>