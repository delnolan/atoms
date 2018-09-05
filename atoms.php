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

        //If h3 is set upsert the option
        if (isset($_POST['h6Size'])) {
            $h6Size = get_option('h6_size');
            if (!isset($h6Size)) {//If there's no google font then create the option
                add_option('h6_size', $_POST['h6Size']);
            } else { //else insert the option
                update_option('h6_size', $_POST['h6Size']);
            }
        }
        //Get h1 after it has been sent
        $h6Size = get_option('h6_size');

        //If h3 is set upsert the option
        if (isset($_POST['h5Size'])) {
            $h5Size = get_option('h5_size');
            if (!isset($h5Size)) {//If there's no google font then create the option
                add_option('h5_size', $_POST['h5Size']);
            } else { //else insert the option
                update_option('h5_size', $_POST['h5Size']);
            }
        }
        //Get h1 after it has been sent
        $h5Size = get_option('h5_size');

        //If h4 is set upsert the option
        if (isset($_POST['h4Size'])) {
            $h4Size = get_option('h4_size');
            if (!isset($h4Size)) {//If there's no google font then create the option
                add_option('h4_size', $_POST['h4Size']);
            } else { //else insert the option
                update_option('h4_size', $_POST['h4Size']);
            }
        }
        //Get h1 after it has been sent
        $h4Size = get_option('h4_size');

        //If h3 is set upsert the option
        if (isset($_POST['h3Size'])) {
            $h3Size = get_option('h3_size');
            if (!isset($h3Size)) {//If there's no google font then create the option
                add_option('h3_size', $_POST['h3Size']);
            } else { //else insert the option
                update_option('h3_size', $_POST['h3Size']);
            }
        }
        //Get h1 after it has been sent
        $h3Size = get_option('h3_size');


        //If h2 is set upsert the option
        if (isset($_POST['h2Size'])) {
            $h2Size = get_option('h2_size');
            if (!isset($h2Size)) {//If there's no google font then create the option
                add_option('h2_size', $_POST['h2Size']);
            } else { //else insert the option
                update_option('h2_size', $_POST['h2Size']);
            }
        }
        //Get h1 after it has been sent
        $h2Size = get_option('h2_size');

        //If fontSize is set upsert the option
        if (isset($_POST['h1Size'])) {
            $h1Size = get_option('h1_size');
            if (!isset($h1Size)) {//If there's no google font then create the option
                add_option('h1_size', $_POST['h1Size']);
            } else { //else insert the option
                update_option('h1_size', $_POST['h1Size']);
            }
        }
        //Get the google font after it has been sent
        $h1Size = get_option('h1_size');

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
        if (isset($_POST['primaryColor'])) {
            $fontColor = get_option('primary_color');
            if (!isset($fontColor)) {//If there's no font color then create the option
                add_option('primary_color', $_POST['primaryColor']);
            } else { //else insert the option
                update_option('primary_color', $_POST['primaryColor']);
            }
        }
        //Get the font color after it has been sent
        $primaryColor = get_option('primary_color');

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

        <!-- Form to insert google font-->
        <form method="post" action="">
            <label>Google Font</label><br/>
            <input name="googleFont" type="text"
                   value="<?php echo($googleFont ? $googleFont : 'Copy and paste your google font in here') ?>"/>
            <input type="submit"/>
        </form><br/>

        <!-- Form to add the google font family -->
        <form method="post" action="">
            <label>Google Font Family Name</label><br/>
            <input name="googleFontFamily" type="text"
                   value="<?php echo($googleFontFamily ? $googleFontFamily : 'Paste the name of your font family in here') ?>"/>
            <input type="submit"/>
        </form><br/>

        <!-- Form to set the primary colour -->
        <form method="post" action="">
            <label>Primary Colour</label><br/>
            <input name="primaryColor" type="text"
                   value="<?php echo($primaryColor ? $primaryColor : 'Primary colour') ?>"/>
            <input type="submit"/>
        </form><br/>

        <!-- Font to set the standard font size-->
        <form method="post" action="">
            <label>Standard font size</label><br/>
            <input name="fontSize" type="text"
                   value="<?php echo($fontSize ? $fontSize : 'Font size') ?>"/>
            <input type="submit"/>
        </form><br/>

        <!-- Set h1 size -->
        <form method="post" action="">
            <label>H1 font size</label><br/>
            <input name="h1Size" type="text"
                   value="<?php echo($h1Size ? $h1Size : 'H1 font size') ?>"/>
            <input type="submit"/>
        </form><br/>

        <!-- Set h2 size-->
        <form method="post" action="">
            <label>H2 font size</label><br/>
            <input name="h2Size" type="text"
                   value="<?php echo($h2Size ? $h2Size : 'H2 font size') ?>"/>
            <input type="submit"/>
        </form><br/>

        <!-- Set h3 size-->
        <form method="post" action="">
            <label>H3 font size</label><br/>
            <input name="h3Size" type="text"
                   value="<?php echo($h3Size ? $h3Size : 'H3 font size') ?>"/>
            <input type="submit"/>
        </form><br/>

        <!-- Set h4 size-->
        <form method="post" action="">
            <label>H4 font size</label><br/>
            <input name="h4Size" type="text"
                   value="<?php echo($h4Size ? $h4Size : 'H4 font size') ?>"/>
            <input type="submit"/>
        </form><br/>

        <!-- Set h5 size-->
        <form method="post" action="">
            <label>H5 font size</label><br/>
            <input name="h5Size" type="text"
                   value="<?php echo($h5Size ? $h5Size : 'H5 font size') ?>"/>
            <input type="submit"/>
        </form><br/>

        <!-- Set h6 size-->
        <form method="post" action="">
            <label>H6 font size</label><br/>
            <input name="h6Size" type="text"
                   value="<?php echo($h6Size ? $h6Size : 'H6 font size') ?>"/>
            <input type="submit"/>
        </form><br/>



    </div>


    <?php
}

/*Load up the Google font in the head section.*/
function hook_css()
{
    //Get the google font after it has been sent
    $googleFont = stripslashes(htmlspecialchars(get_option('google_font')));
    $googleFontFamily = stripslashes(htmlspecialchars(get_option('google_font_family')));
    $primaryColor = get_option('primary_color');
    $fontSize = stripslashes(htmlspecialchars(get_option('font_size')));
    $h1Size = get_option('h1_size');
    $h2Size = get_option('h2_size');
    $h3Size = get_option('h3_size');
    $h4Size = get_option('h4_size');
    $h5Size = get_option('h5_size');
    $h6Size = get_option('h6_size');

    //Add the link for the google font
    echo html_entity_decode($googleFont);

    //Apply the style for the google font
    ?>
    <style>
        p, div, h1, h2, h3, h4, h5, h6 , a{
            font-family: '<?php echo html_entity_decode($googleFontFamily); ?>';
            color: rgba(<?php echo $primaryColor; ?>, 0.9);
        }
        h1, .entry-content h1, .comment-content h1{
            font-size: <?php echo $h1Size;  ?>px;
        }
        h2, .entry-content h2, .comment-content h2{
            font-size: <?php echo $h2Size;  ?>px;
        }
        h3, .entry-content h3, .comment-content h3{
            font-size: <?php echo $h3Size;  ?>px;
        }
        h4, .entry-content h4, .comment-content h4{
            font-size: <?php echo $h4Size;  ?>px;
        }
        h5, .entry-content h5, .comment-content h5{
            font-size: <?php echo $h5Size;  ?>px;
        }
        h6, .entry-content h6, .comment-content h6{
            font-size: <?php echo $h6Size;  ?>px;
        }
        p{
            font-size: <?php echo $fontSize . 'px'; ?>;
        }
        body.has-header-image .site-description, body.has-header-video .site-description{
            color: rgba(<?php echo $primaryColor; ?>, 0.8);
        }
        body.has-header-image .site-title, body.has-header-video .site-title, body.has-header-image .site-title a, body.has-header-video .site-title a{
            color: rgba(<?php echo $primaryColor; ?>, 0.8);
        }
        h2.widget-title{
            color: rgba(<?php echo $primaryColor; ?>, 0.8);
        }
        .search-form .search-submit{
            background: rgba(<?php echo $primaryColor; ?>, 0.7);
        }
        input[type="search"]::placeholder{
            color: rgba(<?php echo $primaryColor; ?>, 0.8);
        }
        input[type="search"]{
            border: rgba(<?php echo $primaryColor; ?>, 0.8);
        }
        .page .panel-content .entry-title, .page-title{
            color: rgba(<?php echo $primaryColor; ?>, 0.8);
        }
        .entry-meta a{
            color: rgba(<?php echo $primaryColor; ?>, 0.8);
        }
        .entry-meta a:hover{
            color: rgba(<?php echo $primaryColor; ?>, 1);
        }
        .entry-content a:focus, .entry-content a:hover, .entry-summary a:focus, .entry-summary a:hover, .comment-content a:focus, .comment-content a:hover, .widget a:focus, .widget a:hover, .site-footer .widget-area a:focus, .site-footer .widget-area a:hover, .posts-navigation a:focus, .posts-navigation a:hover, .comment-metadata a:focus, .comment-metadata a:hover, .comment-metadata a.comment-edit-link:focus, .comment-metadata a.comment-edit-link:hover, .comment-reply-link:focus, .comment-reply-link:hover, .widget_authors a:focus strong, .widget_authors a:hover strong, .entry-title a:focus, .entry-title a:hover, .entry-meta a:focus, .entry-meta a:hover, .page-links a:focus .page-number, .page-links a:hover .page-number, .entry-footer a:focus, .entry-footer a:hover, .entry-footer .cat-links a:focus, .entry-footer .cat-links a:hover, .entry-footer .tags-links a:focus, .entry-footer .tags-links a:hover, .post-navigation a:focus, .post-navigation a:hover, .pagination a:not(.prev):not(.next):focus, .pagination a:not(.prev):not(.next):hover, .comments-pagination a:not(.prev):not(.next):focus, .comments-pagination a:not(.prev):not(.next):hover, .logged-in-as a:focus, .logged-in-as a:hover, a:focus .nav-title, a:hover .nav-title, .edit-link a:focus, .edit-link a:hover, .site-info a:focus, .site-info a:hover, .widget .widget-title a:focus, .widget .widget-title a:hover, .widget ul li a:focus, .widget ul li a:hover {
            -webkit-box-shadow: inset 0 0 0 rgba(0, 0, 0, 0), 0 3px 0 rgba(<?php echo $primaryColor; ?>, 0.8);
            box-shadow: inset 0 0 0 rgba(0, 0, 0, 0), 0 3px 0 rgba(<?php echo $primaryColor; ?>, 0.8);
        }
        .blog .entry-meta a.post-edit-link, .archive .entry-meta a.post-edit-link, .search .entry-meta a.post-edit-link{
            color: rgba(<?php echo $primaryColor; ?>, 0.7);
        }
        .entry-title a{
            color: rgba(<?php echo $primaryColor; ?>, 0.7);
        }
        .entry-title a:hover{
            color: rgba(<?php echo $primaryColor; ?>, 1);
        }
        *, *:before, *:after{
             color: rgba(<?php echo $primaryColor; ?>, 0.7);
        }
        .site-header .menu-scroll-down{
            color: rgba(<?php echo $primaryColor; ?>, 0.7);
        }
        .site-header .menu-scroll-down:hover, .site-header .menu-scroll-down:focus{
            color: rgba(<?php echo $primaryColor; ?>, 1);
        }
        .entry-footer .edit-link a.post-edit-link{
            background-color: rgba(<?php echo $primaryColor; ?>, 1);
        }
        #page{
            background-color: rgba(<?php echo $primaryColor; ?>, 0.1);
        }
    </style>
    <?php
}

add_action('wp_head', 'hook_css');
