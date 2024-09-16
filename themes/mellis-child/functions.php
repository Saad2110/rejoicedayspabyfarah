<?php
/**
 * Setup mellis Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function mellis_child_theme_setup() {
	load_child_theme_textdomain( 'mellis-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'mellis_child_theme_setup' );


add_action( 'wp_enqueue_scripts', 'mellis_enqueue_styles' );
function mellis_enqueue_styles() {
    $parenthandle = 'mellis-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}


add_filter( 'wpseo_json_ld_output', '__return_false' );

add_action('wp_head','dh_cstm_schema');
function dh_cstm_schema() {
    ?>
        <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Rejoice Day Spa By Farah",
  "image": "https://rejoicedayspabyfarah.com/wp-content/uploads/2022/08/logo.webp",
  "@id": "https://rejoicedayspabyfarah.com/",
  "url": "https://rejoicedayspabyfarah.com/",
  "telephone": "+1 602-732-9505",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "14891 N Northsight Blvd 121 salon suite 2",
    "addressLocality": "Scottsdale",
    "postalCode": "85260",
    "addressCountry": "United States",
    "addressRegion": "Arizona"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 33.6209303,
    "longitude": -111.8962633
  },
  "sameAs": [
    "https://www.instagram.com/rejoice.day.spa/",
    "https://twitter.com/rejoicedayspa",
    "https://www.facebook.com/people/Rejoice-day-spa-by-farah/100091356668801/",
    "https://www.tiktok.com/@rejoicebyfarh1",
    "https://www.snapchat.com/?original_referrer=www.rejoicedayspabyfarah.com",
    "https://www.threads.net/@rejoice.day.spa",
    "https://www.yelp.com/biz/rejoice-day-spa-by-farah-scottsdale?osq=rejoice+day+spa+by+farah"
  ],
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59"
  }
}
</script>
    <?php
}