<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active navs br">
        <a class="nav-link" href="dashboard.php">Home </a>
      </li>
      <li class="nav-item navs ml br">
        <a class="nav-link" href="changepassword.php">Change Password</a>
      </li>
      <li class="nav-item navs ml br">
        <a class="nav-link" href="#">Welcome :<b> <?php echo $sid;?></b></a>
      </li>
      <li class="nav-item navs ml">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>