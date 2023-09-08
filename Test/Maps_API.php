function my_acf_init() {    
    acf_update_setting('google_api_key', 'AIzaSyBG5d5uYf67bEQoQ3O5dZn_zJoi4cS1Smw');
}
add_action('acf/init', 'my_acf_init');