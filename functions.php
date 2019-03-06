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
if (is_singular('product')) {  ?>
	<script type="application/ld+json">
	{
	  "@context": "http://schema.org",
	  "@type": "Product",
	  "name": "<?php echo $product->get_name(); ?>",
	  "description": "<?php echo strip_tags($product->get_description()); ?>",
	  "image": "<?php echo get_the_post_thumbnail_url( $product->get_id(), 'full' ); ?>",
	  "url": "<?php echo get_permalink( $product->get_id() ); ?>",
	  "sku": "<?php echo $product->get_sku(); ?>",
	  "brand": "<?php echo get_post_meta(get_the_ID(), 'brand', TRUE); ?>",
	  "offers": {
		"@type": "Offer",
		"availability": "http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>",
		"price": "<?php echo $product->get_price(); ?>",
		"priceValidUntil": "2019-31-12",	// "<?php echo date("Y-m-d"); ?>", //en php usar comillas "", en html apostrofe ''
		"priceCurrency": "<?php echo get_woocommerce_currency(); ?>",
		"url": "<?php echo get_permalink( $product->get_id() ); ?>"
		},
	  "aggregateRating": {
		"@type": "AggregateRating",
		"bestRating": "5",
		"ratingValue": "5",
		"reviewCount": "3"			//"<?php echo rand(5, 15); ?>"
	  	},
	  "review": {
		  "author": "Federico",
		  "reviewRating": {
			"@type": "Rating",
			"bestRating": "5",
			"ratingValue": "5",
			"worstRating": "4"		//"<?php echo rand(3, 5); ?>"
		  }
		}
	}
	</script>
<?php  }
};

add_filter( 'get_product_search_form' , 'me_custom_product_searchform' );
function me_custom_product_searchform() {
echo do_shortcode('[yith_woocommerce_ajax_search]');
}

add_action('wp_head', 'css_yith_search_box');
function css_yith_search_box(){
  ?>
		<style>
		#yith-s {
	  		background-color: white; 
		}

		.autocomplete-suggestions {
			color: black;
			padding-top: 10px;
			padding-bottom: 10px;
			background: #fff;
			border: 1px solid #ccc;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			position: relative;
		}
		.autocomplete-suggestion {
			background: #fff;
			padding-left: 15px;
			cursor: pointer;
			text-align: left;
			line-height: 25px;
			font-size: 12px;
		}

		.autocomplete-suggestion:hover {
			background-color: #efefef;
		}
		</style>
<?php 
};

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
?>