      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('storage')}}/{{$user->profile->image}}" class="img-circle elevation-3"
                      alt="User Image">
              </div>
              <div class="info">
                  @auth
                      <a href="{{ route('dashboard.profile.edit') }}" class="d-block">{{ $user->name }}</a>
                  @endauth
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>
          <!-- /.sidebar-menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  @foreach ($items as $item)
                      <li class="nav-item">
                          <a href="{{ route($item['route']) }}"
                              class="nav-link {{ $item['route'] == $active ? 'active' : '' }}">
                              <i class="{{ $item['icon'] }}"></i>
                              <p>
                                  {{ $item['title'] }}
                                  @if (isset($item['badge']))
                                      <span class="right badge badge-danger">{{ $item['badge'] }}</span>
                                  @endif
                              </p>
                          </a>
                      </li>
                  @endforeach
              </ul>
          </nav>
      </div>
