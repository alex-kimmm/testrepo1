<div class="account-mobile-tabs visible-xs">
    <ul class="list-inline">
        <li class="first active"><a href="">My account</a></li>
    </ul>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="account-list">
        <ul class="list-group account-list-ul">
            <li class="list-group-item first {{ (Request::is(substr('/profile/my-details', 1)) || Request::is(substr('/profile/my-details', 1) . '/*')) ? ' active ' : '' }}">
                <a href="/profile/my-details">my details</a>
            </li>
            <li class="list-group-item {{ (Request::is(substr('/profile/my-policies', 1)) || Request::is(substr('/profile/my-policies', 1) . '/*')) ? ' active ' : '' }}">
                <a href="/profile/my-policies">my policies</a>
            </li>
            <li class="list-group-item {{ (Request::is(substr('/profile/my-orders', 1)) || Request::is(substr('/profile/my-orders', 1) . '/*')) ? ' active ' : '' }}">
                <a href="/profile/my-orders">orders</a>
            </li>
            <li class="list-group-item">
                <a href="/contactz">contactz</a>
            </li>
            <li class="list-group-item {{ (Request::is(substr('/complaintz', 1)) || Request::is(substr('/complaintz', 1) . '/*')) ? ' active ' : '' }}">
                <a href="/complaintz">complaintz</a>
            </li>
        </ul>
    </div>
</div>