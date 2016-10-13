<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
    <style type="text/css">
        <!--
        /* System styles 404 */
        body, html {
            margin: 0;
            padding: 0;
        }

        #error .row1 {
            background: #000;
            height: 50px;
        }

        #error .row2 {
            background: #3b2a2a;
            height: 20px;
        }

        #error .row3 {
            background: #f2f2f2;
        }

        #error .row4 {
            background: #000;
            height: 27px;
            text-align: center;
            color: #fff;
            font-size: 1em;
            padding-top: 3px;
        }

        body#error {
            background: #291e1e;
        }

        #error .box {
            width: 600px;
            margin: 0 auto;
            color: #555;
        }

        #error h1, #error h2 {
            line-height: 120px;
            font-size: 120px;
            color: #88676D;
            margin: 10px auto;
            text-align: center;
        }

        #error h2 {
            font-size: 40px;
            margin: 0 0 20px;
            line-height: 40px;
            color: #555;
        }

        #error p {
            border-bottom: 1px solid #555;
            padding-bottom: 6px;
            margin: 24px 0 12px 0;
        }

        p.adminmessage {
            text-align: center;
            background: #918E5D;
            border: 1px solid #121212;
            padding: 6px 10px;
            margin: 30px 0;
            color: #fff;
        }

        #techinfo {
            padding: 5px;
        }

        #techinfo p {
            margin: 0;
            padding: 4px 0;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            border-top: 1px solid #f3f3f3;
            border-bottom: 1px solid #f3f3f3;
            text-align: center;
        }

        a, a:visited, a:focus {
            text-decoration: none;
            color: #704537;
            outline: none;
        }

        a:hover {
            color: #333;
        }

        form#searchform {
            width: 330px;
            margin-left: auto;
            margin-right: auto;
        }

        #search{
            float: none;
            margin-left: auto;
            margin-right: auto;
        }

        div.alternatives{
            text-align: center;
        }

        -->
    </style>
</head>

<body id="error">
<div class="row1"></div>
<div class="row2"></div>
<div class="row3">
    <div class="box">
        <h1>404</h1>

        <h2><?php _e('Not Found', 'eveningshade'); ?></h2>

        <p><strong>You are not able to visit this page because of one or more of the following:</strong></p>
        <ol>
            <li>you have an <strong>out-of-date bookmark </strong>for this page;</li>
            <li>a search engine has an <strong>out-of-date listing</strong> for this site;</li>
            <li>a <strong>mistyped or misspelled address</strong>;</li>
            <li>a website owner missed something;</li>
            <li>this page was renamed but not redirected to the new one;</li>
            <li>this page was moved to another location or simply removed;</li>
            <li>An error has occurred while processing your request.</li>
        </ol>
        <p><strong>Please try one of the following:</strong></p>

        <div id="search">
            <form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
                <div><label class="screen-reader-text" for="s"><?php _e('Search the site:', 'eveningshade'); ?></label>
                    <input value="" name="s" id="s_top" type="text" onFocus="this.value=''">
                    <input id="searchsubmit_top" value="Search" type="submit">
                </div>
            </form>
        </div>
        <div class="alternatives">
            <br/>
            or
            <br/>
            <br/>
            <a href="<?php bloginfo('siteurl'); ?>" title="Go to the Home Page">GO TO THE HOME PAGE</a>
        </div>

        <p class="adminmessage">If difficulties persist, please contact the System Administrator of this site.</p>

        <div id="techinfo">
            <p></p>
        </div>
    </div>
</div>

<div class="row4">Content not found</div>
<?php wp_footer(); ?>
</body>
</html>