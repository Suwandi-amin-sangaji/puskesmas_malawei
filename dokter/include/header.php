<div id="app">
    <div id="main" class="layout-horizontal">
      <header class="mb-5">
        <div class="header-top">
          <div class="container">
            <div class="logo">
              <!-- <a href="index"><img src="assets/images/logo/logo.svg" alt="Logo"></a> -->
            </div>
            <div class="header-top-right">

              <div class="dropdown">
                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="avatar avatar-md2">
                    <img src="assets/images/faces/1.jpg" alt="Avatar">
                  </div>
                  <div class="text">
                    <h6 class="user-dropdown-name"><?php echo $_SESSION['nama']; ?></h6>
                    <!-- <p class="user-dropdown-status text-sm text-danger"><?php echo $_SESSION['nama']; ?></p> -->
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                  <li><a class="dropdown-item" href="#">My Account</a></li>
                  <li><a class="dropdown-item" href="setting">Settings</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="logout">Logout</a></li>
                </ul>
              </div>

              <!-- Burger button responsive -->
              <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
              </a>
            </div>
          </div>
        </div>