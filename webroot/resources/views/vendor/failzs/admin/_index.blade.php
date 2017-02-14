<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a href="{{ route('admin.' . $module . '.create') }}" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only">New</span></a>
    <h1>
        <span>@{{ models.length }} @choice('failzs::global.failzs', 2)</span>
    </h1>
    <hr>

    @if($settings)
    <div class="row">
        <div class="col-md-12">
            <h4>Giphy Cron Settings</h4>
            {!! BootForm::open()->action('/admin/failzs/settings')->class('giphy_api') !!}
            {!! BootForm::text('Search', 'q')->defaultValue($settings[0]->value)->required() !!}
            {!! BootForm::text('Limit', 'limit')->defaultValue($settings[1]->value)->required() !!}
            {!! BootForm::text('Time', 'time')->placeholder('0 * * * * *')->defaultValue($settings[2]->value)->required() !!}
            <div class="form-group">
                <label class="control-label">&nbsp;</label><br>
                {!! BootForm::submit('Update Settings') !!}
            </div>
            {!! BootForm::close() !!}
        </div>
        <div class="col-md-12">
            Status:
            @if(\TypiCMS\Modules\Failzs\Models\FailzSetting::getValue('running') == '1')
            <span class="label label-success">RUNNING</span>
            @else
            <span class="label label-warning">STOPPED</span>
            @endif |
            <a href="/admin/failzs/status/1">Start</a> | <a href="/admin/failzs/status/0">Stop</a> |
            Last updated: @if($last) {{ $last->updated_at }} @else N/A @endif
        </div>
    </div>
    <hr>
    @endif

    <div class="row">
        <div class="col-md-12">
            <h4>Giphy API</h4>
            {!! BootForm::open()->action('/admin/failzs/giphy')->class('giphy_api') !!}
            {!! BootForm::text('Search', 'search')->required() !!}
            {!! BootForm::text('Limit', 'limit')->required() !!}
            <div class="form-group">
                <label class="control-label">&nbsp;</label><br>
                {!! BootForm::submit('Refresh Giphy list') !!}
            </div>
            {!! BootForm::close() !!}
        </div>
    </div>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    @include('core::_session_messages')

    <div class="table-responsive">

        <table st-persist="failzsTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="status" class="status st-sort">Status</th>
                    <th class="image st-sort">Image</th>
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
                <tr ng-repeat="model in displayedModels">
                    <td typi-btn-delete action="delete(model)"></td>
                    <td>
                        @include('core::admin._button-edit')
                    </td>
                    <td typi-btn-status action="toggleStatus(model)" model="model"></td>
                    <td>
                        <img ng-src="@{{ model.obj_link }}" alt="" height="20">
                    </td>
                    <td>@{{ model.title }}</td>
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
