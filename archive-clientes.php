<?php get_header(); ?>

<section class="sectionPadding blogSection clientesATF">
  <hgroup class="divided_textgroup">
    <h1 class="divided_textgroup_title">
      Clientes de <span style="color: #0674BB;">SILVERSEA</span>
      <div class="textgroup_divider"></div>
    </h1>
    <h2 class="divided_textgroup_subtitle">Estos son los clientes satisfechos y testimonios del éxito de SILVERSEA. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed varius magna, sit amet interdum erat.</h2>
  </hgroup>

  <div class="col6_squared_info_container" data-card="squared_info">
    <?php
    while(have_posts()){the_post();
      squared_info();
    } wp_reset_query();
    echo ajax_paginator_2(get_pagenum_link());  ?>
  </div>

</section>



<section class="clientes_testimonials sectionPadding blogSection">
  <hgroup class="divided_textgroup">
    <h1 class="divided_textgroup_title">
      Testimonials y casos de éxito
      <div class="textgroup_divider"></div>
    </h1>
    <h2 class="divided_textgroup_subtitle">Estos son los clientes satisfechos y testimonios del éxito de SILVERSEA. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed varius magna, sit amet interdum erat.</h2>
  </hgroup>



  <section class="Carousel testim_carousel">
    <div class="tesim_container_2 Element">
      <?php
      $i = 0;
      $args = array(
        'post_type'=>'testimonials',
        'posts_per_page' => '-1',
      );
      $testimonials=new WP_Query($args);
      while($testimonials->have_posts()){$testimonials->the_post();?>
        <?php if (($i % 4 == 0) AND $i) { ?>
        </div>
        <div class="tesim_container_2 Element">
        <?php } ?>
        <quote class="clients_2_tesim">
          <p class="tesim_2_author"><?php the_title(); ?></p>
          <div class="tesim_2_txt"><?php the_content(); ?></div>
        </quote>
        <?php $i=$i+1; } wp_reset_query(); ?>
      </div>


        <div class="testim_2_btn_container">
          <button class="arrowBtn NextButton">
            <svg class="arrowSVG" width="106" height="106" viewBox="0 0 106 106" fill="currentColor" xmlns="https://www.w3.org/2000/svg">
              <circle r="53" transform="matrix(-1 0 0 1 53 53)" fill="currentColor"></circle>
              <path d="M33.2028 50.8521C31.9953 52.0295 31.9953 53.9705 33.2028 55.1479L59.6556 80.9415C61.5562 82.7947 64.75 81.4481 64.75 78.7936L64.75 27.2064C64.75 24.5519 61.5562 23.2053 59.6556 25.0585L33.2028 50.8521Z" fill="white"></path>
            </svg>
          </button>
          <button class="arrowBtn PrevButton">
            <svg class="arrowSVG" width="106" height="106" viewBox="0 0 106 106" fill="currentColor" xmlns="https://www.w3.org/2000/svg">
              <circle cx="53" cy="53" r="53" fill="currentColor"></circle>
              <path d="M72.7972 50.8521C74.0047 52.0295 74.0047 53.9705 72.7972 55.1479L46.3444 80.9415C44.4438 82.7947 41.25 81.4481 41.25 78.7936L41.25 27.2064C41.25 24.5519 44.4438 23.2053 46.3444 25.0585L72.7972 50.8521Z" fill="white"></path>
            </svg>
          </button>
        </div>
      </section>

      <div class="seeItOnGoogle">

        <svg class="byGoogleReviews" width="1137" height="545" viewBox="0 0 1137 545" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M533.55 278.419C533.55 259.919 532.05 241.319 528.85 223.119H272.15V327.919H419.15C413.05 361.719 393.45 391.619 364.75 410.619V478.619H452.45C503.95 431.219 533.55 361.219 533.55 278.419Z" fill="#4285F4"></path>
          <path d="M272.15 544.318C345.55 544.318 407.45 520.218 452.55 478.618L364.85 410.618C340.45 427.218 308.95 436.618 272.25 436.618C201.25 436.618 141.05 388.718 119.45 324.318H28.9501V394.418C75.1501 486.318 169.25 544.318 272.15 544.318Z" fill="#34A853"></path>
          <path d="M119.35 324.319C107.95 290.519 107.95 253.919 119.35 220.119V150.019H28.95C-9.65 226.919 -9.65 317.519 28.95 394.419L119.35 324.319Z" fill="#FBBC04"></path>
          <path d="M272.15 107.718C310.95 107.118 348.45 121.718 376.55 148.518L454.25 70.8183C405.05 24.6183 339.75 -0.78166 272.15 0.0183399C169.25 0.0183399 75.1501 58.0183 28.9501 150.018L119.35 220.118C140.85 155.618 201.15 107.718 272.15 107.718Z" fill="#EA4335"></path>
          <path d="M760.481 374.086L782.408 387.31L776.589 362.387L795.961 345.618L770.451 343.455L760.481 319.95L750.511 343.455L725 345.618L744.372 362.387L738.554 387.31L760.481 374.086Z" fill="#ECC800"></path>
          <path d="M930.5 374.086L952.427 387.31L946.608 362.387L965.981 345.618L940.47 343.455L930.5 319.95L920.53 343.455L895.019 345.618L914.392 362.387L908.573 387.31L930.5 374.086Z" fill="#ECC800"></path>
          <path d="M1015.51 374.086L1037.44 387.31L1031.62 362.387L1050.99 345.618L1025.48 343.455L1015.51 319.95L1005.54 343.455L980.029 345.618L999.401 362.387L993.582 387.31L1015.51 374.086Z" fill="#ECC800"></path>
          <path d="M1100.52 374.086L1122.45 387.31L1116.63 362.387L1136 345.618L1110.49 343.455L1100.52 319.95L1090.55 343.455L1065.04 345.618L1084.41 362.387L1078.59 387.31L1100.52 374.086Z" fill="#ECC800"></path>
          <path d="M845.49 374.086L867.417 387.31L861.599 362.387L880.971 345.618L855.46 343.455L845.49 319.95L835.52 343.455L810.01 345.618L829.382 362.387L823.563 387.31L845.49 374.086Z" fill="#ECC800"></path>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M1110.79 380.161L1122.45 387.193L1116.63 362.27L1136 345.501L1110.79 343.364V380.161Z" fill="white"></path>
          <path d="M604.922 234.984H578.203V281H563.125V167.25H600.781C613.594 167.25 623.438 170.167 630.312 176C637.24 181.833 640.703 190.323 640.703 201.469C640.703 208.552 638.776 214.724 634.922 219.984C631.12 225.245 625.807 229.177 618.984 231.781L645.703 280.062V281H629.609L604.922 234.984ZM578.203 222.719H601.25C608.698 222.719 614.609 220.792 618.984 216.938C623.411 213.083 625.625 207.927 625.625 201.469C625.625 194.438 623.516 189.047 619.297 185.297C615.13 181.547 609.089 179.646 601.172 179.594H578.203V222.719ZM694.609 282.562C683.151 282.562 673.828 278.812 666.641 271.312C659.453 263.76 655.859 253.682 655.859 241.078V238.422C655.859 230.036 657.448 222.562 660.625 216C663.854 209.385 668.333 204.229 674.062 200.531C679.844 196.781 686.094 194.906 692.812 194.906C703.802 194.906 712.344 198.526 718.438 205.766C724.531 213.005 727.578 223.37 727.578 236.859V242.875H670.312C670.521 251.208 672.943 257.953 677.578 263.109C682.266 268.214 688.203 270.766 695.391 270.766C700.495 270.766 704.818 269.724 708.359 267.641C711.901 265.557 715 262.797 717.656 259.359L726.484 266.234C719.401 277.12 708.776 282.562 694.609 282.562ZM692.812 206.781C686.979 206.781 682.083 208.917 678.125 213.188C674.167 217.406 671.719 223.344 670.781 231H713.125V229.906C712.708 222.562 710.729 216.885 707.188 212.875C703.646 208.812 698.854 206.781 692.812 206.781ZM771.172 261.391L792.109 196.469H806.875L776.562 281H765.547L734.922 196.469H749.688L771.172 261.391ZM836.484 281H822.031V196.469H836.484V281ZM820.859 174.047C820.859 171.703 821.562 169.724 822.969 168.109C824.427 166.495 826.562 165.688 829.375 165.688C832.188 165.688 834.323 166.495 835.781 168.109C837.24 169.724 837.969 171.703 837.969 174.047C837.969 176.391 837.24 178.344 835.781 179.906C834.323 181.469 832.188 182.25 829.375 182.25C826.562 182.25 824.427 181.469 822.969 179.906C821.562 178.344 820.859 176.391 820.859 174.047ZM894.766 282.562C883.307 282.562 873.984 278.812 866.797 271.312C859.609 263.76 856.016 253.682 856.016 241.078V238.422C856.016 230.036 857.604 222.562 860.781 216C864.01 209.385 868.49 204.229 874.219 200.531C880 196.781 886.25 194.906 892.969 194.906C903.958 194.906 912.5 198.526 918.594 205.766C924.688 213.005 927.734 223.37 927.734 236.859V242.875H870.469C870.677 251.208 873.099 257.953 877.734 263.109C882.422 268.214 888.359 270.766 895.547 270.766C900.651 270.766 904.974 269.724 908.516 267.641C912.057 265.557 915.156 262.797 917.812 259.359L926.641 266.234C919.557 277.12 908.932 282.562 894.766 282.562ZM892.969 206.781C887.135 206.781 882.24 208.917 878.281 213.188C874.323 217.406 871.875 223.344 870.938 231H913.281V229.906C912.865 222.562 910.885 216.885 907.344 212.875C903.802 208.812 899.01 206.781 892.969 206.781ZM1019.38 261.078L1035.62 196.469H1050.08L1025.47 281H1013.75L993.203 216.938L973.203 281H961.484L936.953 196.469H951.328L967.969 259.75L987.656 196.469H999.297L1019.38 261.078ZM1114.06 258.578C1114.06 254.672 1112.58 251.651 1109.61 249.516C1106.69 247.328 1101.56 245.453 1094.22 243.891C1086.93 242.328 1081.12 240.453 1076.8 238.266C1072.53 236.078 1069.35 233.474 1067.27 230.453C1065.23 227.432 1064.22 223.839 1064.22 219.672C1064.22 212.745 1067.14 206.885 1072.97 202.094C1078.85 197.302 1086.35 194.906 1095.47 194.906C1105.05 194.906 1112.81 197.38 1118.75 202.328C1124.74 207.276 1127.73 213.604 1127.73 221.312H1113.2C1113.2 217.354 1111.51 213.943 1108.12 211.078C1104.79 208.214 1100.57 206.781 1095.47 206.781C1090.21 206.781 1086.09 207.927 1083.12 210.219C1080.16 212.51 1078.67 215.505 1078.67 219.203C1078.67 222.693 1080.05 225.323 1082.81 227.094C1085.57 228.865 1090.55 230.557 1097.73 232.172C1104.97 233.786 1110.83 235.714 1115.31 237.953C1119.79 240.193 1123.1 242.901 1125.23 246.078C1127.42 249.203 1128.52 253.031 1128.52 257.562C1128.52 265.115 1125.49 271.182 1119.45 275.766C1113.41 280.297 1105.57 282.562 1095.94 282.562C1089.17 282.562 1083.18 281.365 1077.97 278.969C1072.76 276.573 1068.67 273.24 1065.7 268.969C1062.79 264.646 1061.33 259.984 1061.33 254.984H1075.78C1076.04 259.828 1077.97 263.682 1081.56 266.547C1085.21 269.359 1090 270.766 1095.94 270.766C1101.41 270.766 1105.78 269.672 1109.06 267.484C1112.4 265.245 1114.06 262.276 1114.06 258.578Z" fill="black"></path>
          <path d="M612.043 364.123H621.906V371.496H612.043V388H602.961V371.496H570.588V366.174L602.424 316.906H612.043V364.123ZM580.842 364.123H602.961V329.26L601.887 331.213L580.842 364.123ZM631.184 383.264C631.184 381.701 631.639 380.399 632.551 379.357C633.495 378.316 634.895 377.795 636.75 377.795C638.605 377.795 640.005 378.316 640.949 379.357C641.926 380.399 642.414 381.701 642.414 383.264C642.414 384.761 641.926 386.014 640.949 387.023C640.005 388.033 638.605 388.537 636.75 388.537C634.895 388.537 633.495 388.033 632.551 387.023C631.639 386.014 631.184 384.761 631.184 383.264ZM691.047 356.75C689.159 358.996 686.896 360.803 684.26 362.17C681.656 363.537 678.791 364.221 675.666 364.221C671.564 364.221 667.984 363.212 664.924 361.193C661.896 359.175 659.553 356.343 657.893 352.697C656.232 349.019 655.402 344.966 655.402 340.539C655.402 335.786 656.298 331.506 658.088 327.697C659.911 323.889 662.482 320.975 665.803 318.957C669.123 316.939 672.997 315.93 677.424 315.93C684.455 315.93 689.989 318.566 694.025 323.84C698.094 329.081 700.129 336.242 700.129 345.324V347.961C700.129 361.796 697.395 371.903 691.926 378.283C686.457 384.631 678.205 387.886 667.17 388.049H665.412V380.432H667.316C674.771 380.301 680.5 378.365 684.504 374.621C688.508 370.845 690.689 364.888 691.047 356.75ZM677.131 356.75C680.158 356.75 682.941 355.822 685.48 353.967C688.052 352.111 689.924 349.816 691.096 347.082V343.469C691.096 337.544 689.81 332.727 687.238 329.016C684.667 325.305 681.411 323.449 677.473 323.449C673.501 323.449 670.311 324.979 667.902 328.039C665.493 331.066 664.289 335.07 664.289 340.051C664.289 344.901 665.445 348.905 667.756 352.062C670.1 355.188 673.225 356.75 677.131 356.75Z" fill="black"></path>
        </svg>
        <p class="seeItOnGoogleTxt">
          Ver valoraciones en
          <span class="btnSimple">
            <a href="https://www.google.com/search?ei=52YQX7zEDsiHjLsPluuiIA&amp;q=silversea%20containers%20barcelona&amp;oq=silversea+containers+barcelona&amp;gs_l=psy-ab.3...0.0.0.4096.0.0.0.0.0.0.0.0..0.0....0...1c..64.psy-ab..0.0.0....0.SErFbg7SUrI&amp;npsic=0&amp;rflfq=1&amp;rlha=0&amp;rllag=41386178,2154086,1099&amp;tbm=lcl&amp;rldimm=2935391597464650041&amp;lqi=Ch5zaWx2ZXJzZWEgY29udGFpbmVycyBiYXJjZWxvbmFaNgoUc2lsdmVyc2VhIGNvbnRhaW5lcnMiHnNpbHZlcnNlYSBjb250YWluZXJzIGJhcmNlbG9uYQ&amp;ved=2ahUKEwiq8NazgNLqAhWIFxQKHWs2C54QvS4wAXoECAsQHg&amp;rldoc=1&amp;tbs=lrf:!1m4!1u2!2m2!2m1!1e1!2m1!1e2!3sIAE,lf:1,lf_ui:2&amp;rlst=f#lrd=0x12a4987e5d190a37:0xead792625eff592c,1,,,&amp;rlfi=hd:;si:16922155076066171180,l,Ch5zaWx2ZXJzZWEgY29udGFpbmVycyBiYXJjZWxvbmFaNgoUc2lsdmVyc2VhIGNvbnRhaW5lcnMiHnNpbHZlcnNlYSBjb250YWluZXJzIGJhcmNlbG9uYQ;mv:[[41.3893905,2.1682209],[41.3829661,2.1399523]]" target="_blank" class="reviewsLink">Google</a>
            ➤</span>
          </p>
        </div>
      </section>

      <?php get_footer(); ?>
