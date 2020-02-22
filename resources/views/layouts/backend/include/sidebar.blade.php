<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="/storage/profile/{{Auth::user()->image}}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
            <div class="email">{{Auth::user()->email}}</div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if(Request::is('admin*'))
            <li class="{{Request::is('admin/dashboard') ? 'active' : ''}}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{Request::is('admin/tag*') ? 'active' : ''}}">
                <a href="{{route('admin.tag.index')}}">
                    <i class="material-icons">local_offer</i>
                    <span>Tag</span>
                </a>
            </li>
            <li class="{{Request::is('admin/category*') ? 'active' : ''}}">
                <a href="{{route('admin.category.index')}}">
                    <i class="material-icons">view_list</i>
                    <span>Kategori</span>
                </a>
            </li>
            <li class="{{Request::is('admin/post*') ? 'active' : ''}}">
                <a href="{{route('admin.post.index')}}">
                    <i class="material-icons">library_books</i>
                    <span>Post</span>
                </a>
            </li>
            <li class="{{Request::is('admin/pending/post') ? 'active' : ''}}">
                <a href="{{route('admin.post.pending')}}">
                    <i class="material-icons">indeterminate_check_box
                    </i>
                    <span>Pending Post</span>
                </a>
            </li>
            <li class="{{Request::is('admin/subscriber*') ? 'active' : ''}}">
                <a href="{{route('admin.subscriber.index')}}">
                    <i class="material-icons">subscriptions</i>
                    <span>Langganan</span>
                </a>
            </li>
            <li class="header">SYSTEM</li>
            <li>
                <li class="{{Request::is('admin/setting*') ? 'active' : ''}}">
                    <a href="{{route('admin.setting.index')}}">
                        <i class="material-icons">settings</i>
                        <span>Setting</span>
                    </a>
                </li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i><span>Log Out</span>
                 </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
            </li>
            @endif

            @if(Request::is('author*'))
            <li class="{{Request::is('author/dashboard') ? 'active' : ''}}">
                <a href="{{route('author.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{Request::is('author/post*') ? 'active' : ''}}">
                <a href="{{route('author.post.index')}}">
                    <i class="material-icons">library_books</i>
                    <span>Post</span>
                </a>
            </li>
            <li class="header">SYSTEM</li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i><span>Log Out</span>
                 </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
            </li>
            @endif
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2019 <a href="javascript:void(0);">Bayu Tirto - Kodekosan</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.0
        </div>
    </div>
    <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->
