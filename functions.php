<?php


$server = 'local';
$server = 'online';


require_once 'inc/customPosts.php';
require_once 'inc/productFactory.php';
require_once 'inc/formHandler.php';
require_once 'inc/ajax.php';
require_once 'inc/new_ajax.php';


if(!is_admin()){
  require_once 'inc/multi_cards.php';
}


// require_once get_template_directory() . '/inc/productFactory.php';

// LOAD SCRIPTS
add_action('wp_enqueue_scripts', 'lt_script_load');
function lt_script_load(){
	wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime(), 'all');
	wp_enqueue_script('modules', get_theme_file_uri('/js/modules.js'), NULL, microtime(), true);
	// wp_enqueue_script('ReCaptcha', 'https://www.google.com/recaptcha/api.js', NULL, microtime(), true);

  // TOOOODO ESTO ES PARA AJAX
	global $wp_query;
	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');
	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery'), 1.0, true  );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages,
		'first_page' => get_pagenum_link(1) // here it is
	) );

	wp_enqueue_script( 'my_loadmore' );
	// FIN DE PARA AJAX

	// TOOOODO ESTO ES PARA AJAX
	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');
	// register our main script but do not enqueue it yet
	wp_register_script( 'main', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), 1.0, true  );


	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'main', 'lt_data', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'homeurl' => site_url(),
		'front_page' => is_front_page(),
	) );

	wp_enqueue_script( 'main' );
	// FIN DE PARA AJAX



}




// Adding Theme Support
add_action('after_setup_theme', 'lt_add_theme_support');
function lt_add_theme_support() {
	add_theme_support('title-tag');
	add_theme_support('html5',
		array('comment-list', 'comment-form', 'search-form')
	);

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'post-thumbnails' );
}













// this removes the "Archive" word from the archive title in the archive page
add_filter('get_the_archive_title',function($title){
  if(is_category()){$title=single_cat_title('',false);
  }elseif(is_tag()){$title=single_tag_title('',false);
  }elseif(is_author()){$title='<span class="vcard">'.get_the_author().'</span>';
  }return $title;
});






function excerpt($charNumber){
  if(!$charNumber){$charNumber=1000000;}
  $excerpt = get_the_excerpt();
  if(strlen($excerpt)<=$charNumber){return $excerpt;}else{
    $excerpt = substr($excerpt, 0, $charNumber);
    $result  = substr($excerpt, 0, strrpos($excerpt, ' '));
    $result .= '...';
    // return var_dump($excerpt);
    return $result;
  }
}




 function register_menus() {
    register_nav_menu('header',__( 'Header' ));
    register_nav_menu('navBarMobile',__( 'Mobile Header Menu' ));
    register_nav_menu('footerNav',__( 'Footer' ));
    // add_post_type_support( 'page', 'excerpt' );
  }
  add_action( 'init', 'register_menus' );
















  //Product Cat Create page
  function lt_taxonomy_add_new_meta_field() {
      ?>
      <div class="form-field">
          <label for="lt_meta_desc"><?php _e('Featured', 'lt'); ?></label>
          <input type="checkbox" name="lt_meta_desc" id="lt_meta_desc">
          <p class="description"><?php _e('Mostrar categoria en "Que Contenedor Necesito"', 'lt'); ?></p>
      </div>
      <?php
  }

  //Product Cat Edit page
  function lt_taxonomy_edit_meta_field($term) {

      //getting term ID
      $term_id = $term->term_id;

      // retrieve the existing value(s) for this meta field.
      $lt_meta_desc = get_term_meta($term_id, 'lt_meta_desc', true);
      ?>
      <tr class="form-field">
          <th scope="row" valign="top"><label for="lt_meta_desc"><?php _e('Featured', 'lt'); ?></label></th>
          <td>
            <input type="checkbox" name="lt_meta_desc" id="lt_meta_desc" <?php if(esc_attr($lt_meta_desc) == 'on'){echo 'checked';} ?>>
              <p class="description"><?php _e('Mostrar categoria en "Que Contenedor Necesito"', 'lt'); ?></p>
          </td>
      </tr>
      <?php
  }

  add_action('product_cat_add_form_fields', 'lt_taxonomy_add_new_meta_field', 10, 1);
  add_action('product_cat_edit_form_fields', 'lt_taxonomy_edit_meta_field', 10, 1);

  // Save extra taxonomy fields callback function.
  function lt_save_taxonomy_custom_meta($term_id) {

      $lt_meta_desc = filter_input(INPUT_POST, 'lt_meta_desc');

      update_term_meta($term_id, 'lt_meta_desc', $lt_meta_desc);
  }

  add_action('edited_product_cat', 'lt_save_taxonomy_custom_meta', 10, 1);
  add_action('create_product_cat', 'lt_save_taxonomy_custom_meta', 10, 1);



// FUCTION FOR USER GENERATION
// https://tommcfarlin.com/create-a-user-in-wordpress/
add_action( 'admin_post_nopriv_lt_login', 'lt_login');
add_action(        'admin_post_lt_login', 'lt_login');
function lt_login(){
  $link=$_POST['link'];
  // $name=$_POST['name'];
  // $fono=$_POST['fono'];
  $mail=$_POST['mail'];
  $pass=$_POST['pass'];


//   if( null == username_exists( $mail ) ) {
//
//     // Generate the password and create the user for security
//     // $password = wp_generate_password( 12, false );
//     // $user_id = wp_create_user( $mail, $password, $mail );
//
//     // user generated pass for local testing
//     $user_id = wp_create_user( $mail, $pass, $mail );
//     // Set the nickname and display_name
//     wp_update_user(
//       array(
//         'ID'              =>    $user_id,
//         'display_name'    =>    $name,
//         'nickname'        =>    $name,
//       )
//     );
//     update_user_meta( $user_id, 'phone', $fono );
//
//
//     // Set the role
//     $user = new WP_User( $user_id );
//     $user->set_role( 'subscriber' );
//
//     // Email the user
//     wp_mail( $mail, 'Welcome '.$name.'!', 'Your Password: ' . $pass );
//   // end if
//   $action='register';
//   $creds = array(
//       'user_login'    => $mail,
//       'user_password' => $pass,
//       'remember'      => true
//   );
//
//   $status = wp_signon( $creds, false );
// } else {

  $creds = array(
      'user_login'    => $mail,
      'user_password' => $pass,
      'remember'      => true
  );

  $status = wp_signon( $creds, false );

  // $status=wp_login($mail, $pass);

  $action='login';
// }

  $link = add_query_arg( array(
    'action' => $action,
		'mail'   => $mail,
    'status' => $status,
    // 'resultado' => username_exists( $mail ),
  ), $link );
  // wp_redirect($link);
}
















add_action( 'admin_post_nopriv_lt_new_pass', 'lt_new_pass');
add_action(        'admin_post_lt_new_pass', 'lt_new_pass');
function lt_new_pass(){
  $link=$_POST['link'];
  $oldp=$_POST['oldp'];
  $newp=$_POST['newp'];
  $cnfp=$_POST['cnfp'];



  // if(isset($_POST['current_password'])){
  if(isset($_POST['oldp'])){
    $_POST = array_map('stripslashes_deep', $_POST);
    $current_password = sanitize_text_field($_POST['oldp']);
    $new_password = sanitize_text_field($_POST['newp']);
    $confirm_new_password = sanitize_text_field($_POST['cnfp']);
    $user_id = get_current_user_id();
    $errors = array();
    $current_user = get_user_by('id', $user_id);
  }

  $link = add_query_arg( array(
    'action' => $action,
  ), $link );
  // Check for errors
  if($current_user && wp_check_password($current_password, $current_user->data->user_pass, $current_user->ID)){
  //match
  } else {
    $errors[] = 'Password is incorrect';

    $link = add_query_arg( array(
      'pass'  => 'incorrect',
    ), $link );
  }
  if($new_password != $confirm_new_password){
    $errors[] = 'Password does not match';

    $link = add_query_arg( array(
      'match'  => 'no',
    ), $link );
  }
  if(empty($errors)){
      wp_set_password( $new_password, $current_user->ID );
      $link = add_query_arg( array(
        'success'  => true,
      ), $link );
  }
  // wp_redirect($link);
}




















// data-slug="0"
// data-parent="city"

// This function generates a selectBox object
function selectBox($name, $slug = false, $options = array()){
	if(!$slug){ $slug = sanitize_title($name); }
	?>
	<div class="SelectBox" tabindex="1" id="selectBox<?php echo $slug; ?>">
		<div class="selectBoxButton" onclick="altClassFromSelector('focus', '#selectBox<?php echo $slug; ?>')">
			<p class="selectBoxPlaceholder"><?php echo $name; ?></p>
			<p class="selectBoxCurrent" id="selectBoxCurrent<?php echo $slug; ?>"></p>
		</div>
		<div class="selectBoxList focus">
			<label for="nul<?php echo $slug; ?>" class="selectBoxOption" id="selectBoxOptionNul">Remover filtros
				<input
					class="selectBoxInput"
					id="nul<?php echo $slug; ?>"
					type="radio"
					name="<?php echo $slug; ?>"
					onclick="selectBoxControler('','#selectBox<?php echo $slug; ?>','#selectBoxCurrent<?php echo $slug; ?>')"
					value="0"
					<?php if(!isset($_GET[$slug])){ ?>
						checked
					<?php } ?>
				>
				<!-- <span class="checkmark"></span> -->
				<p class="colrOptP"></p>
			</label>


			<?php foreach ($options as $opt_slug => $opt_name) {
				$opt_name = preg_replace('/\s+/', ' ', trim($opt_name)); ?>

				<label for="<?php echo $slug; ?>_<?php echo $opt_slug; ?>" class="selectBoxOption">
					<input
						class="selectBoxInput <?php echo $opt_slug; ?>"
						type="radio"
						id="<?php echo $slug; ?>_<?php echo $opt_slug; ?>"
						name="<?php echo $slug; ?>"
						onclick="selectBoxControler('<?php echo $opt_name; ?>', '#selectBox<?php echo $slug; ?>', '#selectBoxCurrent<?php echo $slug; ?>')"
						value="<?php echo $opt_slug; ?>"
						<?php if(isset($_GET[$slug]) && $_GET[$slug] == $opt_slug){ ?>
							checked
						<?php } ?>
					>
					<!-- <span class="checkmark"></span> -->
					<p class="colrOptP"><?php echo $opt_name; ?></p>
				</label>


			<?php } ?>
		</div>
	</div>
<?php }


function newSvg($id){ ?>

	<svg class="pageSvg" aria-hidden="true" focusable="false" role="img" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 35 35">
		<use xlink:href="#<?php echo $id; ?>"></use>
	</svg>

<?php }













//Second solution : two or more files.
//If you're using a child theme you could use:
// get_stylesheet_directory_uri() instead of get_template_directory_uri()
add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
function load_admin_styles() {
	wp_enqueue_style( 'admin_css_foo', get_template_directory_uri() . '/css/backoffice.css', false, '1.0.0' );
}



add_action( 'wp_ajax_lt_get_front_page_video', 'lt_get_front_page_video' );
add_action( 'wp_ajax_nopriv_lt_get_front_page_video', 'lt_get_front_page_video' );
function lt_get_front_page_video () {
	$respuesta = array();
	$respuesta['greet'] = 'Hi!';
	$frontpage_id = get_option( 'page_on_front' );

	$respuesta['video'] = get_post_meta($frontpage_id, 'A-video-portada', true);


	echo wp_json_encode($respuesta);
	exit();
}








// SINCROTRON
// consultas a base de datos para el sincrotron
add_action( 'wp_ajax_lt_create_products', 'lt_create_products' );
add_action( 'wp_ajax_nopriv_lt_create_products', 'lt_create_products' );
function lt_create_products () {
	$debugMode = true;
	$respuesta = array();
	$products = false;
	// if(isset($_POST['products']) && $_POST['products'] == 'true'){$products=true;}
	$respuesta['greet'] = 'Hi!';
	if(isset($_POST['products'])){
		$products=json_decode(stripslashes($_POST['products']));
		$respuesta['gate0'] = 'productos recibidos';
		// $respuesta['decode'] = $products;
		foreach ($products as $key => $value) {
			$respuesta['name'] = $value->Name;
			// // FALTAN LAS IMAGENES
			$basic_data = array(
				'post_title'             => $value->Name,
				'post_content'           => $value->Description,
			);
			$categories = array(
				0 => $value->size,
				1 => $value->tipo_2,
				2 => $value->condition,
			);
			$meta_data = array(
				'alto'  => $value->alto,
				'ancho' => $value->ancho,
				'largo' => $value->largo,
				'_sku'  => $value->SKU,
			);

			// $respuesta['data'] = $basic_data;
			// $respuesta['cate'] = $categories;
			// $respuesta['meta'] = $meta_data;
			$images = $value->imagenes;



			$newID = newProduct($basic_data, $categories, $meta_data, $images);
			$respuesta[$key] = "Product '".$newID."' creado";
		}



	}else{$respuesta['gate0'] = 'error al recibir productos';}
	if($debugMode){echo wp_json_encode($respuesta);}
	exit();
}





function get_products_count(){
		$qnty = 0;
		$args = array('post_type'=>'product','posts_per_page'=>-1,);
		$loop = new WP_Query($args);
    while($loop->have_posts()){$loop->the_post();$qnty++;}
		wp_reset_query();
		return $qnty;
}




// consultas a base de datos para el sincrotron
add_action( 'wp_ajax_lt_wipe_products', 'lt_wipe_products' );
add_action( 'wp_ajax_nopriv_lt_wipe_products', 'lt_wipe_products' );
function lt_wipe_products () {
	$debugMode = true;
	$respuesta = array();
	$delete = false;
	$cantidad = 0;
	if(isset($_POST['delete']) && $_POST['delete'] == 'true'){$delete=true;}
	if(isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}

	$respuesta['status'] = 'Saludos desde el servidor, espero orden de eliminar.';
	$respuesta['delete'] = $delete;



	if ($delete) {
		$respuesta['gate0'] = 'orden de eliminar detectada';

		$qnty = get_products_count();
		$respuesta['qnty'] = $qnty;

		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => $cantidad,
		);

		$loop = new WP_Query( $args );
		$i = 0;
    while ( $loop->have_posts() ) : $loop->the_post();
			$respuesta[$i] = get_the_id();
			if (wh_deleteProduct($respuesta[$i], true)) {
				$respuesta[$i] = "Producto '".get_the_title()."' eliminado";
			}
      // global $product;
      // echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
			$i++;
    endwhile;
    wp_reset_query();

		if($i==0){$respuesta['status'] = 'No hay productos';}
	}else{
		$qnty = get_products_count();
		$respuesta['qnty'] = $qnty;
		$respuesta['toDelete'] = $qnty;
	}

	if($debugMode){echo wp_json_encode($respuesta);}
	exit();
}





add_action( 'wp_ajax_lt_upload_file', 'lt_upload_file' );
add_action( 'wp_ajax_nopriv_lt_upload_file', 'lt_upload_file' );

function lt_upload_file () {

	$server = 'online';
	// $server = 'local';
	$debugMode = false;
	$respuesta = array();
	$file = false;
	$file = $_FILES['file'];
	$fileName    = $file['name'];
	if(isset($_FILES['file'])){$respuesta['gate0'] = "Your file '$fileName' got to the server safely";
    $fileTmpName = $file['tmp_name'];
    $fileSize    = $file['size'];
    $fileError   = $file['error'];

		// $respuesta['name'] = $fileName;
    $fileExt= explode('.' , $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $fileName2 = strtolower(($fileExt[0]));

    $allowedExt = array( 'csv','tsv');
    $fileNamesAllowed = array('conv_trenes', 'stock','gastos_adicionales','trenes','contenedores', 'locations');

		$fileNameNew = $fileName2 . '-' . date("m-d-Y"). '.' . $fileActualExt;
		$fileDestination = wp_normalize_path( get_template_directory()."/uploads/".$fileNameNew );
		// $fileDestination = get_template_directory()."/uploads/".$fileNameNew;
		// $fileDestination = get_home_url()."/uploads/".$fileNameNew;
		// $fileDestination = deslash($fileDestination);
		// $respuesta['file_destination'] = "$fileDestination";

		$fileRead = "C:/xampp/htdocs/Silversea/wp-content/themes/silverSea/uploads/".$fileNameNew;
		if($fileActualExt=='csv'){$saltoDeLinea=",";}
		if($fileActualExt=='tsv'){$saltoDeLinea="\\t";}

		if ($server == 'online') {
			// INSTALACION FINAL
			$dbHost = "localhost";
			$dbUser = "silversea_web";
			$dbPass = "qXne2abld1";
			$dbName = "silversea_web";
		} else {
			// INSTALACION LOCAL
			$dbHost = "localhost";
			$dbUser = "root";
			$dbPass = "";
			$dbName = "lattedev_silver";
		}

		if ($conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName)) {
			$respuesta['gate1'] = "Conection is ok";
			// container_description as 'post_content',
// container_description
			$query1 = "truncate table $dbName.$fileName2;";
			$query2 = "LOAD DATA LOCAL INFILE '" . $fileDestination . "' INTO TABLE $dbName.$fileName2 FIELDS TERMINATED BY '" . $saltoDeLinea . "' IGNORE 1 LINES;";
			$qry = "Select
			salesforce_id as SKU,
			CONCAT( size, ' PIES' ) as 'Name',
			container_description as 'Description',
			null as 'Short description',
			1 as 'In stock?',
			1 as 'Stock',
			null as 'Weight (kg)',
			null as 'Length (cm)',
			null as 'Width (cm)',
			null as 'Height (cm)',
			1 as 'Allow customer reviews?',
			REPLACE(categoria,';',',') 'Categoria',
			ancho as 'ancho',
			alto as 'alto',
			largo as 'largo',
			imagenes as 'imagenes',
			tipo_2 as 'tipo_2',
			condicion as 'condition',
			CONCAT( size, ' pies' ) as 'size'
			from contenedores";

			$respuesta['query1']="$query1";
			$respuesta['query2']="$query2";

			if($fileError===0){$respuesta['gate2']="No errors uploading";
				if(in_array($fileName2,$fileNamesAllowed)){$respuesta['gate3']="Your file '$fileName' has a valid name";
					if(in_array($fileActualExt,$allowedExt)){$respuesta['gate4']="Your file '$fileName' has a valid type";
						if($fileSize<7000000){$respuesta['gate5']="File size is ok";
							if(move_uploaded_file($fileTmpName,$fileDestination)){$respuesta['gate6']="File saved in the server correctly";
								if($conn->query($query1)){$respuesta['gate7']="table correctly truncated";
									if ($conn->query($query2)) {$respuesta['gate8']="Data loaded into table";



										// If the user file in existing directory already exist, delete it
										if (file_exists($fileDestination)) {
											unlink($fileDestination);
											$respuesta['deleted']=true;
										}

// drop table contenedores;
// create table contenedores
// (
// 	size int,
// 	tipo_1 varchar(60),
// 	tipo_1_description varchar(120),
// 	tipo_2 varchar(60),
// 	tipo_2_description varchar(120),
// 	condicion varchar(60),
// 	condicion_description varchar(120),
// 	salesforce_id varchar(60),
// 	id int,
// 	categoria varchar(200),
// 	imagenes varchar(1000),
// 	ancho  float,
// 	alto float,
// 	largo float,
// 	container_description varchar(20000)
// )

										$respuesta['query1']="$query1";
										$respuesta['query2']="$query2";
										$respuesta['query3']="$qry";

										if($fileName2 == 'contenedores'){$respuesta['gate9']="Table contenedores";
											// esta parte solo deberi ejecutar en el caso de "contenedores"
											// $respuesta['last_query']="$qry";
											if($conn->query($qry)){
												$respuesta['gate10']="Last query ok";
												$respuesta['error']="Comienza a actualizar productos, si la actualizacion no comienza contacte a su webmaster";
												$ress = $conn->query($qry);
												$resp = $ress->fetch_all(MYSQLI_ASSOC);
												$json_array = wp_json_encode( $resp );
												if (!$debugMode) {
													// echo wp_json_encode($respuesta);
													echo $json_array;
													exit();
												}
											}else{$respuesta['gate10']="Last query ERROR";$respuesta['gate10']="Error armando el estructura de datos para productos, contacte a su webmaster";}
										}else{
											$respuesta['gate9']="NOT table contenedores";
											$respuesta['error']="Tabla actualizada correctamente";
											echo wp_json_encode($respuesta);
											exit();
										}

									}else{
										$respuesta['gate8']="Error loading data in the table";
										$respuesta['error']="Error loading data in the table";
										// $respuesta['query1']="$query1";
										// $respuesta['query2']="$query2";
									}
								}else{$respuesta['gate7']="Error truncating old Table";$respuesta['error']="Error truncating old Table";}
							}else{$respuesta['gate6']="Error saving file in the server";$respuesta['error']="Error saving file in the server";}
						}else{$respuesta['gate5']="File is too big";$respuesta['error']="File is too big";}
					}else{$respuesta['gate4']="Your file '$fileName' DOESN'T have a valid type";$respuesta['error']="Your file '$fileName' DOESN'T have a valid type";}
				}else{$respuesta['gate3']="Your file '$fileName' DOESN'T have a valid name";$respuesta['error']="Your file '$fileName' DOESN'T have a valid name";}
			}else{$respuesta['gate2']="Error uploading";$respuesta['error']="Error uploading";}
		}else{$respuesta['gate1']="Conection problem";$respuesta['error']="An error ocurred trying to connect to database";}
	}else{$respuesta['gate0']="No file recived";$respuesta['error']="No file recived";}

	// if($debugMode){echo wp_json_encode($respuesta);}
	echo wp_json_encode($respuesta);
	exit();
}










// COTIZADOR


add_action( 'wp_ajax_lt_cart_end', 'lt_cart_end' );
add_action( 'wp_ajax_nopriv_lt_cart_end', 'lt_cart_end' );

function lt_cart_end () {
	global $wpdb;
	$respuesta = array();
	$contenedor = $_POST['cont'];
	$country = $_POST['country'];
	$city = $_POST['city'];

	// agrega data de gastos adicionales
	$respuesta['gastos'] = false;
	$query_gastos = "SELECT * FROM `gastos_adicionales` WHERE (
		country = '$country' AND
		city    = '$city'
	);";
	$gastos_adicionales = $wpdb->get_results($query_gastos);
	if(count($gastos_adicionales) > 0){
		$respuesta['gastos'] = $gastos_adicionales[0];
	}

	// agrega data de precio en origen
	$respuesta['price_data'] = false;
	$price_data_query = "SELECT * FROM stock WHERE (
		id_contenedor = '$contenedor'     AND
		pais          = '$country' AND
		ciudad        = '$city'
	);";
	$price_data = $wpdb->get_results($price_data_query);
	if(count($price_data) > 0){
		$respuesta['price_data'] = $price_data;
	}

	// agregar a $respuesta el currency exchange
	$exchange_query = "SELECT * FROM `exchange` WHERE (
		currency1 = 'USD' AND
		currency2 = 'EUR'
	)";
	$exchange = $wpdb->get_results( $exchange_query );

	$respuesta['exchange']=$exchange[0];

	echo wp_json_encode($respuesta);
	exit();
}



// SELECT
// *
// FROM
// stock a, gastos_adicionales b
// WHERE (
// 	a.id_contenedor = '20DC CW' AND
// 	a.pais = 'BELGIUM' AND
// 	a.ciudad = 'ANTWERP' AND
// 	b.country = 'BELGIUM' AND
// 	b.city = 'ANTWERP'
// );

// SELECT
// *
// FROM
// gastos_adicionales
// WHERE (
// 	country = 'BELGIUM' AND
// 	city = 'ANTWERP'
// );












// $query = "DROP table conv_trenes;
// CREATE table conv_trenes (
//     origen_city varchar(80),
//     origen_country varchar(50),
//     destino_city varchar(80),
//     destino_country varchar(50)
// );";


// "SELECT * FROM `conv_trenes` WHERE ( origen_city = 'Dalian' and origen_country = 'China' and destino_city = 'Antwerp' );"

add_action( 'wp_ajax_lt_tren_end', 'lt_tren_end' );
add_action( 'wp_ajax_nopriv_lt_tren_end', 'lt_tren_end' );

function lt_tren_end () {
	global $wpdb;
	$respuesta = array();
	$contenedor      = $_POST['cont'];
	$origen_country  = $_POST['origen_country'];
	$origen_city     = $_POST['origen_city'];
	$destino_country = $_POST['destino_country'];
	$destino_city    = $_POST['destino_city'];

	// on the server get the following info:
	// is this convination posible?
	// if yes: return price data for both locations (to analiza in JS)
	// if not: return 'this is not a posible train convination'

	$possible_convination_query = "SELECT * FROM `conv_trenes` WHERE (
		origen_country  LIKE '%$origen_country%'  AND
		origen_city     LIKE '%$origen_city%'     AND
		destino_country LIKE '%$destino_country%' AND
		destino_city    LIKE '%$destino_city%'
	);";
	$possible_convination = $wpdb->get_results($possible_convination_query);

	// checkea si la convinacion es una conv posible
	if(count($possible_convination) > 0){
		$conv = array('conv' => true);
		$respuesta['conv'] = true;

		// agrega data de gastos adicionales
		$respuesta['gastos'] = false;
		$query_gastos = "SELECT * FROM `gastos_adicionales` WHERE (
			country = '$origen_country' AND
			city    = '$origen_city'
		);";
		$gastos_adicionales = $wpdb->get_results($query_gastos);
		if(count($gastos_adicionales) > 0){
			$respuesta['gastos'] = $gastos_adicionales[0];
		}

		// agrega data de precio en origen
		$respuesta['precio_origen'] = false;
		$precio_origen_query = "SELECT * FROM stock WHERE (
			id_contenedor = '$contenedor'     AND
			pais          = '$origen_country' AND
			ciudad        = '$origen_city'
		);";
		$precio_origen = $wpdb->get_results($precio_origen_query);
		if(count($precio_origen) > 0){
			$respuesta['precio_origen'] = $precio_origen;
		}

		// agrega data de precio en destino
		$respuesta['precio_destino'] = false;
		$precio_destino_query = "SELECT * FROM stock WHERE (
			id_contenedor = '$contenedor'      AND
			pais          = '$destino_country' AND
			ciudad        = '$destino_city'
		);";
		$precio_destino = $wpdb->get_results($precio_destino_query);
		if(count($precio_destino) > 0){
			$respuesta['precio_destino'] = $precio_destino;
		}

		// agregar a $respuesta el currency exchange
		$exchange_query = "SELECT * FROM `exchange` WHERE (
			currency1 = 'USD' AND
			currency2 = 'EUR'
		)";
		$exchange = $wpdb->get_results( $exchange_query );
		$respuesta['exchange']=$exchange[0];

	} else { $respuesta['conv'] = false; }

	echo wp_json_encode($respuesta);
	exit();
}














// consultas a base de datos para el cotizador
// consultas a base de datos para el cotizador
add_action( 'wp_ajax_lt_get_all', 'lt_get_all' );
add_action( 'wp_ajax_nopriv_lt_get_all', 'lt_get_all' );

function lt_get_all () {
	$table = $_POST['table'];
	if ($table == 'contenedores' OR $table == 'locations'){
		global $wpdb;
		$ress = $wpdb->get_results("SELECT * FROM $table");
		echo wp_json_encode( $ress );
	}
	exit();
}




















/**
 * Method to delete Woo Product
 *
 * @param int $id the product ID.
 * @param bool $force true to permanently delete product, false to move to trash.
 * @return \WP_Error|boolean
 */
function wh_deleteProduct($id, $force = TRUE)
{
    $product = wc_get_product($id);

    if(empty($product))
        return new WP_Error(999, sprintf(__('No %s is associated with #%d', 'woocommerce'), 'product', $id));

    // If we're forcing, then delete permanently.
    if ($force)
    {
        if ($product->is_type('variable'))
        {
            foreach ($product->get_children() as $child_id)
            {
                $child = wc_get_product($child_id);
                $child->delete(true);
            }
        }
        elseif ($product->is_type('grouped'))
        {
            foreach ($product->get_children() as $child_id)
            {
                $child = wc_get_product($child_id);
                $child->set_parent_id(0);
                $child->save();
            }
        }

        $product->delete(true);
        $result = $product->get_id() > 0 ? false : true;
    }
    else
    {
        $product->delete();
        $result = 'trash' === $product->get_status();
    }

    if (!$result)
    {
        return new WP_Error(999, sprintf(__('This %s cannot be deleted', 'woocommerce'), 'product'));
    }

    // Delete parent product transients.
    if ($parent_id = wp_get_post_parent_id($id))
    {
        wc_delete_product_transients($parent_id);
    }
    return true;
}






















/**
 * Register a custom menu page.
 * Page Currencies!!!!!
 */
function wpdocs_register_my_custom_menu_page(){
    add_menu_page(
        __( 'Currencies', 'SilverSea' ),
        'Currencies',
        'manage_options',
        'currencies',
        'my_custom_menu_page',
        'dashicons-welcome-widgets-menus',
        79
    );
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );

/**
 * Display a custom menu page
 */
function my_custom_menu_page(){ global $wp; ?>
	<h3>Currency exchange rates:</h3>


	<form class="currencies" name="myform" action="<?php echo esc_attr( admin_url('admin-post.php') ); ?>" method="POST">
	<?php
	global $wpdb;

	$query = "SELECT * FROM `exchange`";
	$authors = $wpdb->get_results( $query );
	?>
		<input type="hidden" name="action" value="save_my_custom_form" />
        <input type="hidden" name="link"     value="<?php echo admin_url('/admin.php?page=currencies'); ?>">
		<?php foreach( $authors as $author ) : ?>
			<label class="currencies_label" for="curr<?php echo $author->id; ?>">
				<p class="currency_name">
					<?php echo $author->currency1 . ' - ' . $author->currency2; ?>
				</p>
				<input id="curr<?php echo $author->id; ?>" name="<?php echo $author->currency1 . $author->currency2; ?>" type="text" value="<?php echo $author->rate; ?>">
			</label>
		<?php endforeach; ?>


		<input type="submit" value="submit" />
	</form>
<?php }



function my_save_custom_form() {
	$link=$_POST['link'];
    global $wpdb;
	$table = 'exchange';

	foreach ($_POST as $key => $value) {
		if($key != 'action' and $key != 'link'){
			$curr1 = substr($key,  0, 3);
			$curr2 = substr($key, -3);
			$query = "SELECT * FROM `exchange` WHERE currency1 = '$curr1' AND currency2 = '$curr2'";
			$results = $wpdb->get_results( $query );
			if(count($results)>0){


				$data = array( 'rate' => $value );
				$where = array(
					'currency1' => $curr1,
					'currency2' => $curr2
				);
				$wpdb->update($table, $data, $where );


			} else {
				// TODO: si no existe, crearlo
				$data = array( 'currency1' => $curr1, 'currency2' => $curr2, 'rate' => 0.89 );
				$wpdb->insert($table,$data);
			}
		}
	}
	wp_redirect($link);
	exit();
}

add_action( 'admin_post_save_my_custom_form', 'my_save_custom_form' );

































add_action('pre_get_posts','lt_filtro_magico');

function lt_filtro_magico($query) {
	if(!is_admin()){

		if ( !$query->is_main_query() ) return;

		// $taxes = array( 'dry', 'new', 'cw');

		// foreach ( $taxes as $tax ) {
		// 	$terms = get_terms( $tax );

		// 	foreach ( $terms as $term )
		// 		$tax_map[$tax][$term->slug] = $term->term_taxonomy_id;
		// }
		// TODO: hacer que se pueda poner slug y se de cuenta el ID

		$filtroMagico = 'use';
		if (isset($_GET[$filtroMagico]) && $_GET[$filtroMagico]== 'storage-new') {
			$query->query_vars['tax_query'][$filtroMagico . '1'] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => 'dry',
			);
			$query->query_vars['tax_query'][$filtroMagico . '2'] = array(
				'taxonomy' => 'product_cat', // gets ignored
				'field' => 'term_taxonomy_id',
				'terms' => array( 43, 23 ), // secos para almacenaje o nuevos
				'operator' => 'IN'
			);
		} else if(isset($_GET[$filtroMagico]) && $_GET[$filtroMagico]== 'cargo-dry') {
			$query->query_vars['tax_query'][$filtroMagico . '1'] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => 'dry',
			);
			$query->query_vars['tax_query'][$filtroMagico . '2'] = array(
				'taxonomy' => 'product_cat', // gets ignored
				'field' => 'term_taxonomy_id',
				'terms' => array( 39, 23 ), // secos para carga o nuevos
				'operator' => 'IN'
			);
		} else if(isset($_GET[$filtroMagico]) && $_GET[$filtroMagico]== 'reefer') {
			$query->query_vars['tax_query'][$filtroMagico . '1'] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => 'reefer',
			);
		}



		$filtroMagicoSize = 'sizes';
		if (isset($_GET[$filtroMagicoSize]) && $_GET[$filtroMagicoSize]=='20') {
			$query->query_vars['tax_query'][$filtroMagicoSize . '1'] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => '20-pies',
			);
		} else if (isset($_GET[$filtroMagicoSize]) && $_GET[$filtroMagicoSize]=='40') {
			$query->query_vars['tax_query'][$filtroMagicoSize . '1'] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => '40-pies',
			);
		} else if (isset($_GET[$filtroMagicoSize]) && $_GET[$filtroMagicoSize]=='others') {
			$query->query_vars['tax_query'][$filtroMagicoSize . '1'] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms' => array( '40-pies', '20-pies' ), // secos para carga o nuevos
				'operator' => 'NOT IN'
			);
		}

		//we remove the actions hooked on the '__after_loop' (post navigation)
		remove_all_actions ( '__after_loop');
	}
}


















// add_action('pre_get_posts','skip_featured_post', 15);
//
// function skip_featured_post($query) {
// 	//gets the global query var object
// 	global $wp_query;
//
// 	//gets the front page id set in options
// 	// $featured_post = get_option('page_on_front');
//   $old_query = $query;
//   $args = array(
//     'posts_per_page' => 1,
//     'tax_query'      => array(
//       array(
//         'taxonomy'  => 'post_tag',
//         'field'     => 'slug',
//         'terms'     => 'destacada'
//       )
//     )
//   );
//   $related=new WP_Query($args);
//   while($related->have_posts()){ $related->the_post();
//     $featured_post = get_the_ID();
//   }
//   $query = $old_query;
//
//   // $featured_post = get_posts( $args )[0]->ID;
//   // wp_reset_query();
//
//
// 	// if ( 'page' != get_option('show_on_front') || $featured_post != $wp_query->query_vars['post_id'] )
// 	// 	return;
//
// 	if ( !$query->is_main_query() )
// 		return;
//
//     // 'post__not_in' => array($post->ID),
//
//
// 	// $query-> set('post_type' ,'page');
// 	$query-> set('post__not_in' ,array( 1 ));
// 	// $query-> set('orderby' ,'post__in');
// 	// $query-> set('p' , null);
// 	// $query-> set( 'page_id' ,null);
//
// 	//we remove the actions hooked on the '__after_loop' (post navigation)
// 	remove_all_actions ( '__after_loop');
// }
