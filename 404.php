<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8" />
    <title><?php  wp_title( '' ); ?></title>
</head>
<body>
<!--
  Original: https://bootstraptema.ru/stuff/templates_bootstrap/404/light_404/11-1-0-2191
-->
<style>
html,
body {
    width: 100%;
    height: 100%;
    margin: 0px;
    display: flex;
    align-items: center;

}
.wrapper {
  width: 80%;
  max-width: 1500px;
  margin-left: auto;
  margin-right: auto;
  text-align: center;
}
.title {
    font-size: 2em;
    background-image: linear-gradient(to right, #343f69 45%, #394986 80%);
    background-clip: border-box;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-decoration: none;
}
.btn {
    width: 250px;
    height: 46px;
    line-height: 46px;
    border-radius: 17px;
    font-size: 1em;

    display: inline-block;

    color: #fff;
    text-shadow: 0 0 2px #343f699e;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    font-family: 'Source Sans Pro', sans-serif;
    position: relative;
    overflow: hidden;
    z-index: 1;

    text-transform: uppercase;
    border: none;
    transition: .5s ease;
}
.btn:hover {
    font-size: .9em;
}
.btn:hover::after {
    transform: rotate(180deg);
}
.btn::after {
    content: "";
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    transition: .3s ease;
    z-index: -1;
    transition: rotate .0s ease;
}
.ocean-blue::after {
    background-image: linear-gradient(to right,#2E3192,#1BFFFF);
    text-shadow: 0 0 2px #2E3192;
}
.sanguine::after {
    background-image: linear-gradient(to right,#D4145A,#FBB03B);
    text-shadow: 0 0 2px #D4145A;
}
img {
    transition: .9s ease;
}
.img-hidden {
    position: absolute;
    z-index: -5;
    transform: scale(0);
}
</style>

<div class="wrapper">
    
    <img src="<?php echo get_template_directory_uri() . '/assets/images/'?>404.png" alt="404 error" />
    <img src="<?php echo get_template_directory_uri() . '/assets/images/'?>404.gif" class="img-hidden" alt="404 error" />

    <h3 class="title">
        <?php echo __("_404-title", DOMAIN_LANG); ?>
    </h3>

    <a href="<?php site_url(); ?>/" class="btn ocean-blue">
        <?php echo __("_Home title", DOMAIN_LANG); ?>
    </a>
    <a href="mailto:<?php echo get_bloginfo( 'admin_email' ); ?>" class="btn sanguine">
        <?php echo __("_Email Contact", DOMAIN_LANG); ?>
    </a>

</div>

<script>

    setTimeout(() => {
        let img = document.getElementsByTagName("img");
        img[1].classList.remove("img-hidden");
        img[0].classList.add("img-hidden");
        document.body.style.backgroundColor = "#f0ff79";
    }, 1500);

</script>

</body>
</html>