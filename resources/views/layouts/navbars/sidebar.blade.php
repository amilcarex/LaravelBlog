<div class="sidebar" data-color="purple" data-background-color="black" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{route('public.home')}}" class="simple-text logo-normal">
      {{ __('Blog Fer') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'create-post' || $activePage == 'edit-post' || $activePage == 'posts-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#PostsManage" aria-expanded="true">
          <i class="material-icons">note_alt</i>
          <p>{{ __('Posts') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'create-post' || $activePage == 'edit-post' || $activePage == 'posts-management') ? ' show' : '' }}" id="PostsManage">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'create-post' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('create.post') }}">
                <span class="sidebar-mini"> CP </span>
                <span class="sidebar-normal">{{ __('Create Posts') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'posts-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('index.post') }}">
                <span class="sidebar-mini"> PL </span>
                <span class="sidebar-normal"> {{ __('Posts List') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'create-category' || $activePage == 'edit-category' || $activePage == 'categories-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#CategoriesManage" aria-expanded="true">
          <i class="material-icons">format_list_bulleted</i>
          <p>{{ __('Categories') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'create-category' || $activePage == 'edit-category' || $activePage == 'categories-management') ? ' show' : '' }}" id="CategoriesManage">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'create-category' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('create.category') }}">
                <span class="sidebar-mini"> CC </span>
                <span class="sidebar-normal">{{ __('Create Category') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'categories-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('index.category') }}">
                <span class="sidebar-mini"> CL </span>
                <span class="sidebar-normal"> {{ __('Categories List') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'create-task' || $activePage == 'edit-task' || $activePage == 'tasks-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#TasksManage" aria-expanded="true">
          <i class="material-icons">task</i>
          <p>{{ __('Tasks') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'create-task' || $activePage == 'edit-task' || $activePage == 'tasks-management') ? ' show' : '' }}" id="TasksManage">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'create-task' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('create.task') }}">
                <span class="sidebar-mini"> CT </span>
                <span class="sidebar-normal">{{ __('Create Task') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'task-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('index.task') }}">
                <span class="sidebar-mini"> TL </span>
                <span class="sidebar-normal"> {{ __('Tasks List') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'media-images'  || $activePage == 'media-files') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#mediaManage" aria-expanded="true">
          <i class="material-icons">perm_media</i>
          <p>{{ __('Media') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'media-images' || $activePage == 'media-files') ? ' show' : '' }}" id="mediaManage">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'media-images' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('media.images') }}">
                <span class="sidebar-mini"> I </span>
                <span class="sidebar-normal">{{ __('Images') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'media-files' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('media.files') }}">
                <span class="sidebar-mini"> M </span>
                <span class="sidebar-normal"> {{ __('Files') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'create-user' || $activePage == 'edit-user' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#usersManage" aria-expanded="true">
          <i class="material-icons">people</i>
          <p>{{ __('Users') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'profile' || $activePage == 'create-user' || $activePage == 'edit-user' || $activePage == 'user-management') ? ' show' : '' }}" id="usersManage">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'create-user' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('create.user') }}">
                <span class="sidebar-mini"> CU </span>
                <span class="sidebar-normal"> {{ __('Create User') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'general-settings' || $activePage == 'social-settings') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#socialManage" aria-expanded="true">
          <i class="material-icons">settings</i>
          <p>{{ __('Settings') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'general-settings' || $activePage == 'social-settings') ? ' show' : '' }}" id="socialManage">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'general-settings' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('index.general.settings') }}">
                <span class="sidebar-mini"> GS </span>
                <span class="sidebar-normal">{{ __('General Settings') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'social-settings' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('index.social.settings') }}">
                <span class="sidebar-mini"> SS </span>
                <span class="sidebar-normal"> {{ __('Social Settings') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>