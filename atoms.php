<?php
/**
 * Plugin Name: Atoms
 * Description: Set Options in the admin panel
 */
/** Step 2 (from text above). */
add_action('admin_menu', 'plugin_menu');

/** Step 1. */
function plugin_menu()
{
    add_options_page('Atoms', 'Atoms', 'manage_options', 'atoms', 'atoms_options');
}

/** Step 3. */
function atoms_options()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    var_dump($_POST);
    ?>
    <div class="wrap">
        <h1>Set Atoms options here.</h1>


        <?php

        //If fontSize is set upsert the option
        if (isset($_POST['fontSize'])) {
            $fontSize = get_option('font_size');
            if (!isset($fontSize)) {//If there's no google font then create the option
                add_option('font_size', $_POST['fontSize']);
            } else { //else insert the option
                update_option('font_size', $_POST['fontSize']);
            }
        }
        //Get the google font after it has been sent
        $fontSize = stripslashes(htmlspecialchars(get_option('font_size')));


        //If fontColor is set upsert the option
        if (isset($_POST['fontColor'])) {
            $fontColor = get_option('font_color');
            if (!isset($fontColor)) {//If there's no font color then create the option
                add_option('font_color', $_POST['fontColor']);
            } else { //else insert the option
                update_option('font_color', $_POST['fontColor']);
            }
        }
        //Get the font color after it has been sent
        $fontColor = get_option('font_color');

        //If googleFontFamily is set upsert the option
        if (isset($_POST['googleFontFamily'])) {
            $googleFontFamily = get_option('google_font_family');
            if (!isset($googleFontFamily)) {//If there's no google font then create the option
                add_option('google_font_family', $_POST['googleFontFamily']);
            } else { //else insert the option
                update_option('google_font_family', $_POST['googleFontFamily']);
            }
        }
        //Get the google font after it has been sent
        $googleFontFamily = stripslashes(htmlspecialchars(get_option('google_font_family')));

        //If googleFont is set upsert the option
        if (isset($_POST['googleFont'])) {
            $googleFont = get_option('google_font');
            if (!isset($googleFont)) {//If there's no google font then create the option
                add_option('google_font', $_POST['googleFont']);
            } else { //else insert the option
                update_option('google_font', $_POST['googleFont']);
            }
        }
        //Get the google font after it has been sent
        $googleFont = stripslashes(htmlspecialchars(get_option('google_font')));


        //Start with font type. Get the google font and put in to wp_options.
        ?>

        <form method="post" action="">
            <input name="googleFont" type="text"
                   value="<?php echo($googleFont ? $googleFont : 'Copy and paste your google font in here') ?>"/>
            <input type="submit"/>
        </form>
        <form method="post" action="">
            <input name="googleFontFamily" type="text"
                   value="<?php echo($googleFontFamily ? $googleFontFamily : 'Paste the name of your font family in here') ?>"/>
            <input type="submit"/>
        </form>
        <form method="post" action="">
            <input name="fontColor" type="text"
                   value="<?php echo($fontColor ? $fontColor : 'Font colour') ?>"/>
            <input type="submit"/>
        </form>
        <form method="post" action="">
            <input name="fontSize" type="text"
                   value="<?php echo($fontSize ? $fontSize : 'Font size') ?>"/>
            <input type="submit"/>
        </form>



    </div>


    <?php
}

/*Load up the Google font in the head section.*/
function hook_css()
{
    //Get the google font after it has been sent
    $googleFont = stripslashes(htmlspecialchars(get_option('google_font')));
    $googleFontFamily = stripslashes(htmlspecialchars(get_option('google_font_family')));
    $fontColor = get_option('font_color');
    $fontSize = stripslashes(htmlspecialchars(get_option('font_size')));

    //Add the link for the google font
    echo html_entity_decode($googleFont);

    //Apply the style for the google font
    ?>
    <style>
        p, div, h1 {
            font-family: '<?php echo html_entity_decode($googleFontFamily); ?>';
            color: <?php echo $fontColor; ?>;
            font-size: <?php echo $fontSize . 'px'; ?>;
        }
    </style>
    <?php
}

add_action('wp_head', 'hook_css');
