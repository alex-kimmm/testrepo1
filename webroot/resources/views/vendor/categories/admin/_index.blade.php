<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a href="{{ route('admin.' . $module . '.create') }}" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only">New</span></a>
    <h1>
        <span>@{{ models.length }} @choice('categories::global.categories', 2)</span>
    </h1>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">

        <table class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="edit"></th>
                    <th>Title</th>
                </tr>
            </thead>

            <tbody>
            @foreach($categories as $c)
                <tr>
                    <td><a href="categories/{{ $c->id }}/edit" class="btn btn-default btn-xs">Edit</a></td>
                    <td><strong>{{ $c->title }}</strong></td>
                </tr>
                @if( isset($c->items) && count($c->items) > 0)
                    @foreach($c->items as $sc)
                    <tr>
                        <td><a href="categories/{{ $sc->id }}/edit" class="btn btn-default btn-xs">Edit</a></td>
                        <td> -- {{ $sc->title }}</td>
                    </tr>
                    @endforeach
                @endif
            @endforeach
            </tbody>

        </table>

    </div>
</div>

<script>
    // onclick="deleteCategory('{ $sc->title }}', '{ $sc->id  }}');"
    function deleteCategory(categoryTitle, categoryId){
        if (confirm("Supprimer « " + categoryTitle + " » ?") == true) {
            window.location.href = 'categories/' + categoryId + '/delete';
        }
    }
</script>