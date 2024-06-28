      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <li class="nav-item">
            <a href="?action=home" class="nav-link <?=active_sidebar(['home', '']);?>">
               <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
           <li class="nav-header">Quản Lý Bài Viết - Chuyên Mục</li>
          <li class="nav-item <?=menuopen_sidebar(['newpost','listpost']);?>">
            <a href="#" class="nav-link <?=active_sidebar(['newpost','listpost']);?>">
                <i class="nav-icon fas fa-th-list"></i>
              <p> Bài Viết
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?action=newpost" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Đăng Bài Viết Mới</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?action=listpost" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Bài Viết</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item <?=menuopen_sidebar(['newcategory','listcategory']);?>">
            <a href="#" class="nav-link <?=active_sidebar(['newcategory','listcategory']);?>">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Thể Loại
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?action=newcategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Thể Loại</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?action=listcategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Thể Loại</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Quản Lý Website</li>
          <li class="nav-item">
            <a href="?action=setting" class="nav-link <?=active_sidebar(['setting']);?>">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Cài Đặt Website
              </p>
            </a>
          </li>
          
        </ul>
      </nav>