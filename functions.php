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

?>