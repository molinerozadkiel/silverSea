<?php get_header(); ?>


<!-- <?php include_once 'dataBaseHandler.php' ?> -->
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( wc_get_page_id( 'shop' ) ), 'full' );?>

<!-- <figure class="titleBaner">
  <img class="rowcol1 lazy" data-url="<?php echo wp_get_attachment_url(get_woocommerce_term_meta(get_queried_object()->term_id, 'thumbnail_id', true )); ?>">
  <!-- <img class="titleBanerImg lazy" data-url="<?php echo $thumb['0']; ?>" alt=""> -->
  <!-- <figcaption class="titleBanerCaption">
    <h2><//?php the_title();?></h2>
    <h3><//?php echo get_the_excerpt(); ?></h3>
  </figcaption> -->
<!-- </figure> --> 







<div class="coprAlqui">
  <div class="sladRadio">
    <input class="sladRadioInput" onchange="accordionSelector('#destino')" type="radio" id="euro" name="a10" value="euro" checked>
    <label class="sladRadioLabel" for="euro">COMPRAR</label>
    <input class="sladRadioInput" onchange="accordionSelector('#destino')" type="radio" id="dollar" name="a10" value="dollar">
    <div class="sladRadioSignal"></div>
    <label class="sladRadioLabel" for="dollar">ALQUILAR</label><br>
  </div>

    <div class="coprAlquiLocation">
      <h4 class="coprAlquiLocationTitle">Origen</h4>


              <div class="selectBox" tabindex="1" id="selectBoxOrigenCountry">
                <div class="selectBoxButton">
                  <p class="selectBoxPlaceholder">Pais</p>
                  <p class="selectBoxCurrent" id="selectBoxCurrentOrigenCountry"></p>
                </div>
                <div class="selectBoxList">
                  <label for="nulOrigenCountry" class="selectBoxOption">
                    <input
                      class="selectBoxInput"
                      id="nulOrigenCountry"
                      type="radio"
                      data-slug="0"
                      data-parent="city"
                      name="filter_city"
                      onclick="selectBoxControler('','#selectBoxOrigenCountry','#selectBoxCurrentOrigenCountry')"
                      value="0"
                    >
                    <!-- <span class="checkmark"></span> -->
                    <p class="colrOptP"></p>
                  </label>
                  <label for="barcelona" class="selectBoxOption">
                    <input
                      class="selectBoxInput"
                      id="barcelona"
                      data-slug="barcelona"
                      data-parent="city"
                      type="radio"
                      name="filter_city"
                      onclick="selectBoxControler('Barcelona', '#selectBoxOrigenCountry', '#selectBoxCurrentOrigenCountry')"
                      value="barcelona"
                    >
                    <!-- <span class="checkmark"></span> -->
                    <p class="colrOptP">España</p>
                  </label>
                </div>
              </div>


              <div class="selectBox" tabindex="1" id="selectBoxOrigenCity">
                <div class="selectBoxButton">
                  <p class="selectBoxPlaceholder">Ciudad</p>
                  <p class="selectBoxCurrent" id="selectBoxCurrentOrigenCity"></p>
                </div>
                <div class="selectBoxList">
                  <label for="nulOrigenCity" class="selectBoxOption">
                    <input
                      class="selectBoxInput"
                      id="nulOrigenCity"
                      type="radio"
                      data-slug="0"
                      data-parent="city"
                      name="filter_city"
                      onclick="selectBoxControler('','#selectBoxOrigenCity','#selectBoxCurrentOrigenCity')"
                      value="0"
                    >
                    <!-- <span class="checkmark"></span> -->
                    <p class="colrOptP"></p>
                  </label>
                  <label for="barcelona" class="selectBoxOption">
                    <input
                      class="selectBoxInput"
                      id="barcelona"
                      data-slug="barcelona"
                      data-parent="city"
                      type="radio"
                      name="filter_city"
                      onclick="selectBoxControler('Barcelona', '#selectBoxOrigenCity', '#selectBoxCurrentOrigenCity')"
                      value="barcelona"
                    >
                    <!-- <span class="checkmark"></span> -->
                    <p class="colrOptP">Barcelona</p>
                  </label>
                </div>
              </div>









    </div>
      <div class="coprAlquiLocation Accordion" id="destino">
        <h4 class="coprAlquiLocationTitle">Destino</h4>


                <div class="selectBox" tabindex="1" id="selectBoxOrigenCountry">
                  <div class="selectBoxButton">
                    <p class="selectBoxPlaceholder">Pais</p>
                    <p class="selectBoxCurrent" id="selectBoxCurrentOrigenCountry"></p>
                  </div>
                  <div class="selectBoxList">
                    <label for="nulOrigenCountry" class="selectBoxOption">
                      <input
                        class="selectBoxInput"
                        id="nulOrigenCountry"
                        type="radio"
                        data-slug="0"
                        data-parent="city"
                        name="filter_city"
                        onclick="selectBoxControler('','#selectBoxOrigenCountry','#selectBoxCurrentOrigenCountry')"
                        value="0"
                      >
                      <!-- <span class="checkmark"></span> -->
                      <p class="colrOptP"></p>
                    </label>
                    <label for="barcelona" class="selectBoxOption">
                      <input
                        class="selectBoxInput"
                        id="barcelona"
                        data-slug="barcelona"
                        data-parent="city"
                        type="radio"
                        name="filter_city"
                        onclick="selectBoxControler('Barcelona', '#selectBoxOrigenCountry', '#selectBoxCurrentOrigenCountry')"
                        value="barcelona"
                      >
                      <!-- <span class="checkmark"></span> -->
                      <p class="colrOptP">España</p>
                    </label>
                  </div>
                </div>


                <div class="selectBox" tabindex="1" id="selectBoxOrigenCity">
                  <div class="selectBoxButton">
                    <p class="selectBoxPlaceholder">Ciudad</p>
                    <p class="selectBoxCurrent" id="selectBoxCurrentOrigenCity"></p>
                  </div>
                  <div class="selectBoxList">
                    <label for="nulOrigenCity" class="selectBoxOption">
                      <input
                        class="selectBoxInput"
                        id="nulOrigenCity"
                        type="radio"
                        data-slug="0"
                        data-parent="city"
                        name="filter_city"
                        onclick="selectBoxControler('','#selectBoxOrigenCity','#selectBoxCurrentOrigenCity')"
                        value="0"
                      >
                      <!-- <span class="checkmark"></span> -->
                      <p class="colrOptP"></p>
                    </label>
                    <label for="barcelona" class="selectBoxOption">
                      <input
                        class="selectBoxInput"
                        id="barcelona"
                        data-slug="barcelona"
                        data-parent="city"
                        type="radio"
                        name="filter_city"
                        onclick="selectBoxControler('Barcelona', '#selectBoxOrigenCity', '#selectBoxCurrentOrigenCity')"
                        value="barcelona"
                      >
                      <!-- <span class="checkmark"></span> -->
                      <p class="colrOptP">Barcelona</p>
                    </label>
                  </div>
                </div>









      </div>
</div>






























<//?php include get_template_directory().'/copralqui.php' ?>

<div class="archiveMain">
  <div class="archiveFilter2">
    <?php $svgPath = get_template_directory()  . "/img/svg/"; ?>


    <div class="filter">
      <h3 class="filterTitle">Tipo de Contenedor</h3>
      <ul class="filterList">
        <li class="filterItem">
          <input type="checkbox">
          <?php include $svgPath . 'reefer.php'; ?>
          <label for="">Refrigerado</label>
          <?php include $svgPath . 'question.php'; ?>
        </li>
        <li class="filterItem">
          <input type="checkbox">
          <?php include $svgPath . 'dry.php'; ?>
          <label for="">Seco</label>
          <?php include $svgPath . 'question.php'; ?>
        </li>
        <li class="filterItem">
          <?php include $svgPath . 'special.php'; ?>
          <label for="">Especiales</label>
        </li>
        <li class="filterItem openTop">
          <input type="checkbox">
          <?php include $svgPath . 'openTop.php'; ?>
          <label for="">Open Top</label>
          <?php include $svgPath . 'question.php'; ?>
        </li>
        <li class="filterItem flatRack">
          <input type="checkbox">
          <?php include $svgPath . 'flatRack.php'; ?>
          <label for="">Flat Rack</label>
          <?php include $svgPath . 'question.php'; ?>
        </li>
      </ul>
      <div class="filterAll">
        <input type="checkbox" name="selectAll" value="">
        <label for="selectAll">Seleccionar todo</label>
      </div>
    </div>

    <div class="filter">
      <h3 class="filterTitle">Condición</h3>
      <ul class="filterList">
        <li class="filterItem">
          <input type="checkbox">
          <?php include $svgPath . 'cargoWorthy.php'; ?>
          <label for="">Carga | Cargo Worthy</label>
          <?php include $svgPath . 'question.php'; ?>
        </li>
        <li class="filterItem">
          <input type="checkbox">
          <?php include $svgPath . 'storage.php'; ?>
          <label for="">Almacenaje | Modificación </label>
          <?php include $svgPath . 'question.php'; ?>
        </li>
        <li class="filterItem">
          <input type="checkbox">
          <?php include $svgPath . 'scrap.php'; ?>
          <label for="">Chatarra | Scrap </label>
          <?php include $svgPath . 'question.php'; ?>
        </li>
      </ul>
      <div class="filterAll">
        <input type="checkbox" name="selectAll" value="">
        <label for="selectAll">Seleccionar todo</label>
      </div>
    </div>
    <div class="filter">
      <h3 class="filterTitle">Tamaño</h3>
      <ul class="filterList">
        <li class="filterItem">
          <input type="checkbox" class="css-checkbox">
          <?php include $svgPath . 'size.php'; ?>
          <label for="">12 PIES</label>
        </li>
        <li class="filterItem">
          <input type="checkbox">
          <?php include $svgPath . 'size.php'; ?>
          <label for="">20 PIES</label>
        </li>
        <li class="filterItem">
          <input type="checkbox">
          <?php include $svgPath . 'size.php'; ?>
          <label for="">40 PIES</label>
        </li>
        <li class="filterItem">
          <input type="checkbox">
          <?php include $svgPath . 'size.php'; ?>
          <label for="">45 PIES</label>
        </li>
      </ul>
      <div class="filterAll">
        <input type="checkbox" name="selectAll" value="">
        <label for="selectAll">Seleccionar todo</label>
      </div>
    </div>

  </div>



  <section class="searchResultsCont">
    <?php while(have_posts()){the_post(); ?>
      <?php global $product; ?>
      <article class="containerCard">
        <a href="<?php echo get_permalink(); ?>" class="cardTitle">
          <?php echo get_the_excerpt(); ?> , <?php echo get_the_title(); ?>
        </a>
        <a class="cardImgCont sectionGrey" href="<?php echo get_permalink(); ?>">
          <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
        </a>
        <div class="cardFeaturesCont">
          <figure class="cardFeature">
            <?php include $svgPath . 'dry.php'; ?>
            <!-- <p class="cardFeatureTxt">Apto para carga /<br>Cargo wothy</p> -->
          </figure>
          <figure class="cardFeature">
            <?php include $svgPath . 'reefer.php'; ?>
            <!-- <p class="cardFeatureTxt">Refrigerado</p> -->
          </figure>
          <figure class="cardFeature">
            <?php include $svgPath . 'size.php'; ?>
            <p class="cardFeatureTxt">5 x 20</p>
          </figure>
        </div>
        <hr class="cardInfoDiv">
        <div class="cardInteractionCont">
          <div class="addToCartQntContainer">
            <input class="addToCartQnt" id="addToCartQantity" type="number" value="1" min="1">
            <button class="addToCartQntBtn" onclick="changeQuantity(-1)">-</button>
            <button class="addToCartQntBtn" onclick="changeQuantity(+1)">+</button>
          </div>
          <button class="btn">AGREGAR AL PEDIDO</button>
        </div>
      </article>
    <?php } ?>
  </section>
</div>

<div class="finalbuttons">
  <button class="btn">CONTENEDORES EN REBAJA</button>
  <button class="btn">Finalizar Compra</button>
</div>

<?php get_footer() ;?>
