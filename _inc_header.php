<?php
$request = NULL;
if (isset($_GET['request'])) {
  $request = $_GET['request'];
}
switch ($request) {
  case 'third_party':
    $subtitle = 'Third Party Visualizations';
    break;
  case 'auth':
    $subtitle = 'Server-side Authorization';
    break;
  default:
    $request = 'basic';
    $subtitle = 'Basic Dashboard';
    break;
}
?>
<header class="navbar navbar-light navbar-toggleable-md bd-navbar fixed-top">
  <nav class="container">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand">Embed API Demo<small><?= $subtitle ?></small></h1>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="nav navbar-nav">
        <li class="nav-item<?php if ($request == 'basic') print(' active'); ?>"><a class="nav-item nav-link" href="./">Basic</a></li>
        <li class="nav-item<?php if ($request == 'third_party') print(' active'); ?>"><a class="nav-item nav-link" href="third_party">Third Party</a></li>
        <li class="nav-item<?php if ($request == 'auth') print(' active'); ?>"><a class="nav-item nav-link" href="auth">Authorization</a></li>
      </ul>
    </div>
  </nav>
</header>
