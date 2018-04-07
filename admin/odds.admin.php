<?php 

function odds_admin_menu()
{
    add_menu_page('Gestion des flux d\'affiliation', 'Odd Administration', 'manage_options', 'odds_admin', 'odds_admin_page', 'dashicons-tickets-alt', 49);
}
add_action('admin_menu', 'odds_admin_menu');


function odds_admin_page()
{
    ?>
    <div class="wrap">
    <div id="icon-options-general" class="icon32"></div>
    <h1>Odd Administration Options</h1>
    <form method="post" action="options.php">
        <?php
            //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
            settings_fields("header_section");
            
            // all the add_settings_field callbacks is displayed here
            do_settings_sections("theme-options");
        
            // Add the submit button to serialize the options
            submit_button(); 
            
        ?>          
    </form>
    <form method="post" action="admin-post.php">
        <input type="hidden" name="action" value="dl_and_process_feeds_hook" />
        <input type="submit" name="submit" value="Process feeds" />
    </form>
</div>
<?php
}
function admin_post_dl_and_process_feeds_hook() {
    $bf = get_option('betclic_feed');

    $a= $bf;
}

function display_options()
{
    //section name, display name, callback to print description of section, page to which section is attached.
    add_settings_section("header_section", "Available affiliates feeds ", "display_header_options_content", "theme-options");

    //setting name, display name, callback to print form element, page in which field is displayed, section to which it belongs.
    //last field section is optional.
    add_settings_field("netbet_feed", "NetBet", "display_nb_form_element", "theme-options", "header_section");
    add_settings_field("betclic_feed", "Betclic", "display_bc_element", "theme-options", "header_section");
    add_settings_field("betclic_live_feed", "Betclic Live", "display_bcl_element", "theme-options", "header_section");

    //section name, form element name, callback for sanitization
    register_setting("header_section", "netbet_feed");
    register_setting("header_section", "betclic_feed");
    register_setting("header_section", "betclic_live_feed");
}

function display_header_options_content(){echo "Feeds urls";}
function display_nb_form_element()
{
    //id and name of form element should be same as the setting name.
    ?>
        <input type="text" name="netbet_feed" id="netbet_feed" value="<?php echo get_option('netbet_feed'); ?>" />
    <?php
}
function display_bc_element()
{
    //id and name of form element should be same as the setting name.
    ?>
        <input type="text" name="betclic_feed" id="betclic_feed" value="<?php echo get_option('betclic_feed'); ?>" />
    <?php
}
function display_bcl_element()
{
    //id and name of form element should be same as the setting name.
    ?>
        <input type="text" name="betclic_live_feed" id="betclic_live_feed" value="<?php echo get_option('betclic_live_feed'); ?>" />
    <?php
}

//this action is executed after loads its core, after registering all actions, finds out what page to execute and before producing the actual output(before calling any action callback)
add_action("admin_init", "display_options");