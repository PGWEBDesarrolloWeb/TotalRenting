<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '3.2.1' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		if ( is_admin() ) {
			hello_maybe_update_theme_version_in_db();
		}

		if ( apply_filters( 'hello_elementor_register_menus', true ) ) {
			register_nav_menus( [ 'menu-1' => esc_html__( 'Header', 'hello-elementor' ) ] );
			register_nav_menus( [ 'menu-2' => esc_html__( 'Footer', 'hello-elementor' ) ] );
		}

		if ( apply_filters( 'hello_elementor_post_type_support', true ) ) {
			add_post_type_support( 'page', 'excerpt' );
		}

		if ( apply_filters( 'hello_elementor_add_theme_support', true ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);
			add_theme_support( 'align-wide' );
			add_theme_support( 'responsive-embeds' );

			/*
			 * Editor Styles
			 */
			add_theme_support( 'editor-styles' );
			add_editor_style( 'editor-styles.css' );

			/*
			 * WooCommerce.
			 */
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', true ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

function hello_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'hello_theme_version';
	// The theme version saved in the database.
	$hello_theme_db_version = get_option( $theme_version_option_name );

	// If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_ELEMENTOR_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_ELEMENTOR_VERSION );
	}
}

if ( ! function_exists( 'hello_elementor_display_header_footer' ) ) {
	/**
	 * Check whether to display header footer.
	 *
	 * @return bool
	 */
	function hello_elementor_display_header_footer() {
		$hello_elementor_header_footer = true;

		return apply_filters( 'hello_elementor_header_footer', $hello_elementor_header_footer );
	}
}

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_elementor_scripts_styles() {
		$min_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_elementor_enqueue_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( hello_elementor_display_header_footer() ) {
			wp_enqueue_style(
				'hello-elementor-header-footer',
				get_template_directory_uri() . '/header-footer' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
		if ( apply_filters( 'hello_elementor_register_elementor_locations', true ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( ! function_exists( 'hello_elementor_add_description_meta_tag' ) ) {
	/**
	 * Add description meta tag with excerpt text.
	 *
	 * @return void
	 */
	function hello_elementor_add_description_meta_tag() {
		if ( ! apply_filters( 'hello_elementor_description_meta_tag', true ) ) {
			return;
		}

		if ( ! is_singular() ) {
			return;
		}

		$post = get_queried_object();
		if ( empty( $post->post_excerpt ) ) {
			return;
		}

		echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $post->post_excerpt ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'hello_elementor_add_description_meta_tag' );

// Admin notice
if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

// Settings page
require get_template_directory() . '/includes/settings-functions.php';

// Header & footer styling option, inside Elementor
require get_template_directory() . '/includes/elementor-functions.php';

if ( ! function_exists( 'hello_elementor_customizer' ) ) {
	// Customizer controls
	function hello_elementor_customizer() {
		if ( ! is_customize_preview() ) {
			return;
		}

		if ( ! hello_elementor_display_header_footer() ) {
			return;
		}

		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'hello_elementor_customizer' );

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
	/**
	 * Check whether to display the page title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * BC:
 * In v2.7.0 the theme removed the `hello_elementor_body_open()` from `header.php` replacing it with `wp_body_open()`.
 * The following code prevents fatal errors in child themes that still use this function.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
	function hello_elementor_body_open() {
		wp_body_open();
	}
}

function cargar_google_maps_api() {
    wp_enqueue_script(
        'google-maps-api',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyAb2J7nxEHlQJ4TNTuTvYHqP5kEF3tVDx8',
        array(),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'cargar_google_maps_api');


function mostrar_mapa_gasolineras() {
    ob_start(); ?>
    <div id="map" style="width: 100%; height: 500px;"></div>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 40.416775, lng: -3.703790 }, // Madrid por defecto
                zoom: 6
            });

            // Cargar las gasolineras desde WordPress
            fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=obtener_gasolineras')
                .then(response => response.json())
                .then(data => {
                    data.forEach(gasolinera => {
                        new google.maps.Marker({
                            position: { lat: parseFloat(gasolinera.latitud), lng: parseFloat(gasolinera.longitud) },
                            map: map,
                            title: gasolinera.titulo
                        });
                    });
                });
        }
        document.addEventListener('DOMContentLoaded', initMap);
    </script>
    <?php return ob_get_clean();
}
add_shortcode('mapa_gasolineras', 'mostrar_mapa_gasolineras');



function obtener_gasolineras() {
    $args = array(
        'post_type' => 'gasolineras',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);
    $gasolineras = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $gasolineras[] = array(
                'titulo' => get_the_title(),
                'latitud' => get_field('latitud'),
                'longitud' => get_field('longitud'),
            );
        }
    }
    wp_reset_postdata();

    wp_send_json($gasolineras);
}
add_action('wp_ajax_obtener_gasolineras', 'obtener_gasolineras');
add_action('wp_ajax_nopriv_obtener_gasolineras', 'obtener_gasolineras');


add_action('wp_footer', function () {
    if (is_page('mapa-de-repostaje')) { // slug de la página del mapa de repostaje
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const gasStations = <?php
                    // Obtener todas las gasolineras desde el CPT
                    $posts = get_posts([
                        'post_type' => 'gasolinera',
                        'posts_per_page' => -1,
                    ]);

                    $stations = [];
                    foreach ($posts as $post) {
                        $stations[] = [
                            'name' => get_the_title($post),
                            'lat' => get_post_meta($post->ID, 'latitud', true),
                            'lng' => get_post_meta($post->ID, 'longitud', true),
                            'address' => get_post_meta($post->ID, 'direccion', true),
                            'hours' => get_post_meta($post->ID, 'horario', true),
                            'phone' => get_post_meta($post->ID, 'telefono', true),
                        ];
                    }

                    echo json_encode($stations);
                ?>;

                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 12,
                    center: { lat: 40.416775, lng: -3.703790 } // Centro en Madrid (cambia si es necesario)
                });

                const geocoder = new google.maps.Geocoder();
                const directionsService = new google.maps.DirectionsService();
                const directionsRenderer = new google.maps.DirectionsRenderer();

                directionsRenderer.setMap(map);

                const markers = [];

                // Crear los marcadores y mostrarlos en el mapa inicialmente
                gasStations.forEach(station => {
                    const marker = new google.maps.Marker({
                        position: { lat: parseFloat(station.lat), lng: parseFloat(station.lng) },
                        map: map, // Mostrar en el mapa inicialmente
                        title: station.name,
                    });

                    const infoWindowContent = `
                        <div>
                            <h3>${station.name}</h3>
                            <p><strong>Dirección:</strong> ${station.address || "No disponible"}</p>
                            <p><strong>Horario:</strong> ${station.hours || "No disponible"}</p>
                            <p><strong>Teléfono:</strong> ${station.phone || "No disponible"}</p>
                        </div>
                    `;

                    const infoWindow = new google.maps.InfoWindow({
                        content: infoWindowContent,
                    });

                    marker.addListener('click', () => {
                        infoWindow.open(map, marker);
                    });

                    markers.push({ marker, station });
                });

                // Calcular ruta entre origen y destino
                document.getElementById('calculate-route').addEventListener('click', function () {
                    const origin = document.getElementById('origin').value;
                    const destination = document.getElementById('destination').value;

                    if (!origin || !destination) {
                        alert('Por favor, ingresa ambas direcciones.');
                        return;
                    }

                    geocoder.geocode({ address: origin }, function (results, status) {
                        if (status === 'OK') {
                            const originLatLng = results[0].geometry.location;

                            geocoder.geocode({ address: destination }, function (results, status) {
                                if (status === 'OK') {
                                    const destinationLatLng = results[0].geometry.location;

                                    const routeRequest = {
                                        origin: originLatLng,
                                        destination: destinationLatLng,
                                        travelMode: 'DRIVING'
                                    };

                                    directionsService.route(routeRequest, function (response, status) {
                                        if (status === 'OK') {
                                            directionsRenderer.setDirections(response);

                                            // Ocultar todos los marcadores y mostrar solo los de la ruta
                                            const routePath = response.routes[0].overview_path;

                                            markers.forEach(({ marker, station }) => {
                                                const stationLatLng = new google.maps.LatLng(station.lat, station.lng);

                                                const isNearby = routePath.some(point => {
                                                    const distance = google.maps.geometry.spherical.computeDistanceBetween(
                                                        point, stationLatLng
                                                    );
                                                    return distance <= 5000; // 5km de la ruta
                                                });

                                                // Si está cerca de la ruta, lo mostramos, de lo contrario lo ocultamos
                                                if (isNearby) {
                                                    marker.setMap(map); // Mostrar marcador
                                                } else {
                                                    marker.setMap(null); // Ocultar marcador
                                                }
                                            });
                                        } else {
                                            alert('No se pudo calcular la ruta. Por favor, inténtalo de nuevo.');
                                        }
                                    });
                                } else {
                                    alert('No se pudo encontrar la dirección de destino.');
                                }
                            });
                        } else {
                            alert('No se pudo encontrar la dirección de origen.');
                        }
                    });
                });
            });
        </script>
        <?php
    }
});

function formulario_gasolinera_shortcode() {
    ob_start();
    ?>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="latitud">Latitud:</label>
        <input type="text" id="latitud" name="latitud" required><br>

        <label for="longitud">Longitud:</label>
        <input type="text" id="longitud" name="longitud" required><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required><br>

        <label for="direccion">Horario:</label>
        <input type="text" id="horario" name="horario" required><br>

        <label for="direccion">Telefono:</label>
        <input type="text" id="telefono" name="telefono" required><br>

        <label for="direccion">Localidad:</label>
        <input type="text" id="localidad" name="localidad" required><br>

        <label for="direccion">Provincia:</label>
        <input type="text" id="provincia" name="provincia" required><br>

        <label for="direccion">Comunidad:</label>
        <input type="text" id="comunidad" name="comunidad" required><br>

        <input type="submit" name="submit" value="Añadir Gasolinera">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $nombre = sanitize_text_field($_POST['nombre']);
        $nuevo_punto = array(
            'post_title' => $nombre,
            'post_type' => 'gasolinera',  // Cambio a singular
            'post_status' => 'publish',
        );

        // Insertar el nuevo post
        $post_id = wp_insert_post($nuevo_punto);

        if ($post_id) {
            // Aquí añadimos los meta campos ACF
            update_field('nombre', $nombre, $post_id);
            update_field('latitud', sanitize_text_field($_POST['latitud']), $post_id);
            update_field('longitud', sanitize_text_field($_POST['longitud']), $post_id);
            update_field('direccion', sanitize_text_field($_POST['direccion']), $post_id);
            update_field('direccion', sanitize_text_field($_POST['horario']), $post_id);
            update_field('direccion', sanitize_text_field($_POST['telefono']), $post_id);
            update_field('direccion', sanitize_text_field($_POST['localidad']), $post_id);
            update_field('direccion', sanitize_text_field($_POST['provincia']), $post_id);
            update_field('direccion', sanitize_text_field($_POST['comunidad']), $post_id);

            echo '<p>Gasolinera añadida correctamente.</p>';
        } else {
            echo '<p>Hubo un error al añadir la gasolinera.</p>';
        }
    }
    return ob_get_clean();
}

add_shortcode('añadir_gasolinera', 'formulario_gasolinera_shortcode');