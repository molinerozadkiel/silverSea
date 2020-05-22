<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css2?family=Rambla:wght@400;700&display=swap" rel="stylesheet">

  <?php wp_head(); ?>

  <!-- <template id="cartItemTemplate"> -->
    <?php //include get_template_directory().'/dynamicCont.php' ?>
  <!-- </template> -->


  <template id="selectBoxOptionTemplate">
    <!-- <label class="label--checkbox ">
      <input type="checkbox" name="adwords"   class="checkbox my-auto">
      <p class="selectBoxOptionLabel"></p>
    </label> -->

    <label for="" class="selectBoxOption" data-test="red">
      <input class="selectBoxInput" id="" type="" name="" value="">
      <!-- <span class="checkmark"></span> -->
      <p class="selectBoxOptionLabel"></p>
    </label>
  </template>


  <template id="svgTemplate">
    <svg class="svg" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <use class="use" xlink:href=""></use>
    </svg>
  </template>


  <template id="cartItemTemplate">
    <div class="cartItem">
      <p class="cartItemQty">1</p>
      <svg class="cartItemSize" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><use class="use" xlink:href=""></use></svg>
      <svg class="cartItemTip1" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><use class="use" xlink:href=""></use></svg>
      <svg class="cartItemTip2" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><use class="use" xlink:href=""></use></svg>
      <svg class="cartItemCond" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><use class="use" xlink:href=""></use></svg>
    </div>
  </template>


</head>
<body class="body" id="body" <?php body_class(); ?>>

  <?php include 'assets/allIcons.php'; ?>

    <svg class="dynamicContLogo" style="display:none" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
      <path id="test" fill="currentColor" d="M632 64c4.4 0 8-3.6 8-8V40c0-4.4-3.6-8-8-8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h8v384H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h624c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8h-8V64h8zm-40 384H48V64h544v384zm-472-64h16c4.4 0 8-3.6 8-8V136c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v240c0 4.4 3.6 8 8 8zm96 0h16c4.4 0 8-3.6 8-8V136c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v240c0 4.4 3.6 8 8 8zm96 0h16c4.4 0 8-3.6 8-8V136c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v240c0 4.4 3.6 8 8 8zm96 0h16c4.4 0 8-3.6 8-8V136c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v240c0 4.4 3.6 8 8 8zm96 0h16c4.4 0 8-3.6 8-8V136c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v240c0 4.4 3.6 8 8 8z"></path>
    </svg>

<svg class="dynamicContLogo" style="display:none" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
  <g class="fa-group" id="test2">
    <path fill="currentColor" d="M439.1958,128C410.86719,77.44043,332.00391,87.02637,320.56445,88.26367a352.05546,352.05546,0,0,1,20.15625,62.92969c36.69434-1.16992,44.45166,8.4043,44.67627,8.80469,3.37158,6.01367-1.80517,24.11718-16.6206,47.3789-6.82129-6.47656-13.88135-12.89648-21.4336-19.16406a492.30786,492.30786,0,0,1,0,135.57422c7.55225-6.26758,14.61621-12.6875,21.4336-19.16406C383.5918,327.88281,388.76855,345.98828,385.397,352c-.22461.40039-8.00976,9.981-44.67627,8.80664a352.10663,352.10663,0,0,1-20.15625,62.92969C331.70312,424.94141,410.81494,434.64209,439.1958,384c18.75342-33.4668,6.61035-80.60156-27.51709-128.00195C445.80615,208.59766,457.94922,161.4668,439.1958,128ZM224,184.2793c21.61426,10.52978,35.104,17.4497,62.35107,37.02343-5.688-73.38916-27.21826-113.52832-30.03271-119.09179C245.69922,105.59766,234.88867,109.68164,224,114.166c-10.88867-4.48633-21.69922-8.57032-32.31836-11.957a328.8272,328.8272,0,0,0-64.24609-13.94726C116.31934,87.05859,37.18359,77.35742,8.8042,128c-18.75342,33.4668-6.61035,80.59766,27.51709,127.99805C2.19385,303.39844-9.94922,350.5332,8.8042,384c28.3291,50.55615,107.19238,40.97363,118.63135,39.73633a329.0303,329.0303,0,0,0,64.24609-13.94727c10.61914-3.38672,21.42969-7.4707,32.31836-11.95508,10.89258,4.48633,21.69922,8.56836,32.31836,11.95508,2.80518-5.54687,24.34375-45.689,30.03271-119.09179C259.0835,310.28564,245.38721,317.30371,224,327.71875c-21.42285-10.43213-35.10938-17.45166-62.35107-37.02148A372.06341,372.06341,0,0,1,119.97314,256a372.06341,372.06341,0,0,1,41.67579-34.69727C188.86865,201.749,202.57471,194.71289,224,184.2793ZM144.54,355.92773a212.85585,212.85585,0,0,1-37.26074,4.87891C70.6167,361.981,62.82764,352.40186,62.603,352.002c-3.37158-6.01367,1.80517-24.11914,16.6206-47.3789,6.81739,6.47656,13.88135,12.89648,21.4336,19.16406A475.19526,475.19526,0,0,0,144.54,355.92773ZM100.65723,188.21289C93.105,194.48047,86.041,200.90039,79.22363,207.377,64.4082,184.11719,59.23145,166.01172,62.603,160c.22412-.40039,8.00293-9.98047,44.68017-8.80859a212.81514,212.81514,0,0,1,37.25684,4.8789A475.56925,475.56925,0,0,0,100.65723,188.21289Z" class="fa-secondary"></path>
    <path fill="currentColor" d="M100.65723,323.78711c1.75,12.76367,3.9458,25.13281,6.62207,37.01953A212.85585,212.85585,0,0,0,144.54,355.92773,475.19526,475.19526,0,0,1,100.65723,323.78711ZM119.97314,256a372.06341,372.06341,0,0,0,41.67579,34.69727c-2.27539-29.40479-2.16016-41.4795,0-69.39454A372.06341,372.06341,0,0,0,119.97314,256ZM107.2832,151.19141c-2.67627,11.88671-4.876,24.25586-6.626,37.02148A475.56925,475.56925,0,0,1,144.54,156.07031,212.81514,212.81514,0,0,0,107.2832,151.19141Zm240.05957,37.02148c-1.75-12.76562-3.9458-25.13477-6.62207-37.01953a352.05546,352.05546,0,0,0-20.15625-62.92969C297.0918,34.28125,262.58105,0,224,0s-73.0918,34.28125-96.56445,88.26172A328.8272,328.8272,0,0,1,191.68164,102.209C204.14844,77.56055,217.08447,64,224,64s19.85547,13.56055,32.31836,38.21094c2.80469,5.54443,24.34473,45.69726,30.03271,119.09179,2.27539,29.40479,2.16016,41.4795,0,69.39454-5.688,73.38916-27.21679,113.52441-30.03271,119.09179C243.85547,434.4375,230.91553,448,224,448s-19.85156-13.56055-32.31836-38.21094a329.0303,329.0303,0,0,1-64.24609,13.94727C150.9082,477.71875,185.419,512,224,512s73.0918-34.28125,96.56445-88.26367a352.10663,352.10663,0,0,0,20.15625-62.92969c2.67627-11.88672,4.87207-24.25586,6.62207-37.01953A492.286,492.286,0,0,0,347.34277,188.21289ZM256.01367,256A32.01367,32.01367,0,1,0,224,288,32.06879,32.06879,0,0,0,256.01367,256Z" class="fa-primary"></path>
  </g>
</svg>




	<view id="load" class="load"><div class="circle"></div></view>

  <?php include('blueBar.php') ?>
  <header class="header" id="header">

    <!-- NAVIGATION BAR -->
    <a href="<?php echo site_url('');  ?>" class="logoLink">
      <img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Silversea Logo">
    </a>
  	<?php
    	$args = array(
    	  'theme_location' => 'header',
    	  'depth' => 0,
    	  'container'	=> false,
    	  'fallback_cb' => false,
    	  'menu_class' => 'navBar',
    	);
    	wp_nav_menu($args);
  	?>
  </header>

  <header class="headerMob" id="headerMob">
    <?php include('blueBar.php') ?>
    <div class="upperHeader" id="cosaTest">
      <a href="<?php echo site_url('');  ?>" class="logoLink">
        <img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Silversea Logo">
      </a>
      <div class="hamburgerMenu" onclick="altClassFromSelector('mobileNavMenu','#body')">
        <div class="hamStripe"></div>
        <div class="hamStripe"></div>
        <div class="hamStripe"></div>
      </div>
    </div>
  </header>
  <?php
  $args = array(
    'theme_location' => 'navBarMobile',
    'depth' => 0,
    'container'	=> false,
    'fallback_cb' => false,
    'menu_class' => 'navBarMobile',
  );
  wp_nav_menu($args);
  ?>


  <div class="cart" id="cart">
    <p>soy un carrito</p>
    <div class="cartItem">
      <p>1</p>
      <?php newSvg('pies20'); ?>
      <?php newSvg('Dry'); ?>
      <?php newSvg('DC'); ?>
      <?php newSvg('NEW'); ?>
    </div>
  </div>
