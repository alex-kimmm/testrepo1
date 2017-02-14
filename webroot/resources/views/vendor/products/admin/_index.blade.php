<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a href="{{ route('admin.' . $module . '.create') }}" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only">New</span></a>
    <h1>
        <span>@{{ models.length }} @choice('products::global.products', 2)</span>
    </h1>

    <div class="row">
            <div class="col-md-12">
                <h4>Insurance Products API</h4>
                {!! BootForm::open()->action('/admin/products/insurances') !!}
                <div class="form-group">
                    {!! BootForm::submit('Load Insurance Products') !!}
                </div>
                {!! BootForm::close() !!}
            </div>
        </div>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    @include('core::_session_messages')

    <div class="table-responsive">

        <table st-persist="productsTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="status" class="status st-sort">Status</th>
                    <th st-sort="image" class="image st-sort">Image</th>
                    <th st-sort="category_name" class="category_name st-sort">Category</th>
                    <th st-sort="title" class="title st-sort">Title</th>
                    <th st-sort="price" class="price st-sort">Price</th>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>
                        <input st-search="category_name" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="title" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td ng-if="!model.actionDelete"></td>
                    <td typi-btn-delete action="delete(model)" ng-if="model.actionDelete"></td>
                    <td>
                        @include('core::admin._button-edit')
                    </td>
                    <td typi-btn-status action="toggleStatus(model)" model="model"></td>
                    <td>
                        <img ng-src="@{{ model.thumb }}" alt="">
                    </td>
                    <td>@{{ model.category_name }}</td>
                    <td>@{{ model.title }}</td>
                    <td>@{{ model.price }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>
