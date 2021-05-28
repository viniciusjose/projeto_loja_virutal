<!doctype html>
<html ⚡>
<head>
  <title>Webjump | Backend Test | <?php echo $page?></title>
  <meta charset="utf-8">

<link  rel="stylesheet" type="text/css"  media="all" href="<?php echo BASE_URL?>/assets/css/style.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">
<meta name="viewport" content="width=device-width,minimum-scale=1">
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script></head>
<!-- Header -->
<amp-sidebar id="sidebar" class="sample-sidebar" layout="nodisplay" side="left">
  <div class="close-menu">
    <a on="tap:sidebar.toggle">
      <img src="<?php echo BASE_URL?>assets/images/bt-close.png" alt="Close Menu" width="24" height="24" />
    </a>
  </div>
  <a href="<?php echo BASE_URL?>"><img src="<?php echo BASE_URL?>assets/images/menu-go-jumpers.png" alt="Welcome" width="200" height="43" /></a>
  <div>
    <ul>
      <li><a href="<?php echo BASE_URL?>Category" class="link-menu">Categorias</a></li>
      <li><a href="<?php echo BASE_URL?>Product" class="link-menu">Produtos</a></li>
      <li><a href="<?php echo BASE_URL?>Log" class="link-menu">Logs</a></li>
    </ul>
  </div>
</amp-sidebar>
<header>
  <div class="go-menu">
    <a on="tap:sidebar.toggle">☰</a>
    <a href="<?php echo BASE_URL?>" class="link-logo"><img src="<?php echo BASE_URL?>assets/images/go-logo.png" alt="Welcome" width="69" height="430" /></a>
  </div>
  <div class="right-box">
    <span class="go-title">Painel de Administração</span>
  </div>    
</header>  
<!-- Header -->
<?php $this->loadViewInTemplate($viewName, $viewData)?>
<!-- Footer -->
<footer>
	<div class="footer-image">
	  <img src="<?php echo BASE_URL?>assets/images/go-jumpers.png" width="119" height="26" alt="Go Jumpers" />
	</div>
	<div class="email-content">
	  <span>vinicius.jsilv@jumpers.com.br</span>
	</div>
</footer>
 <!-- Footer -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="<?php echo BASE_URL?>assets/js/<?php echo $scriptPage?>.js"></script>
 </body>
</html>