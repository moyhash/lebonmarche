<body>
  <div class="navbar navbar-expand-md navbar-light text-white fixed-top px-4">
    <div class="container-fluid">
      <a href="./index" class="navbar-brand">
        <img class="site-logo" src="./assets/insta.png" alt="Mon Logo">
        <span class="logo-text">KomoriaWeb</span>
      </a> <!--  nav-brand pour le logo -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu">
        <span class="navbar-toggler-icon"></span>MENU</button>
      <div class="collapse navbar-collapse" id="mainmenu"> <!-- nav-collapse pour le menu  -->
        <!-- ul.navbar-nav>li.nav-item*3>a.nav-link -->
        <ul class="navbar-nav ms-auto topnav"> <!-- ms = margin start-->
          <li class="nav-item"><a class="btn btn-sm deposer" id="performAction">DEPOSER UNE ANNONCE</a></li>
          <li class="nav-item"><a href="./home" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="#learn" class="nav-link">Features</a></li>
          <li class="nav-item"><a href="#learn" class="nav-link">Contact</a></li>
          <!-- <li class="nav-item"><a class="btn btn-sm deposer" id="performAction">Deposer Annonse</a></li> -->
          <li class="nav-item">
          <?php if(isset($_SESSION['ID'])): ?>
            <a href="connections/logout" class="btn btn-sm logout">
            <i class="fas fa-power-off fa-1x"></i></a>
            <?php else: ?>
            <a href="connections/login" class="btn btn-sm logout">ESPACE CLIENT</a>
          <?php endif; ?>
          </li>
        </ul>
      </div>
    </div>
  </div><br><br>

  <div class="container">
    <div class="panel-bar">
      <form class="d-flex search">
        <!-- <lable for="search" class="font-weight-bold text-dark lead">Search Record</lable> -->
        <input type="search" name="search" id="search_text" class="form-control me-2 rounded-4 border-secondary w-60 " placeholder="Search...">
        <input class="btn btn-outline-success rounded-4" type="submit" value="Search">
      </form>
      <!-- <div class="message">
          <a class="deposer" id="performAction">Deposer Annonse </a>
      </div> -->
  
    </div>
    <!-- <hr> -->
  </div>
  <hr>

