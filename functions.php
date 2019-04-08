<?php
function my_theme_enqueue_styles() {

 $parent_style = 'parent-style'; // Estos son los estilos del tema padre recogidos por el tema hijo.

 wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
 wp_enqueue_style( 'child-style',
 get_stylesheet_directory_uri() . '/style.css',
 array( $parent_style ),
 wp_get_theme()->get('Version')
 );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function disable_yoast_schema_data($data){
	$data = array();
	return $data;
}
add_filter('wpseo_json_ld_output', 'disable_yoast_schema_data', 10, 1);

add_action('wp_head', 'schema_home');
function schema_home(){
if(is_front_page()) {  ?>
	<script type="application/ld+json">
	{
	  "@context": "http://schema.org",
	  "@type": "LocalBusiness",
	  "name": "Vera Cruz | Insumos Cerveceros",
	  "description": "Materias primas para cerveza artesanal.",
	  "logo": "https://www.veracruzinsumos.com.ar/wp-content/uploads/Logo-Schema-Markup.jpg",
	  "image": "https://www.veracruzinsumos.com.ar/wp-content/uploads/Frente-Schema-Markup.jpg",
	  "url": "https://www.veracruzinsumos.com.ar/",
	  "sameAs": ["https://www.facebook.com/insumosveracruz/"],
	  "openingHours": "Mo-Fr 08:00-17:00",
	  "address":
	  {
	  "@type": "PostalAddress",
	  "streetAddress": "Estanislao Zeballos 3621",
	  "addressLocality": "Santa Fe",
	  "addressRegion": "Santa Fe",
	  "addressCountry": "Argentina"
	  },
	  "geo": {
		"@type": "GeoCoordinates",
		"latitude": "-31.602652",
		"longitude": "-60.707833"
	  },
	  "aggregateRating": {
		"@type": "AggregateRating",
		"bestRating": "5",
		"ratingValue": "4.0",
		"reviewCount": "68"
	  },
	  "priceRange": "$$$",
	  "telephone": "+54-0342-484-8642"
	}
	</script>
<?php  }
};

add_action('wp_head', 'schema_blog');
function schema_blog(){
if(is_page('blog')) {  ?>
	<script type="application/ld+json">
	{
	  "@context": "http://schema.org",
	  "@type": "Blog",
	  "name": "Vera Cruz Insumos Cerveceros",
	  "description": "Venta y provisión de materias primas e insumos para cerveceros.",
	  "logo": "https://www.veracruzinsumos.com.ar/wp-content/uploads/Icono-PNG-96-DPI-512x512-px-1.png",
	  "image": "https://www.veracruzinsumos.com.ar/wp-content/uploads/Logo-Verde-500x500px-96ppp.jpg",
	  "url": "https://www.veracruzinsumos.com.ar/"
	}
	</script>
<?php  }
};

add_action('wp_head', 'schema_shop');
function schema_shop(){
if(is_page('tienda')) {  ?>
	<script type="application/ld+json">
	{
	  "@context": "http://schema.org",
	  "@type": "Store",
	  "name": "Vera Cruz | Insumos Cerveceros",
	  "description": "Venta y provisión de materias primas e insumos para cerveceros.",
	  "logo": "https://www.veracruzinsumos.com.ar/wp-content/uploads/Logo-Schema-Markup.jpg",
	  "image": "https://www.veracruzinsumos.com.ar/wp-content/uploads/Frente-Schema-Markup.jpg",
	  "url": "https://www.veracruzinsumos.com.ar/",
	  "sameAs": ["https://www.facebook.com/insumosveracruz/"],
	  "openingHours": "Mo-Fr 08:00-17:00",
	  "address":
	  {
	  "@type": "PostalAddress",
	  "streetAddress": "Estanislao Zeballos 3621",
	  "addressLocality": "Santa Fe",
	  "addressRegion": "Santa Fe",
	  "addressCountry": "Argentina"
	  },
	  "geo": {
		"@type": "GeoCoordinates",
		"latitude": "-31.602652",
		"longitude": "-60.707833"
	  },
	  "aggregateRating": {
		"@type": "AggregateRating",
		"bestRating": "5",
		"ratingValue": "4.0",
		"reviewCount": "68"
	  },
	  "priceRange": "$$$",
	  "telephone": "+54-0342-484-8642"
	}
	</script>
<?php  }
};

add_action('wp_head', 'schema_post');
function schema_post(){
if (is_singular('post')) {  ?>
	<script type="application/ld+json"> { 
		"@context": "http://schema.org", 
		 "@type": "BlogPosting",
		 "headline": "<?php echo get_the_title(); ?>",
		 "image": "<?php echo get_the_post_thumbnail_url(); ?>",
		 "genre": "Elaboración de cerveza artesanal", 
		 "url": "<?php echo get_permalink(); ?>",
		 "publisher": "Vera Cruz",
		 "datePublished": "<?php echo get_the_date(); ?>",
		 "articleBody": "<?php echo strip_tags(get_the_content()); ?>",
		 "author": {
			"@type": "Person",
			"name": "<?php echo get_the_author_meta('display_name', $author_id); ?>"
		  	}
	}
	</script>
<?php  }
};

add_action('wp_head', 'schema_product');
function schema_product(){
    global $product;

    if ( is_product() && ! is_a($product, 'WC_Product') ) {
        $product = wc_get_product( get_the_id() );
    }

    if ( is_product() && is_a($product, 'WC_Product') ) :

    ?>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Product",
      "name": "<?php echo $product->get_name(); ?>",
      "description": "Ver descripción en el link incluido.",
      "image": "<?php echo get_the_post_thumbnail_url( $product->get_id(), 'full' ); ?>",
      "url": "<?php echo get_permalink( $product->get_id() ); ?>",
      "sku": "<?php echo $product->get_sku(); ?>",
      "brand": "<?php echo $product->get_meta('brand'); ?>",
      "offers": {
        "@type": "Offer",
        "availability": "http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>",
        "price": "<?php echo $product->get_price(); ?>",
        "priceValidUntil": "2019-12-31",
        "priceCurrency": "<?php echo get_woocommerce_currency(); ?>",
        "url": "<?php echo $product->get_permalink(); ?>"
        },
      "aggregateRating": {
        "@type": "AggregateRating",
        "bestRating": "5",
        "ratingValue": "5",
        "reviewCount": "3"
        },
      "review": {
          "author": "Federico",
          "reviewRating": {
            "@type": "Rating",
            "bestRating": "5",
            "ratingValue": "5",
            "worstRating": "4"
          }
        }
    }
    </script>
    <?php
    endif;
}

add_filter( 'get_product_search_form' , 'me_custom_product_searchform' );
function me_custom_product_searchform() {
echo do_shortcode('[yith_woocommerce_ajax_search]');
}

add_action( 'wp_print_styles', 'cf7_deregister_styles', 100 );
function cf7_deregister_styles() {
    if ( ! is_page( 'contacto' ) ) {
        wp_deregister_style( 'contact-form-7' );
    }
}

add_action( 'wp_print_scripts', 'cf7_deregister_javascript', 100 );
function cf7_deregister_javascript() {
    if ( ! is_page( 'contacto' ) ) {
        wp_deregister_script( 'contact-form-7' );
    }
}

add_action('wp_head', 'css_lista_precios');
function css_lista_precios(){
if(is_page('lista-de-precios')) {  ?>
		<style>
		table {
			width: 100%;
			max-width: 100%;
			border: 1px solid #d5d5d2;
			border-collapse: collapse
		}

		table caption {
			font-family: 'Tungsten A', 'Tungsten B', 'Arial Narrow', Arial, sans-serif;
			font-weight: 400;
			font-style: normal;
			font-size: 2.954rem;
			line-height: 1;
			margin-bottom: .75em
		}

		table th {
			font-family: 'Gotham SSm A', 'Gotham SSm B', Verdana, sans-serif;
			font-weight: 400;
			font-style: normal;
			text-transform: uppercase;
			letter-spacing: .02em;
			font-size: .9353rem;
			padding: 1.2307em 1.0833em 1.0833em;
			line-height: 1.333;
			background-color: #eae9e6
		}

		table td, table th {
			text-align: left
		}

		table td {
			padding: .92307em 1em .7692em
		}

		table tbody tr:nth-of-type(even) {
			background-color: #f9f8f5
		}

		table tbody th {
			border-top: 1px solid #d5d5d2
		}

		table tbody td {
			border-top: 1px solid #d5d5d2
		}

		table.wdn_responsive_table thead th abbr {
			border-bottom: none
		}

		@media screen and (max-width:47.99em) {
			table.wdn_responsive_table td, table.wdn_responsive_table th {
				display: block
			}

			table.wdn_responsive_table thead tr {
				display: none
			}

			table.wdn_responsive_table tbody tr:first-child th {
				border-top-width: 0
			}

			table.wdn_responsive_table tbody tr:nth-of-type(even) {
				background-color: transparent
			}

			table.wdn_responsive_table tbody td {
				text-align: left
			}

			table.wdn_responsive_table tbody td:before {
				display: block;
				font-weight: 700;
				content: attr(data-header)
			}

			table.wdn_responsive_table tbody td:empty {
				display: none
			}

			table.wdn_responsive_table tbody td:nth-of-type(even) {
				background-color: #f9f8f5
			}
		}

		@media (min-width:48em) {
			table caption {
				font-size: 2.532rem
			}

			table th {
				padding: 1.2307em 1.2307em 1em;
				font-size: .802rem
			}

			table td {
				padding: .75em 1em .602em
			}
		}

		@media screen and (min-width:48em) {
			table.wdn_responsive_table thead th:not(:first-child) {
				text-align: center
			}

			table.wdn_responsive_table tbody td {
				text-align: center
			}

			table.wdn_responsive_table.flush-left td, table.wdn_responsive_table.flush-left thead th {
				text-align: left
			}
		}
		</style>
<?php }
};

add_action('wp_head', 'css_contacto');
function css_contacto(){
if(is_page('contacto')) {  ?>
		<style>
		* {
		  box-sizing: border-box;
		}

		/* Style inputs */
		input[type=text], select, textarea {
		  width: 100%;
		  padding: 12px;
		  border: 1px solid #ccc;
		  margin-top: 6px;
		  margin-bottom: 16px;
		  resize: vertical;
		}
						 
		input[type=email], select, textarea {
		  width: 100%;
		  padding: 12px;
		  border: 1px solid #ccc;
		  margin-top: 6px;
		  margin-bottom: 16px;
		  resize: vertical;
		}

		input[type=submit] {
		  background-color: #3A6541;
		  color: white;
		  padding: 12px 20px;
		  border: none;
		  cursor: pointer;
		}

		input[type=submit]:hover {
		  background-color: #45a049;
		}
						 
		.aviso {
			color: grey;
			margin-top: -28px;
		}
						 
		</style>
<?php }
};

add_filter( 'woocommerce_variable_price_html', 'custom_min_max_variable_price_html', 10, 2 );
function custom_min_max_variable_price_html( $price, $product ) {
    $prices = $product->get_variation_prices( true );
    $min_price = current( $prices['price'] );
    $max_price = end( $prices['price'] );

    $min_price_html = wc_price( $min_price ) . $product->get_price_suffix();
    $price = sprintf( __( 'Desde %1$s', 'woocommerce' ), $min_price_html );

    return $price;
}

add_action( 'woocommerce_before_single_product', 'check_if_variable_first' );
function check_if_variable_first(){
    if ( is_product() ) {
        global $post;
        $product = wc_get_product( $post->ID );
        if ( $product->is_type( 'variable' ) ) {
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		}
	}
}
		
add_action('wp_head', 'css_home');
function css_home(){
	if(is_front_page()) {  ?>
		<style>
		.home_ocultar {
			display: none
		}
		
		.home_title_ocultar {
			display: none
		}
		</style>
<?php }
};

add_action('wp_head', 'css_veracruz');
function css_veracruz(){
	  ?>
	<style>
	.main-header-bar {
		background: #3A6541;
		box-shadow: 0px 2px 2px #b8b8b8;
	}
		
	.main-header-menu a {
    		color: white;
	}
		
	.main-header-menu a {
    		background-color: #3A6541;
	}
	</style>
<?php
};

function echo_schema_product(){
global $product;
	echo $product->get_name();
}
add_shortcode( 'sc_schema_product', 'schema_product' );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

add_action('wp_head', 'css_carrito');
function css_carrito(){
if(is_page('carrito')) {  ?>
	<style>
	h2 {
		display: none;
	}
		
	.wc-proceed-to-checkout {
		padding: 1em 0 0 0;
	}
	</style>
<?php }
};

add_filter( 'gettext', 'translate_woocommerce_strings', 999, 3 );
function translate_woocommerce_strings( $translated1, $translated2, $text, $domain ) {
	if(is_page('carrito')) {
		$translated1 = str_ireplace( 'Total del carrito!', 'Elegir metodo de pago', $translated );
		$translated2 = str_ireplace( 'Finalizar compra', 'Pagar', $translated );	
		return $translated1;
		return $translated2;
	}
}
?>
