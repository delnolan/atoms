<?php
/**
 * Plugin Name: Atoms
 * Description: Set Options in the admin panel
 */

add_action('admin_menu', 'plugin_menu');


function plugin_menu()
{
    add_options_page('Atoms', 'Atoms', 'manage_options', 'atoms', 'atoms_options');
}


//Add Pretty dropdowns
function pretty_dropdowns_js() {
    //Load jQuery before pretty dropdowns
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'pretty_dropdowns_js', plugin_dir_url( __FILE__ ) . 'assets/jquery.prettydropdowns.js' );
}
add_action('wp_enqueue_scripts', 'pretty_dropdowns_js');
function pretty_dropdowns_css()
{
    wp_enqueue_style( 'pretty_dropdowns_css', plugin_dir_url( __FILE__ ) . 'assets/prettydropdowns.css' );
}

add_action('wp_enqueue_scripts', 'pretty_dropdowns_css');

//Add Checkator
function checkator_js() {
    //Load jQuery before checkator
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'checkator_js', plugin_dir_url( __FILE__ ) . 'assets/fm.checkator.jquery.js' );
}
add_action('wp_enqueue_scripts', 'checkator_js');
function checkator_css()
{
    wp_enqueue_style( 'checkator_css', plugin_dir_url( __FILE__ ) . 'assets/fm.checkator.jquery.css' );
}

add_action('wp_enqueue_scripts', 'checkator_css');

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
    $h1Size = round($fontSize * 2.5);
    $h2Size = round($fontSize * 2.2);
    $h3Size = round($fontSize * 2);
    $h4Size = round($fontSize * 1.8);
    $h5Size = round($fontSize * 1.5);
    $h6Size = round($fontSize * 1.2);
    $smallerFont = round($fontSize * 0.8);

    //Add the link for the google font
    echo html_entity_decode($googleFont);

    //Apply the style for the google font
    ?>
    <style>
        p, div, h1, h2, h3, h4, h5, h6 , a , label, .page .panel-content .entry-title, .page-title, body.page:not(.twentyseventeen-front-page) .entry-title, .archive-title, .page-title, .widget-title, .entry-content th, .comment-content th, .widget-area .widget a:visited, .prettydropdown > ul{
             font-family: '<?php echo html_entity_decode($googleFontFamily); ?>';
             color: rgba(<?php echo $primaryColor; ?>, 0.9) !important;
         }
        input , textarea{
            font-family: '<?php echo html_entity_decode($googleFontFamily); ?>';
            color: rgba(<?php echo $primaryColor; ?>, 0.6);
        }
        input:focus, input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea:focus {
            color: rgba(<?php echo $primaryColor; ?>, 1);
            border: 1px solid rgba(<?php echo $primaryColor; ?>, 0.5   );
            outline: 0px;
        }
        table, tr, td{
            font-size: <?php echo $smallerFont; ?>px;
        }
        h1, .entry-content h1, .comment-content h1{
            font-size: <?php echo $h1Size;  ?>px;
            line-height: <?php echo $h1Size;  ?>px;
        }
        h2, .entry-content h2, .comment-content h2{
            font-size: <?php echo $h2Size;  ?>px;
            line-height: <?php echo $h2Size;  ?>px;
        }
        h3, .entry-content h3, .comment-content h3{
            font-size: <?php echo $h3Size;  ?>px;
            line-height: <?php echo $h3Size;  ?>px;
        }
        h4, .entry-content h4, .comment-content h4{
            font-size: <?php echo $h4Size;  ?>px;
            line-height: <?php echo $h4Size;  ?>px;
        }
        h5, .entry-content h5, .comment-content h5{
            font-size: <?php echo $h5Size;  ?>px;
            line-height: <?php echo $h5Size;  ?>px;
        }
        h6, .entry-content h6, .comment-content h6{
            font-size: <?php echo $h6Size;  ?>px;
            line-height: <?php echo $h6Size;  ?>px;
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
        button{
            font-family: <?php echo $googleFontFamily; ?>;
            text-transform: uppercase;
            background-color: rgba(<?php echo $primaryColor; ?>,0.5);
            color: #ffffff;
            border-radius: 2px;
            border: 1px solid rgb(<?php echo $primaryColor; ?>)
        }
        button:hover{
            background-color: rgba(<?php echo $primaryColor; ?>,0.8);
        }
        input, textarea {
            padding: 13px 20px;
            font-size: 15px;
            border: 1px solid rgb(<?php echo $primaryColor; ?>);
            border-radius: 3px;
        }
        button.secondary, input[type="reset"], input[type="button"].secondary, input[type="reset"].secondary, input[type="submit"].secondary, input[type="submit"], .read-more, .nav-previous a, .nav-next a, button{
            font-family: <?php echo $googleFontFamily; ?>;
            text-transform: uppercase;
            background-color: rgba(<?php echo $primaryColor; ?>,0.5);
            background-image: none;
            border-radius: 2px;
            border: 1px solid rgb(<?php echo $primaryColor; ?>);
            color: #ffffff !important;
            padding: 11px 32px;
            cursor: pointer;
            font-weight: 600;
        }
        button.secondary:hover, input[type="reset"]:hover, input[type="button"].secondary:hover, input[type="reset"].secondary:hover, input[type="submit"].secondary:hover , input[type="submit"]:hover , .read-more:hover, .nav-previous a:hover, .nav-next a:hover, button:hover{
            background-color: rgba(<?php echo $primaryColor; ?>,0.8);
            background-image: none !important;
            webkit-box-shadow: none !important;
            box-shadow: none !important;
        }
        fieldset {
            border: 1px solid rgba(<?php echo $primaryColor; ?>,0.5);
        }
        .checkator_element.checkbox {
            border: 1px solid rgba(<?php echo $primaryColor; ?>,0.5);
            width: 100%;
            height: 100%;
        }
        div.checkator_holder.radio{
            width: 14px !important;
            height: 14px !important;
        }

        .checkator_element.radio {
            border: 1px solid rgba(<?php echo $primaryColor; ?>,0.5);
            width: 100%;
            height: 100%;
        }
        .checkator_source:checked+.checkator_element:after {
            background-color: rgb(<?php echo $primaryColor; ?>);
            border: 2px solid rgba(<?php echo $primaryColor; ?>,0.5);
        }
        .checkator_source:hover+.checkator_element { /* Hovered element */
            /* Bug: There is a bug in chrome preventing this from working correctly */
            background-color: rgba(<?php echo $primaryColor; ?>, 0.1);
            border: 1px solid rgba(<?php echo $primaryColor; ?>,0.5);
        }
        .checkator_source:focus+.checkator_element { /* Focused element */
            border: 2px solid rgba(<?php echo $primaryColor; ?>, 0.1);
        }
        .checkator_source:checked+.checkator_element:after {
            top: 50%;
            left:50%;
            width: 7px;
            height: 7px;
            transform: translateX(-50%) translateY(-50%);
        }
        button, input[type="button"], input[type="submit"]{
             background-color: rgba(<?php echo $primaryColor; ?>,0.8);
         }
        button, input[type="button"]:hover, input[type="submit"]:hover{
            background-color: rgba(<?php echo $primaryColor; ?>,1);
        }
        .prettydropdown > ul{
            border: 1px solid rgba(<?php echo $primaryColor; ?>,0.5);
        }
        .prettydropdown > ul:focus, .prettydropdown:not(.disabled) > ul:hover {
            border: 1px solid rgba(<?php echo $primaryColor; ?>,0.9);
        }
        .prettydropdown.arrow > ul > li.selected:before{
            border-top-color: rgba(<?php echo $primaryColor; ?>,0.5);
        }
        .prettydropdown > ul.active > li.nohover {
            color: rgba(<?php echo $primaryColor; ?>, 0.7) !important;
        }
        .entry-meta .meta-home-blog{
            border-bottom: 1px solid rgba(<?php echo $primaryColor; ?>,0.5);
        }
        .entry-content table, .comment-content table {
            border-bottom: 1px solid rgba(<?php echo $primaryColor; ?>, 0.9);
        }
        .entry-content td, .comment-content td {
            border-top: 0 none;
        }
    </style>
    <script>
        jQuery(document).ready(function() {
            jQuery('select').prettyDropdown({
                classic:true
            });
            jQuery("input[type='checkbox']").checkator();
            jQuery("input[type='radio']").checkator();
        });
    </script>

    </script>
    <?php
}

add_action('wp_head', 'hook_css');
