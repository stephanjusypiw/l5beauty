<ul class="nav navbar-nav">
    <li><a href="/">Blog Home</a></li>

    <!-- If a user is logged in, then this template
        displays a menu for Posts, Tags, and Uploads
        on the left and a Logout on the right.
    -->
    @if (Auth::check())
        <li @if (Request::is('admin/post*')) class="active" @endif>
            <a href="/admin/post">Posts</a>
        </li>
        <li @if (Request::is('admin/tag*')) class="active" @endif>
            <a href="/admin/tag">Tags</a>
        </li>
        <li @if (Request::is('admin/upload*')) class="active" @endif>
            <a href="/admin/upload">Uploads</a>
        </li>
    @endif
</ul>

<!-- If there is no user logged in then only a Login
     link is displayed on the right.
-->
<ul class="nav navbar-nav navbar-right">
    @if (Auth::guest())
        <!-- If you are a guest call the route /auth/login
            Auth\AuthController@getLogin
            This method actually resides in the AuthenticateUsers trait

            The getLogin() method returned the contents of the ‘auth.login’ view,
            which is the login screen we see.
        -->
        <li><a href="/auth/login">Login</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
               aria-expanded="false">{{ Auth::user()->name }}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="/auth/logout">Logout</a></li>
            </ul>
        </li>
    @endif
</ul>