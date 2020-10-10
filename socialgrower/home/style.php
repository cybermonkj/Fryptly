<?php
    header("Content-type: text/css; charset: UTF-8");
?>
<?php
session_start();
require("../lib/mainconfig.php");
$check_settings = mysqli_query($db, "SELECT * FROM settings WHERE id = '1'");
$data_settings = mysqli_fetch_assoc($check_settings);
?>

body {
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    font-weight: 300;
    line-height: 1.5;
    color: #666666;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    overflow-x: hidden;
}

iframe {
    border: none;
}

a,
b,
div,
ul,
li {
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    -webkit-tap-highlight-color: transparent;
    -moz-outline-: none;
}

a,
a:hover,
a:focus,
a:active {
    color: red;
}

a:focus,
a:active,
input,
input:hover,
input:focus,
input:active,
textarea,
textarea:hover,
textarea:focus,
textarea:active {
    -moz-outline: none;
    outline: none;
}

img:not([draggable]),
embed,
object,
video {
    max-width: 100%;
    height: auto;
}

a,
a:active,
a:focus,
a:hover,
a:visited {
    text-decoration: none;
    outline: 0;
    color: #222222;
}

img {
    border: none;
    max-width: 100%;
}

ul {
    margin: 0;
    padding: 0;
    list-style: none
}

h1,
h2,
h3,
h4,
h5,
h6,
a,
ul,
li {
    line-height: 1;
}

.clear-both:before,
.clear-both:after {
    display: table;
    content: "";
    clear: both;
}

.section-padding {
    padding: 130px 0;
}

.section-padding-top {
    padding-top: 100px;
}

.content-margin-top {
    margin-top: 130px;
}

.apps-craft-sub-scribe-section.section-padding {
    padding: 230px 0 130px 0;
}

.apps-craft-feature-section .content-margin-top {
    margin-top: 200px;
}

.apps-craft-section-heading {
    text-align: center;
}

.apps-craft-section-heading h2 {
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 700;
    color: #777777;
    font-size: 4.143em;
    display: inline-block;
}

.apps-craft-section-heading.white h2 {
    background-image: none;
    -webkit-text-fill-color: #fff;
}

.apps-craft-btn.play-store-btn {
    display: inline-block;
    width: 180px;
    height: 70px;
    border-radius: 3px;
    background-color: #fff;
    text-align: center;
    line-height: 70px;
}

.apps-craft-btn.app-store-btn {
    width: 180px;
    height: 70px;
    border-radius: 3px;
    text-align: center;
    line-height: 70px;
    display: inline-block;
}

.apps-craft-btn {
    margin: 0 60px 0 0;
}

.apps-craft-btn:last-child {
    margin: 0;
}

.apps-craft-welcome-tbl {
    height: 100vh;
    width: 100%;
    ;
    display: table;
}

.apps-craft-welcome-tbl-c {
    display: table-cell;
    vertical-align: middle;
}

.apps-craft-tbl {
    display: table;
    height: 100%;
    width: 100%;
}

.apps-craft-tbl-c {
    display: table-cell;
    vertical-align: middle;
}

.apps-craft-btn.solid-color {
    width: 140px;
    height: 50px;
    border-radius: 3px;
    background-color: #f2504d;
    box-shadow: 0 18px 32px rgba(0, 0, 0, .18);
    text-align: center;
    line-height: 40px;
    color: #E3E3E3;
    font-size: 1em;
    font-weight: 700;
    padding: 5px;
    display: inline-block;
    -webkit-transition: all .4s ease-in-out;
    transition: all .4s ease-in-out;
}

.apps-craft-btn.solid-color:hover {
    background-color: #232838;
    box-shadow: none;
}

#preloader {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: #fff;
    z-index: 99999999999999;
    background-image: url(img/Preloader_1.gif);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center center;
}

.d-flex {
    display: flex;
}

.align-items-center {
    align-items: center;
}

/*=====================================================================
		Apps Craft Gradient Version Color 
======================================================================================*/

.apps-craft-menu ul li a:hover,
.apps-craft-welcome-content h1 span,
.apps-craft-single-about span,
.apps-carft-screen-short-content #options #previous,
.apps-carft-screen-short-content #options #next,
.apps-craft-pricing-body h2,
.apps-craft-contact-form-content h2 span,
.apps-craft-accordion .panel-title a.collapsed:before {
    color: #F2504D;
}

.apps-craft-btn.app-store-btn {
    background-color: #f2504d;
    background-image: -webkit-linear-gradient( 63deg, rgb(250, 50, 111) 0%, rgb(246, 66, 94) 53%, rgb(242, 81, 76) 100%, rgb(242, 80, 77) 100%);
    background-image: -ms-linear-gradient( 63deg, rgb(250, 50, 111) 0%, rgb(246, 66, 94) 53%, rgb(242, 81, 76) 100%, rgb(242, 80, 77) 100%);
}

.apps-craft-section-heading h2 {
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-image: -webkit-linear-gradient(-106deg, #fa326f, #f2514c, #f2504d);
    background-image: -webkit-linear-gradient(196deg, #fa326f, #f2514c, #f2504d);
    background-image: linear-gradient(-106deg, #fa326f, #f2514c, #f2504d);
}

.apps-craft-feature-content:before {
    background-image: -webkit-linear-gradient( 63deg, rgb(250, 50, 111) 0%, rgb(246, 66, 94) 53%, rgb(242, 81, 76) 100%);
    background-image: -ms-linear-gradient( 63deg, rgb(250, 50, 111) 0%, rgb(246, 66, 94) 53%, rgb(242, 81, 76) 100%);
}

.apps-craft-feature-content i {
    background-image: -webkit-linear-gradient( 42deg, rgb(242, 81, 76) 0%, rgb(246, 66, 94) 52%, rgb(250, 50, 111) 100%);
    background-image: -ms-linear-gradient( 42deg, rgb(242, 81, 76) 0%, rgb(246, 66, 94) 52%, rgb(250, 50, 111) 100%);
}

.apps-craft-video-content a i {
    background-image: -webkit-linear-gradient(-106deg, #fa326f, #f2514c, #f2504d);
    background-image: -webkit-linear-gradient(196deg, #fa326f, #f2514c, #f2504d);
    background-image: linear-gradient(-106deg, #fa326f, #f2514c, #f2504d);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.fun-factorey-paralx-bg-1 {
    background-image: url(img/fun-factory-bg-1.png);
}

.fun-factorey-paralx-bg-2 {
    background-image: url(img/fun-factory-bg-2.png);
}

.apps-craft-single-fun i {
    color: #F45B64;
}

.apps-craft-testimonial-section {
    background-color: #f2504d;
    background-image: -webkit-linear-gradient( -20deg, rgb(242, 81, 76) 0%, rgb(242, 81, 76) 0%, rgb(242, 81, 77) 0%, rgb(242, 80, 77) 1%, rgb(246, 65, 94) 57%, rgb(250, 50, 111) 100%);
    background-image: -ms-linear-gradient( -20deg, rgb(242, 81, 76) 0%, rgb(242, 81, 76) 0%, rgb(242, 81, 77) 0%, rgb(242, 80, 77) 1%, rgb(246, 65, 94) 57%, rgb(250, 50, 111) 100%);
}

.apps-craft-commentor-img figcaption {
    background-color: #f2504d;
}

#apps-craft-testimonial-thumb figure:before {
    background-color: rgba(242, 80, 77, .57);
}

.apps-craft-dash-border:before {
    border-left: 1px dashed #E24B48;
}

.apps-craft-team-member-pic:before {
    background-color: #fff;
    background-image: -webkit-linear-gradient( 42deg, rgb(242, 81, 76) 0%, rgb(246, 66, 94) 52%, rgb(250, 50, 111) 100%);
    background-image: -ms-linear-gradient( 42deg, rgb(242, 81, 76) 0%, rgb(246, 66, 94) 52%, rgb(250, 50, 111) 100%);
}

.apps-craft-team-img:before {
    border-left: 1px dashed #F04F4C;
}

.apps-craft-subscribe-wraper {
    background-image: -webkit-linear-gradient( -20deg, rgb(242, 81, 76) 0%, rgb(242, 81, 76) 0%, rgb(242, 81, 77) 0%, rgb(242, 80, 77) 1%, rgb(246, 65, 94) 57%, rgb(250, 50, 111) 100%);
    background-image: -ms-linear-gradient( -20deg, rgb(242, 81, 76) 0%, rgb(242, 81, 76) 0%, rgb(242, 81, 77) 0%, rgb(242, 80, 77) 1%, rgb(246, 65, 94) 57%, rgb(250, 50, 111) 100%);
}

.apps-craft-subscribe-form input[type="submit"] {
    background-color: #f25552;
}

.apps-craft-accordion .panel-title a:before {
    background-color: #f34e50;
    background-image: -webkit-linear-gradient(-131deg, #fa326f, #f2504d 99%, #f2514c);
    background-image: -webkit-linear-gradient(221deg, #fa326f, #f2504d 99%, #f2514c);
    background-image: linear-gradient(-131deg, #fa326f, #f2504d 99%, #f2514c);
}

.apps-craft-accordion .panel-title {
    background-color: #f2504d;
    background-image: -webkit-linear-gradient( 4deg, rgb(242, 81, 76) 0%, rgb(242, 81, 76) 0%, rgb(242, 81, 77) 0%, rgb(242, 80, 77) 1%, rgb(246, 65, 94) 57%, rgb(250, 50, 111) 100%);
    background-image: -ms-linear-gradient( 4deg, rgb(242, 81, 76) 0%, rgb(242, 81, 76) 0%, rgb(242, 81, 77) 0%, rgb(242, 80, 77) 1%, rgb(246, 65, 94) 57%, rgb(250, 50, 111) 100%);
}

.apps-craft-accordion .panel-title a.collapsed:before {
    background-image: none;
}

.apps-craft-contact-form input[type="submit"] {
    background-color: #f24f4e;
    background-image: -webkit-linear-gradient( 35deg, rgb(250, 50, 111) 0%, rgb(246, 66, 94) 53%, rgb(242, 81, 76) 100%, rgb(242, 80, 77) 100%);
    background-image: -ms-linear-gradient( 35deg, rgb(250, 50, 111) 0%, rgb(246, 66, 94) 53%, rgb(242, 81, 76) 100%, rgb(242, 80, 77) 100%);
}

/*=================================================================== 
		Apps Craft Solid Color Version 
==================================================================================*/

.apps-craft-solid-color .apps-craft-menu ul li a:hover,
.apps-craft-solid-color .apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a:hover,
.apps-craft-solid-color .apps-craft-welcome-content h1 span,
.apps-craft-solid-color .apps-craft-single-about span,
.apps-craft-solid-color .apps-carft-screen-short-content #options #previous,
.apps-craft-solid-color .apps-carft-screen-short-content #options #next,
.apps-craft-solid-color .apps-craft-pricing-body h2,
.apps-craft-solid-color .apps-craft-contact-form-content h2 span,
.apps-craft-solid-color .apps-craft-accordion .panel-title a.collapsed:before,
.apps-craft-solid-color .apps-craft-feature-content i,
.apps-craft-solid-color .apps-craft-single-fun i {
    color: #1390FB;
}

.apps-craft-solid-color .apps-craft-section-heading h2 {
    background-image: none;
    -webkit-text-fill-color: #1390FB;
}

.apps-craft-solid-color .apps-craft-section-heading.white h2 {
    background-image: none;
    -webkit-text-fill-color: #FFF;
}

.apps-craft-solid-color .apps-craft-feature-content:before,
.apps-craft-solid-color .apps-craft-feature-content i {
    background-image: none;
    background-color: #1390FB;
    color: #fff;
}

.apps-craft-solid-color .apps-craft-testimonial-section {
    background-color: #1390FB;
    background-image: none;
}

.apps-craft-solid-color .apps-craft-dash-border:before,
.apps-craft-solid-color .apps-craft-team-img:before {
    border-left-color: #1390FB;
}

.apps-craft-solid-color .apps-craft-video-content a i {
    background-image: none;
    -webkit-text-fill-color: #1390FB;
}

.apps-craft-solid-color .apps-craft-commentor-img figcaption {
    background-color: #1390FB;
}

.apps-craft-solid-color #apps-craft-testimonial-thumb figure:before {
    background-color: rgba(29, 161, 242, 0.57);
}

.apps-craft-solid-color .apps-craft-team-member-pic:before {
    background-image: none;
    background-color: rgba(29, 161, 242, 0.8);
}

.apps-craft-solid-color .apps-craft-subscribe-wraper,
.apps-craft-solid-color .apps-craft-accordion .panel-title,
.apps-craft-solid-color .apps-craft-contact-form input[type="submit"],
.apps-craft-solid-color .apps-craft-accordion .panel-title a:before,
.apps-craft-solid-color .apps-craft-btn.app-store-btn {
    background-image: none;
    background-color: #1390FB;
}

.apps-craft-solid-color .apps-craft-subscribe-form input[type="submit"] {
    background-color: #1390FB;
}

.apps-craft-solid-color .fun-factorey-paralx-bg-1 {
    background-image: url(img/blue-v/blue-fun-factory-bg-1.png);
}

.apps-craft-solid-color .apps-craft-pricing-1 {
    background-image: url(img/blue-v/blue-pricing-body-bg-1.png);
}

.apps-craft-solid-color .apps-craft-pricing-2 {
    background-image: url(img/blue-v/blue-pricing-body-bg-2.png);
}

.apps-craft-solid-color .apps-craft-pricing-3 {
    background-image: url(img/blue-v/blue-pricing-body-bg-3.png);
}

.apps-craft-solid-color .apps-craft-footer-section {
    background-image: url(img/blue-footer-bg.png);
}

.apps-craft-solid-color .apps-craft-btn.solid-color {
    background-color: #1390FB;
}

.apps-craft-solid-color .apps-craft-btn.solid-color:hover {
    background-color: #232838;
}

.apps-craft-solid-color .apps-craft-subscribe-form input[type="email"] {
    /*box-shadow: 0 18px 32px rgba(0,0,0,.28);*/
}

.apps-craft-solid-color .apps-craft-side-bar-menu:before,
.apps-craft-solid-color .apps-craft-side-menu:before {
    background-image: none;
    background-color: #1390FB;
}

.apps-craft-solid-color .apps-craft-menu-item ul li a:hover {
    color: #1390FB;
}

/*=================================================================== 
		Apps Craft Solid Color Version 2
==================================================================================*/

.apps-craft-solid-color-v2 .apps-craft-menu ul li a:hover,
.apps-craft-solid-color-v2 .apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a:hover,
.apps-craft-solid-color-v2 .apps-craft-welcome-content h1 span,
.apps-craft-solid-color-v2 .apps-craft-single-about span,
.apps-craft-solid-color-v2 .apps-carft-screen-short-content #options #previous,
.apps-craft-solid-color-v2 .apps-carft-screen-short-content #options #next,
.apps-craft-solid-color-v2 .apps-craft-pricing-body h2,
.apps-craft-solid-color-v2 .apps-craft-contact-form-content h2 span,
.apps-craft-solid-color-v2 .apps-craft-accordion .panel-title a.collapsed:before,
.apps-craft-solid-color-v2 .apps-craft-feature-content i,
.apps-craft-solid-color-v2 .apps-craft-single-fun i {
    color: #6D1FE9;
}

.apps-craft-solid-color-v2 .apps-craft-section-heading h2 {
    background-image: none;
    -webkit-text-fill-color: #6D1FE9;
}

.apps-craft-solid-color-v2 .apps-craft-section-heading.white h2 {
    background-image: none;
    -webkit-text-fill-color: #FFF;
}

.apps-craft-solid-color-v2 .apps-craft-feature-content:before,
.apps-craft-solid-color-v2 .apps-craft-feature-content i {
    background-image: none;
    background-color: #6D1FE9;
    color: #fff;
}

.apps-craft-solid-color-v2 .apps-craft-testimonial-section {
    background-color: #6d1fe9;
    background-image: none;
}

.apps-craft-solid-color-v2 .apps-craft-dash-border:before,
.apps-craft-solid-color-v2 .apps-craft-team-img:before {
    border-left-color: #6B1EE4;
}

.apps-craft-solid-color-v2 .apps-craft-video-content a i {
    background-image: none;
    -webkit-text-fill-color: #6D1FE9;
}

.apps-craft-solid-color-v2 .apps-craft-commentor-img figcaption {
    background-color: #6d1fe9;
}

.apps-craft-solid-color-v2 #apps-craft-testimonial-thumb figure:before {
    background-color: rgba(109, 31, 233, 0.57);
}

.apps-craft-solid-color-v2 .apps-craft-team-member-pic:before {
    background-image: none;
    background-color: rgba(109, 31, 233, 0.8);
}

.apps-craft-solid-color-v2 .apps-craft-subscribe-wraper,
.apps-craft-solid-color-v2 .apps-craft-accordion .panel-title,
.apps-craft-solid-color-v2 .apps-craft-contact-form input[type="submit"],
.apps-craft-solid-color-v2 .apps-craft-accordion .panel-title a:before,
.apps-craft-solid-color-v2 .apps-craft-btn.app-store-btn {
    background-image: none;
    background-color: #6D1FE9;
}

.apps-craft-solid-color-v2 .apps-craft-subscribe-form input[type="submit"] {
    background-color: #6D1FE9;
}

.apps-craft-solid-color-v2 .fun-factorey-paralx-bg-1 {
    background-image: url(img/solid-v-2/fun-factory-bg-1.png);
}

.apps-craft-solid-color-v2 .apps-craft-pricing-1 {
    background-image: url(img/solid-v-2/pricing-body-bg-1.png);
}

.apps-craft-solid-color-v2 .apps-craft-pricing-2 {
    background-image: url(img/solid-v-2/pricing-body-bg-2.png);
}

.apps-craft-solid-color-v2 .apps-craft-pricing-3 {
    background-image: url(img/solid-v-2/pricing-body-bg-3.png);
}

.apps-craft-solid-color-v2 .apps-craft-footer-section {
    background-image: url(img/solid-v-2/footer-bg.png);
}

.apps-craft-solid-color-v2 .apps-craft-btn.solid-color {
    background-color: #232838;
}

.apps-craft-solid-color-v2 .apps-craft-btn.solid-color:hover {
    background-color: #EEEEEE;
    color: #333333;
}

.apps-craft-solid-color-v2 .apps-craft-subscribe-form input[type="email"] {
    /*box-shadow: 0 18px 32px rgba(0,0,0,.28);*/
}

.apps-craft-solid-color-v2 .apps-craft-side-bar-menu:before,
.apps-craft-solid-color-v2 .apps-craft-side-menu:before {
    background-image: none;
    background-color: #6D1FE9;
}

.apps-craft-solid-color-v2 .apps-craft-menu-item ul li a:hover {
    color: #6D1FE9;
}

.apps-craft-solid-color-v2 .apps-craft-feature-content:hover p {
    color: #EEEEEE;
}

/*=================================================================== 
		Apps Craft Solid Color Version 3
==================================================================================*/

.apps-craft-solid-color-v3 .apps-craft-menu ul li a:hover,
.apps-craft-solid-color-v3 .apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a:hover,
.apps-craft-solid-color-v3 .apps-craft-welcome-content h1 span,
.apps-craft-solid-color-v3 .apps-craft-single-about span,
.apps-craft-solid-color-v3 .apps-carft-screen-short-content #options #previous,
.apps-craft-solid-color-v3 .apps-carft-screen-short-content #options #next,
.apps-craft-solid-color-v3 .apps-craft-pricing-body h2,
.apps-craft-solid-color-v3 .apps-craft-contact-form-content h2 span,
.apps-craft-solid-color-v3 .apps-craft-accordion .panel-title a.collapsed:before,
.apps-craft-solid-color-v3 .apps-craft-feature-content i,
.apps-craft-solid-color-v3 .apps-craft-single-fun i {
    color: #2BB4CA;
}

.apps-craft-solid-color-v3 .apps-craft-section-heading h2 {
    background-image: none;
    -webkit-text-fill-color: #2BB5CB;
}

.apps-craft-solid-color-v3 .apps-craft-section-heading.white h2 {
    background-image: none;
    -webkit-text-fill-color: #FFF;
}

.apps-craft-solid-color-v3 .apps-craft-feature-content:before,
.apps-craft-solid-color-v3 .apps-craft-feature-content i {
    background-image: none;
    background-color: #2BB5CB;
    color: #fff;
}

.apps-craft-solid-color-v3 .apps-craft-testimonial-section {
    background-color: #2BB4CA;
    background-image: none;
}

.apps-craft-solid-color-v3 .apps-craft-dash-border:before,
.apps-craft-solid-color-v3 .apps-craft-team-img:before {
    border-left-color: #2BB5CB;
}

.apps-craft-solid-color-v3 .apps-craft-video-content a i {
    background-image: none;
    -webkit-text-fill-color: #2BB5CB;
}

.apps-craft-solid-color-v3 .apps-craft-commentor-img figcaption {
    background-color: #1390FB;
}

.apps-craft-solid-color-v3 #apps-craft-testimonial-thumb figure:before {
    background-color: rgba(29, 161, 242, 0.57);
}

.apps-craft-solid-color-v3 .apps-craft-team-member-pic:before {
    background-image: none;
    background-color: rgba(43, 181, 203, 0.8);
}

.apps-craft-solid-color-v3 .apps-craft-subscribe-wraper,
.apps-craft-solid-color-v3 .apps-craft-accordion .panel-title,
.apps-craft-solid-color-v3 .apps-craft-contact-form input[type="submit"],
.apps-craft-solid-color-v3 .apps-craft-accordion .panel-title a:before,
.apps-craft-solid-color-v3 .apps-craft-btn.app-store-btn {
    background-image: none;
    background-color: #2BB4CA;
}

.apps-craft-solid-color-v3 .apps-craft-subscribe-form input[type="submit"] {
    background-color: #2BB5CB;
}

.apps-craft-solid-color-v3 .fun-factorey-paralx-bg-1 {
    background-image: url(img/solid-v-3/fun-factory-bg-1.png);
}

.apps-craft-solid-color-v3 .apps-craft-pricing-1 {
    background-image: url(img/solid-v-3/pricing-body-bg-1.png);
}

.apps-craft-solid-color-v3 .apps-craft-pricing-2 {
    background-image: url(img/solid-v-3/pricing-body-bg-2.png);
}

.apps-craft-solid-color-v3 .apps-craft-pricing-3 {
    background-image: url(img/solid-v-3/pricing-body-bg-3.png);
}

.apps-craft-solid-color-v3 .apps-craft-footer-section {
    background-image: url(img/solid-v-3/footer-bg.png);
}

.apps-craft-solid-color-v3 .apps-craft-btn.solid-color {
    background-color: #232838;
}

.apps-craft-solid-color-v3 .apps-craft-btn.solid-color:hover {
    background-color: #EEEEEE;
    color: #333333;
}

.apps-craft-solid-color-v3 .apps-craft-subscribe-form input[type="email"] {
    /*box-shadow: 0 18px 32px rgba(0,0,0,.28);*/
}

.apps-craft-solid-color-v3 .apps-craft-side-bar-menu:before,
.apps-craft-solid-color-v3 .apps-craft-side-menu:before {
    background-image: none;
    background-color: #2BB4CA;
}

.apps-craft-solid-color-v3 .apps-craft-menu-item ul li a:hover {
    color: #2BB4CA;
}

.apps-craft-solid-color-v3 .apps-craft-feature-content:hover p {
    color: #EEEEEE;
}

/*=================================================================== 
		Apps Craft Version 10
==================================================================================*/

.apps-craft-v10 .apps-craft-menu ul li a:hover,
.apps-craft-v10 .apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a:hover,
.apps-craft-v10 .apps-craft-welcome-content h1 span,
.apps-craft-v10 .apps-craft-single-about span,
.apps-craft-v10 .apps-carft-screen-short-content #options #previous,
.apps-craft-v10 .apps-carft-screen-short-content #options #next,
.apps-craft-v10 .apps-craft-pricing-body h2,
.apps-craft-v10 .apps-craft-contact-form-content h2 span,
.apps-craft-v10 .apps-craft-accordion .panel-title a.collapsed:before,
.apps-craft-v10 .apps-craft-feature-content i,
.apps-craft-v10 .apps-craft-single-fun i {
    color: #01C9FC;
}

.apps-craft-v10 .apps-craft-section-heading h2 {
    background-image: none;
    -webkit-text-fill-color: #333333;
}

.apps-craft-v10 .apps-craft-section-heading.white h2 {
    background-image: none;
    -webkit-text-fill-color: #FFF;
}

.apps-craft-v10 .apps-craft-feature-content:before,
.apps-craft-v10 .apps-craft-feature-content i {
    background-image: -webkit-linear-gradient( 42deg, rgb(123, 237, 147) 0%, rgb(62, 219, 200) 52%, rgb(1, 201, 252) 100%);
    background-image: -ms-linear-gradient( 42deg, rgb(123, 237, 147) 0%, rgb(62, 219, 200) 52%, rgb(1, 201, 252) 100%);
    color: #fff;
    background-color: transparent;
}

.apps-craft-v10 .apps-craft-testimonial-section {
    background-color: #17CFE8;
    background-image: -webkit-linear-gradient( -136deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-image: -ms-linear-gradient( -136deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
}

.apps-craft-v10 .apps-craft-commentor-bio h3 span {
    color: #333333;
}

.apps-craft-v10 .apps-craft-dash-border:before,
.apps-craft-v10 .apps-craft-team-img:before {
    border-left-color: #4E75D4;
}

.apps-craft-v10 .apps-craft-video-content a i {
    background-image: -webkit-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-image: -ms-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    -webkit-text-fill-color: transparent;
}

.apps-craft-v10 .apps-craft-commentor-img figcaption {
    background-color: #7BED93;
}

.apps-craft-v10 #apps-craft-testimonial-thumb figure:before {
    background-color: rgba(123, 237, 147, 0.57);
}

.apps-craft-v10 .apps-craft-team-member-pic:before {
    background-image: -webkit-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-image: -ms-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
}

.apps-craft-v10 .apps-craft-subscribe-wraper,
.apps-craft-v10 .apps-craft-accordion .panel-title,
.apps-craft-v10 .apps-craft-contact-form input[type="submit"],
.apps-craft-v10 .apps-craft-accordion .panel-title a:before,
.apps-craft-v10 .apps-craft-btn.app-store-btn {
    background-image: -webkit-linear-gradient( 0deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-image: -ms-linear-gradient( 0deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-color: transparent;
}

.apps-craft-v10 .apps-craft-subscribe-form input[type="submit"] {
    background-color: #01C9FC;
}

.apps-craft-v10 .fun-factorey-paralx-bg-1 {
    background-image: url(img/version-10/fun-factory-bg-1.png);
}

.apps-craft-v10 .apps-craft-pricing-1 {
    background-image: url(img/version-10/pricing-body-bg-1.png);
}

.apps-craft-v10 .apps-craft-pricing-2 {
    background-image: url(img/version-10/pricing-body-bg-2.png);
}

.apps-craft-v10 .apps-craft-pricing-3 {
    background-image: url(img/version-10/pricing-body-bg-3.png);
}

.apps-craft-v10 .apps-craft-footer-section {
    background-image: url(img/version-10/footer-bg.png);
}

.apps-craft-v10 .apps-craft-btn.solid-color {
    background-color: #232838;
}

.apps-craft-v10 .apps-craft-btn.solid-color:hover {
    background-color: #EEEEEE;
    color: #333333;
}

.apps-craft-v10 .apps-craft-subscribe-form input[type="email"] {
    /*box-shadow: 0 18px 32px rgba(0,0,0,.28);*/
}

.apps-craft-v10 .apps-craft-feature-content:hover p {
    color: #FFFFFF;
}

.apps-craft-v10 .apps-craft-accordion .panel-title a:before {
    background-color: #F4F4F4;
    background-image: none;
    color: #01C9FC;
}

.apps-craft-v10 .apps-craft-accordion .panel-title.click a:before {
    background-image: -webkit-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-image: -ms-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    color: #FFFFFF;
}

.apps-craft-v10 .apps-craft-accordion .panel-title.click {
    background-color: #FFFFFF;
    background-image: none;
}

.apps-craft-v10 .apps-craft-side-bar-menu:before,
.apps-craft-v10 .apps-craft-side-menu:before {
    background-image: -webkit-linear-gradient( 0deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-image: -ms-linear-gradient( 0deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-color: transparent;
}

.apps-craft-v10 .apps-craft-menu-item ul li a:hover {
    color: #01C9FC;
}

/*=================================================================== 
		Apps Craft Version 11
==================================================================================*/

.apps-craft-v11 .apps-craft-menu ul li a:hover,
.apps-craft-v11 .apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a:hover,
.apps-craft-v11 .apps-craft-welcome-content h1 span,
.apps-craft-v11 .apps-craft-single-about span,
.apps-craft-v11 .apps-carft-screen-short-content #options #previous,
.apps-craft-v11 .apps-carft-screen-short-content #options #next,
.apps-craft-v11 .apps-craft-pricing-body h2,
.apps-craft-v11 .apps-craft-contact-form-content h2 span,
.apps-craft-v11 .apps-craft-accordion .panel-title a.collapsed:before,
.apps-craft-v11 .apps-craft-feature-content i,
.apps-craft-v11 .apps-craft-single-fun i {
    color: #537DE4;
}

.apps-craft-v11 .apps-craft-section-heading h2 {
    background-image: none;
    -webkit-text-fill-color: #537DE4;
}

.apps-craft-v11 .apps-craft-section-heading.white h2 {
    background-image: none;
    -webkit-text-fill-color: #FFF;
}

.apps-craft-v11 .apps-craft-feature-content:before,
.apps-craft-v11 .apps-craft-feature-content i {
    background-image: -webkit-linear-gradient( 0deg, rgb(85, 127, 235) 0%, rgb(42, 237, 255) 100%);
    background-image: -ms-linear-gradient( 0deg, rgb(85, 127, 235) 0%, rgb(42, 237, 255) 100%);
    color: #fff;
    background-color: transparent;
}

.apps-craft-v11 .apps-craft-feature-content i {
    background-image: -webkit-linear-gradient( 42deg, rgb(43, 227, 247) 0%, rgb(72, 183, 242) 52%, rgb(101, 139, 236) 100%);
    background-image: -ms-linear-gradient( 42deg, rgb(43, 227, 247) 0%, rgb(72, 183, 242) 52%, rgb(101, 139, 236) 100%);
}

.apps-craft-v11 .apps-craft-testimonial-section {
    background-color: #31D2F4;
    background-image: -webkit-linear-gradient( -153deg, rgb(101, 139, 236) 0%, rgb(83, 125, 228) 0%, rgb(63, 176, 238) 60%, rgb(43, 227, 247) 100%);
    background-image: -ms-linear-gradient( -153deg, rgb(101, 139, 236) 0%, rgb(83, 125, 228) 0%, rgb(63, 176, 238) 60%, rgb(43, 227, 247) 100%);
}

.apps-craft-v11 .apps-craft-dash-border:before,
.apps-craft-v11 .apps-craft-team-img:before {
    border-left-color: #4466BA;
}

.apps-craft-v11 .apps-craft-video-content a i {
    background-image: -webkit-linear-gradient( 42deg, rgb(43, 227, 247) 0%, rgb(72, 183, 242) 52%, rgb(101, 139, 236) 100%);
    background-image: -ms-linear-gradient( 42deg, rgb(43, 227, 247) 0%, rgb(72, 183, 242) 52%, rgb(101, 139, 236) 100%);
    -webkit-text-fill-color: transparent;
}

.apps-craft-v11 .apps-craft-commentor-img figcaption {
    background-color: #537DE4;
}

.apps-craft-v11 #apps-craft-testimonial-thumb figure:before {
    background-color: rgba(83, 125, 228, 0.57);
}

.apps-craft-v11 .apps-craft-team-member-pic:before {
    background-image: -webkit-linear-gradient( 149deg, rgb(85, 127, 235) 0%, rgb(42, 237, 255) 100%);
    background-image: -ms-linear-gradient( 149deg, rgb(85, 127, 235) 0%, rgb(42, 237, 255) 100%);
}

.apps-craft-v11 .apps-craft-subscribe-wraper,
.apps-craft-v11 .apps-craft-accordion .panel-title,
.apps-craft-v11 .apps-craft-contact-form input[type="submit"],
.apps-craft-v11 .apps-craft-accordion .panel-title a:before,
.apps-craft-v11 .apps-craft-btn.app-store-btn {
    background-image: -webkit-linear-gradient( 0deg, rgb(85, 127, 235) 0%, rgb(42, 237, 255) 100%);
    background-image: -ms-linear-gradient( 0deg, rgb(85, 127, 235) 0%, rgb(42, 237, 255) 100%);
    background-color: transparent;
}

.apps-craft-v11 .apps-craft-subscribe-form input[type="submit"] {
    background-color: #537DE4;
}

.apps-craft-v11 .fun-factorey-paralx-bg-1 {
    background-image: url(img/version-11/fun-factory-bg-1.png);
}

.apps-craft-v11 .apps-craft-pricing-1 {
    background-image: url(img/version-11/pricing-body-bg-1.png);
}

.apps-craft-v11 .apps-craft-pricing-2 {
    background-image: url(img/version-11/pricing-body-bg-2.png);
}

.apps-craft-v11 .apps-craft-pricing-3 {
    background-image: url(img/version-11/pricing-body-bg-3.png);
}

.apps-craft-v11 .apps-craft-footer-section {
    background-image: url(img/version-11/footer-bg.png);
}

.apps-craft-v11 .apps-craft-btn.solid-color {
    background-color: #232838;
}

.apps-craft-v11 .apps-craft-btn.solid-color:hover {
    background-color: #EEEEEE;
    color: #333333;
}

.apps-craft-v11 .apps-craft-subscribe-form input[type="email"] {
    /*box-shadow: 0 18px 32px rgba(0,0,0,.28);*/
}

.apps-craft-v11 .apps-craft-feature-content:hover p {
    color: #FFFFFF;
}

.apps-craft-v11 .apps-craft-accordion .panel-title a:before {
    background-color: #F4F4F4;
    background-image: none;
    color: #01C9FC;
}

.apps-craft-v11 .apps-craft-accordion .panel-title.click a:before {
    background-image: -webkit-linear-gradient( 0deg, rgb(85, 127, 235) 0%, rgb(42, 237, 255) 100%);
    background-image: -ms-linear-gradient( 0deg, rgb(85, 127, 235) 0%, rgb(42, 237, 255) 100%);
    color: #FFFFFF;
}

.apps-craft-v11 .apps-craft-accordion .panel-title.click {
    background-color: #FFFFFF;
    background-image: none;
}

.apps-craft-v11 .apps-craft-side-bar-menu:before,
.apps-craft-v11 .apps-craft-side-menu:before {
    background-image: -webkit-linear-gradient( 0deg, rgb(85, 127, 235) 0%, rgb(42, 237, 255) 100%);
    background-image: -ms-linear-gradient( 0deg, rgb(85, 127, 235) 0%, rgb(42, 237, 255) 100%);
    background-color: transparent;
}

.apps-craft-v11 .apps-craft-menu-item ul li a:hover {
    color: #5079DB;
}

/*=================================================================== 
		Apps Craft Version 12
==================================================================================*/

.apps-craft-v12 .apps-craft-menu ul li a:hover,
.apps-craft-v12 .apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a:hover,
.apps-craft-v12 .apps-craft-welcome-content h1 span,
.apps-craft-v12 .apps-craft-single-about span,
.apps-craft-v12 .apps-carft-screen-short-content #options #previous,
.apps-craft-v12 .apps-carft-screen-short-content #options #next,
.apps-craft-v12 .apps-craft-pricing-body h2,
.apps-craft-v12 .apps-craft-contact-form-content h2 span,
.apps-craft-v12 .apps-craft-accordion .panel-title a.collapsed:before,
.apps-craft-v12 .apps-craft-feature-content i,
.apps-craft-v12 .apps-craft-single-fun i {
    color: #FDBE39;
}

.apps-craft-v12 .apps-craft-section-heading h2 {
    background-image: none;
    -webkit-text-fill-color: #333333;
}

.apps-craft-v12 .apps-craft-section-heading.white h2 {
    background-image: none;
    -webkit-text-fill-color: #FFF;
}

.apps-craft-v12 .apps-craft-feature-content:before,
.apps-craft-v12 .apps-craft-feature-content i {
    background-image: -webkit-linear-gradient( 25deg, rgb(239, 61, 136) 0%, rgb(246, 126, 97) 61%, rgb(253, 190, 57) 100%);
    background-image: -ms-linear-gradient( 25deg, rgb(239, 61, 136) 0%, rgb(246, 126, 97) 61%, rgb(253, 190, 57) 100%);
    color: #fff;
    background-color: transparent;
}

.apps-craft-v12 .apps-craft-testimonial-section {
    background-color: #31D2F4;
    background-image: -webkit-linear-gradient( 25deg, rgb(239, 61, 136) 0%, rgb(246, 126, 97) 61%, rgb(253, 190, 57) 100%);
    background-image: -ms-linear-gradient( 25deg, rgb(239, 61, 136) 0%, rgb(246, 126, 97) 61%, rgb(253, 190, 57) 100%);
}

.apps-craft-v12 .apps-craft-dash-border:before,
.apps-craft-v12 .apps-craft-team-img:before {
    border-left-color: #FABC38;
}

.apps-craft-v12 .apps-craft-video-content a i {
    background-image: -webkit-linear-gradient( 42deg, rgb(239, 61, 136) 0%, rgb(253, 190, 57) 100%);
    background-image: -ms-linear-gradient( 42deg, rgb(239, 61, 136) 0%, rgb(253, 190, 57) 100%);
    -webkit-text-fill-color: transparent;
}

.apps-craft-v12 .apps-craft-commentor-img figcaption {
    background-color: #EF3D88;
}

.apps-craft-v12 #apps-craft-testimonial-thumb figure:before {
    background-color: rgba(253, 190, 57, 0.58);
}

.apps-craft-v12 .apps-craft-commentor-bio h3 span {
    color: #333333;
}

.apps-craft-v12 .apps-craft-team-member-pic:before {
    background-image: -webkit-linear-gradient( 25deg, rgb(239, 61, 136) 0%, rgb(246, 126, 97) 61%, rgb(253, 190, 57) 100%);
    background-image: -ms-linear-gradient( 25deg, rgb(239, 61, 136) 0%, rgb(246, 126, 97) 61%, rgb(253, 190, 57) 100%);
}

.apps-craft-v12 .apps-craft-subscribe-wraper,
.apps-craft-v12 .apps-craft-accordion .panel-title,
.apps-craft-v12 .apps-craft-contact-form input[type="submit"],
.apps-craft-v12 .apps-craft-accordion .panel-title a:before,
.apps-craft-v12 .apps-craft-btn.app-store-btn {
    background-image: -webkit-linear-gradient( 35deg, rgb(239, 61, 136) 0%, rgb(253, 190, 57) 100%);
    background-image: -ms-linear-gradient( 35deg, rgb(239, 61, 136) 0%, rgb(253, 190, 57) 100%);
    background-color: transparent;
}

.apps-craft-v12 .apps-craft-subscribe-form input[type="submit"] {
    background-color: #FDBE39;
}

.apps-craft-v12 .fun-factorey-paralx-bg-1 {
    background-image: url(img/version-12/fun-factory-bg-1.png);
}

.apps-craft-v12 .apps-craft-pricing-1 {
    background-image: url(img/version-12/pricing-body-bg-1.png);
}

.apps-craft-v12 .apps-craft-pricing-2 {
    background-image: url(img/version-12/pricing-body-bg-2.png);
}

.apps-craft-v12 .apps-craft-pricing-3 {
    background-image: url(img/version-12/pricing-body-bg-3.png);
}

.apps-craft-v12 .apps-craft-footer-section {
    background-image: url(img/version-12/footer-bg.png);
}

.apps-craft-v12 .apps-craft-btn.solid-color {
    background-color: #232838;
}

.apps-craft-v12 .apps-craft-btn.solid-color:hover {
    background-color: #EEEEEE;
    color: #333333;
}

.apps-craft-v12 .apps-craft-subscribe-form input[type="email"] {
    /*box-shadow: 0 18px 32px rgba(0,0,0,.28);*/
}

.apps-craft-v12 .apps-craft-feature-content:hover p {
    color: #FFFFFF;
}

.apps-craft-v12 .apps-craft-accordion .panel-title a:before {
    background-color: #F4F4F4;
    background-image: none;
    color: #01C9FC;
}

.apps-craft-v12 .apps-craft-accordion .panel-title.click a:before {
    background-image: -webkit-linear-gradient( 25deg, rgb(239, 61, 136) 0%, rgb(246, 126, 97) 61%, rgb(253, 190, 57) 100%);
    background-image: -ms-linear-gradient( 25deg, rgb(239, 61, 136) 0%, rgb(246, 126, 97) 61%, rgb(253, 190, 57) 100%);
    color: #FFFFFF;
}

.apps-craft-v12 .apps-craft-accordion .panel-title.click {
    background-color: #FFFFFF;
    background-image: none;
}

.apps-craft-v12 .apps-craft-side-bar-menu:before,
.apps-craft-v12 .apps-craft-side-menu:before {
    background-image: -webkit-linear-gradient( 35deg, rgb(239, 61, 136) 0%, rgb(253, 190, 57) 100%);
    background-image: -ms-linear-gradient( 35deg, rgb(239, 61, 136) 0%, rgb(253, 190, 57) 100%);
    background-color: transparent;
}

.apps-craft-v12 .apps-craft-menu-item ul li a:hover {
    color: #FDBE39;
}

/*=================================================================== 
		Apps Craft Version 13
==================================================================================*/

.apps-craft-v13 .apps-craft-menu ul li a:hover,
.apps-craft-v13 .apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a:hover,
.apps-craft-v13 .apps-craft-welcome-content h1 span,
.apps-craft-v13 .apps-craft-single-about span,
.apps-craft-v13 .apps-carft-screen-short-content #options #previous,
.apps-craft-v13 .apps-carft-screen-short-content #options #next,
.apps-craft-v13 .apps-craft-pricing-body h2,
.apps-craft-v13 .apps-craft-contact-form-content h2 span,
.apps-craft-v13 .apps-craft-accordion .panel-title a.collapsed:before,
.apps-craft-v13 .apps-craft-feature-content i,
.apps-craft-v13 .apps-craft-single-fun i {
    color: #01C9FC;
}

.apps-craft-v13 .apps-craft-welcome-content h1 span {
    color: #ffffff;
}

.apps-craft-v13 .apps-craft-section-heading h2 {
    background-image: none;
    -webkit-text-fill-color: #333333;
}

.apps-craft-v13 .apps-craft-section-heading.white h2 {
    background-image: none;
    -webkit-text-fill-color: #FFF;
}

.apps-craft-v13 .apps-craft-feature-content:before,
.apps-craft-v13 .apps-craft-feature-content i {
    background-image: -webkit-linear-gradient( 42deg, rgb(123, 237, 147) 0%, rgb(62, 219, 200) 52%, rgb(1, 201, 252) 100%);
    background-image: -ms-linear-gradient( 42deg, rgb(123, 237, 147) 0%, rgb(62, 219, 200) 52%, rgb(1, 201, 252) 100%);
    color: #fff;
    background-color: transparent;
}

.apps-craft-v13 .apps-craft-feature-content:before {
    background-image: -webkit-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-image: -ms-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
}

.apps-craft-v13 .apps-craft-testimonial-section {
    background-color: #31D2F4;
    background-image: -webkit-linear-gradient( -136deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-image: -ms-linear-gradient( -136deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
}

.apps-craft-v13 .apps-craft-dash-border:before,
.apps-craft-v13 .apps-craft-team-img:before {
    border-left-color: #05C9F8;
}

.apps-craft-v13 .apps-craft-video-content a i {
    background-image: -webkit-linear-gradient(left, #00c9fd 0%, #81ee8e 100%);
    background-image: linear-gradient(to right, #00c9fd 0%, #81ee8e 100%);
    -webkit-text-fill-color: transparent;
}

.apps-craft-v13 .apps-craft-commentor-img figcaption {
    background-color: #7BED93;
}

.apps-craft-v13 #apps-craft-testimonial-thumb figure:before {
    background-color: rgba(123, 237, 147, 0.57);
}

.apps-craft-v13 .apps-craft-commentor-bio h3 span {
    color: #333333;
}

.apps-craft-v13 .apps-craft-team-member-pic:before {
    background-image: -webkit-linear-gradient(left, #00c9fd 0%, #81ee8e 100%);
    background-image: linear-gradient(to right, #00c9fd 0%, #81ee8e 100%);
}

.apps-craft-v13 .apps-craft-subscribe-wraper,
.apps-craft-v13 .apps-craft-accordion .panel-title,
.apps-craft-v13 .apps-craft-contact-form input[type="submit"],
.apps-craft-v13 .apps-craft-accordion .panel-title a:before,
.apps-craft-v13 .apps-craft-btn.app-store-btn {
    background-image: -webkit-linear-gradient(left, #00c9fd 0%, #81ee8e 100%);
    background-image: linear-gradient(to right, #00c9fd 0%, #81ee8e 100%);
    background-color: transparent;
}

.apps-craft-v13 .apps-craft-subscribe-form input[type="submit"] {
    background-color: #00C9FD;
}

.apps-craft-v13 .fun-factorey-paralx-bg-1 {
    background-image: url(img/version-13/fun-factory-bg-1.png);
}

.apps-craft-v13 .apps-craft-pricing-1 {
    background-image: url(img/version-13/pricing-body-bg-1.png);
}

.apps-craft-v13 .apps-craft-pricing-2 {
    background-image: url(img/version-13/pricing-body-bg-2.png);
}

.apps-craft-v13 .apps-craft-pricing-3 {
    background-image: url(img/version-13/pricing-body-bg-3.png);
}

.apps-craft-v13 .apps-craft-footer-section {
    background-image: url(img/version-13/footer-bg.png);
}

.apps-craft-v13 .apps-craft-btn.solid-color {
    background-color: #232838;
}

.apps-craft-v13 .apps-craft-btn.solid-color:hover {
    background-color: #EEEEEE;
    color: #333333;
}

.apps-craft-v13 .apps-craft-subscribe-form input[type="email"] {
    /*box-shadow: 0 18px 32px rgba(0,0,0,.28);*/
}

.apps-craft-v13 .apps-craft-feature-content:hover p {
    color: #FFFFFF;
}

.apps-craft-v13 .apps-craft-accordion .panel-title a:before {
    background-color: #F4F4F4;
    background-image: none;
    color: #01C9FC;
}

.apps-craft-v13 .apps-craft-accordion .panel-title.click a:before {
    background-image: -webkit-linear-gradient(left, #00c9fd 0%, #81ee8e 100%);
    background-image: linear-gradient(to right, #00c9fd 0%, #81ee8e 100%);
    color: #FFFFFF;
}

.apps-craft-v13 .apps-craft-accordion .panel-title.click {
    background-color: #FFFFFF;
    background-image: none;
}

.apps-craft-v13 .apps-craft-side-bar-menu:before,
.apps-craft-v13 .apps-craft-side-menu:before {
    background-image: -webkit-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-image: -ms-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-color: transparent;
}

.apps-craft-v13 .apps-craft-menu-item ul li a:hover {
    color: #00C9FD;
}

.apps-craft-v13 .apps-craft-welcome-section {
    background-image: -webkit-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
    background-image: -ms-linear-gradient( 25deg, rgb(1, 201, 252) 0%, rgb(123, 237, 147) 100%);
}

/*=================================================================== 
		Apps Craft Version 18
==================================================================================*/

.apps-craft-18-banner-bg-wrap {
    position: absolute;
    top: 80%;
    left: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    height: 450px;
    -webkit-transform: skewY(-25deg);
    transform: skewY(-25deg);
    -webkit-transform-origin: 0;
    transform-origin: 0;
    z-index: 1;
}

.apps-craft-18-banner-bg-wrap span {
    height: 150px;
    position: relative;
    opacity: 0;
    width: 100%;
    border-radius: 8px;
    margin-bottom: -3px;
}

body.apps-craft-v18.apps-craft--loaded .apps-craft-18-banner-bg-wrap span {
    -webkit-animation: stripeSlideIn .8s forwards;
    animation: stripeSlideIn .8s forwards;
}

.apps-craft-18-banner-bg-wrap span:nth-child(1) {
    left: 65%;
    right: auto;
    background: #EA4B50;
    box-shadow: rgba(0, 0, 0, 0.8) 10px 10px 60px -20px;
    z-index: 2;
}

body.apps-craft-v18.apps-craft--loaded .apps-craft-18-banner-bg-wrap span:nth-child(1) {
    -webkit-animation-delay: .4s;
    animation-delay: .4s;
}

.apps-craft-18-banner-bg-wrap span:nth-child(2) {
    left: 66%;
    bottom: auto;
    background: #F53565;
    box-shadow: rgba(0, 0, 0, 0.8) 10px 10px 60px -20px;
    z-index: 1;
}

body.apps-craft-v18.apps-craft--loaded .apps-craft-18-banner-bg-wrap span:nth-child(2) {
    -webkit-animation-delay: .6s;
    animation-delay: .6s;
}

.apps-craft-18-banner-bg-wrap span:nth-child(3) {
    left: 60%;
    background: #FF7B99;
    box-shadow: rgba(0, 0, 0, 0.8) 10px 10px 60px -20px;
}

body.apps-craft-v18.apps-craft--loaded .apps-craft-18-banner-bg-wrap span:nth-child(3) {
    -webkit-animation-delay: .8s;
    animation-delay: .8s;
}

@keyframes stripeSlideIn {
    0% {
        opacity: 0;
        -webkit-transform: translateX(150px) skew(0);
        transform: translateX(150px) skew(0)
    }
    to {
        opacity: 1;
        -webkit-transform: translateX(0) skew(-12deg);
        transform: translateX(0) skew(-12deg)
    }
}

@-webkit-keyframes stripeSlideIn {
    0% {
        opacity: 0;
        -webkit-transform: translateX(150px) skew(0);
    }
    to {
        opacity: 1;
        -webkit-transform: translateX(0) skew(-12deg);
    }
}

/*=================================================================== 
		Apps Craft Version 19
=====================================================================*/

.apps-craft-appscreen-slide {
    position: relative;
    z-index: 1;
    max-width: 250px;
    float: right;
}

.apps-craft-welcome-section-v19 .apps-craft-welcome-section-screen-short {
    z-index: 1;
}

.apps-craft-welcome-section-v19 .apps-craft-welcome-content h1 span {
    color: #13366B;
}

.apps-craft-welcome-section-v19 .apps-craft-btn.app-store-btn {
    background-image: none;
    background-color: #232838;
}

.apps-craft-welcome-section-v19.apps-craft-welcome-section {
    background-color: #F4F4F4;
    height: 950px;
}

.apps-craft-welcome-section-v19 {
    overflow: hidden;
    background-color: #F4F4F4;
}

.apps-craft-welcome-section-v19:before,
.apps-craft-welcome-section-v19:after {
    content: "";
    position: absolute;
    left: 50%;
    min-width: 300vw;
    min-height: 300vw;
    background-image: -webkit-linear-gradient( 25deg, #2690FB 0%, #127AFB 100%);
    background-image: -moz-linear-gradient( 25deg, #2690FB 0%, #127AFB 100%);
    background-image: -o-linear-gradient( 25deg, #2690FB 0%, #127AFB 100%);
    background-image: -ms-linear-gradient( 25deg, #2690FB 0%, #127AFB 100%);
    -webkit-animation-name: rotate;
    animation-name: rotate;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    animation-timing-function: linear;
}

.apps-craft-welcome-section-v19:before {
    bottom: 15vh;
    border-radius: 45%;
    -webkit-animation-duration: 10s;
    animation-duration: 10s;
}

.apps-craft-welcome-section-v19:after {
    bottom: 12vh;
    opacity: .5;
    border-radius: 47%;
    -webkit-animation-duration: 10s;
    animation-duration: 10s;
}

.apps-craft-welcome-section-v19 .apps-craft-welcome-screenshort.parallax {
    z-index: 1;
}

@-webkit-keyframes rotate {
    0% {
        -webkit-transform: translate(-50%, 0) rotateZ(0deg);
        transform: translate(-50%, 0) rotateZ(0deg);
    }
    50% {
        -webkit-transform: translate(-50%, -2%) rotateZ(180deg);
        transform: translate(-50%, -2%) rotateZ(180deg);
    }
    100% {
        -webkit-transform: translate(-50%, 0%) rotateZ(360deg);
        transform: translate(-50%, 0%) rotateZ(360deg);
    }
}

@keyframes rotate {
    0% {
        -webkit-transform: translate(-50%, 0) rotateZ(0deg);
        transform: translate(-50%, 0) rotateZ(0deg);
    }
    50% {
        -webkit-transform: translate(-50%, -2%) rotateZ(180deg);
        transform: translate(-50%, -2%) rotateZ(180deg);
    }
    100% {
        -webkit-transform: translate(-50%, 0%) rotateZ(360deg);
        transform: translate(-50%, 0%) rotateZ(360deg);
    }
}

#apps-craft-appscreen-slide .owl-controls .owl-page span {
    margin: 5px 7px;
    background: transparent none repeat scroll 0 0;
    border: 1px solid #fff;
    border-radius: 10px;
    display: inline-block;
    height: 10px;
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    width: 26px;
    -webkit-transition: 0.2s;
    transition: 0.2s;
}

#apps-craft-appscreen-slide .owl-controls .owl-page.active span {
    background: #fff;
    border: medium none;
    height: 12px;
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    width: 12px;
}

/* ==============================================================================
				Apps Craft Start
========================================================================== */

/*====================================================================== 
		2. Apps Ccraft Main Menu 
====================================================================================*/

#apps-craft-menu {
    display: block;
}

.apps-craft-menu {
    text-align: right;
    width: 97%;
    float: left;
}

.apps-craft-menu ul li {
    display: inline-block;
}

.apps-craft-menu ul li a {
    text-transform: uppercase;
    color: #FFFFFF;
    font-size: 1.0em;
    display: block;
    padding: 8px 0;
    margin: 0 17px;
    font-weight: 400;
    -webkit-transition: all .4s linear;
    transition: all .4s linear;
}

.apps-craft-menu ul li a.apps-craft-btn {
    width: 100px;
    height: 40px;
    line-height: 28px;
    font-weight: 600;
    border: 1px solid #f2504d;
}

.apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a.apps-craft-btn,
.apps-craft-main-menu-area.sticky-menu .apps-craft-search-bar a.apps-craft-btn i {
    color: #ffffff;
}

.apps-craft-menu ul li a.apps-craft-btn:hover {
    background-color: transparent;
}

.apps-craft-menu-v5 .apps-craft-menu ul li a:hover {
    color: #232838;
}

.apps-craft-search-bar {
    width: 3%;
    float: left;
    text-align: right;
    padding: 3px 0;
    -webkit-transition: all .4s linear;
    transition: all .4s linear;
}

.apps-craft-search-bar a i {
    color: #FFFFFF;
    font-size: 1.143em;
}

.apps-craft-search-bar a {
    vertical-align: text-bottom;
}

.apps-craft-main-menu-area {
    -webkit-transition: all .4s linear;
    transition: all .4s linear;
}

.apps-craft-main-menu-area.sticky-menu {
    position: fixed;
    background-color: #fbfbfb;
    box-shadow: 0 11px 27px rgba(0, 0, 0, .04);
    -webkit-transition: all .4s linear;
    transition: all .4s linear;
    padding: 18px 0;
    z-index: 9999999;
}

#apps-craft-main-menu-icon {
    display: none;
}

.apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a,
.apps-craft-main-menu-area.sticky-menu .apps-craft-search-bar a i {
    color: #777777;
}

.apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a:hover,
.apps-craft-main-menu-area.sticky-menu .apps-craft-search-bar a:hover i {
    color: #F2504D;
}

.apps-craft-main-menu-area.sticky-menu .apps-craft-logo a img {
    visibility: hidden;
    -webkit-transition: all .4s linear;
    transition: all .4s linear;
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    height : 60px !important;
}

.apps-craft-main-menu-area.sticky-menu .apps-craft-logo a {
    background-image: url(<?php echo $data_settings['link_logo_dark']; ?>) !important;
    background-size: contain;
    padding: 3px 0px;
    width: 100%;
    background-repeat: no-repeat;
    background-position: center center;
    font-size: 60px !important;
    height : 60px !important;
}

/*Apps Craft Login Popup*/

#apps-craft-login {
    width: 440px;
    max-width: 100%;
    text-align: center;
    padding: 35px 42px;
    background-color: #ffffff;
    border-radius: 8px;
    margin: auto;
    position: relative;
}

#apps-craft-login span {
    font-size: 12px;
    color: #333;
}

#apps-craft-login span a {
    color: #9b9b9b;
}

.button--facebook {
    padding: 0 25px;
    line-height: 54px;
    min-width: 315px;
    max-width: 100%;
    color: #ffffff;
    background: linear-gradient(260deg, #337eb9, #384499);
    box-shadow: 0 2px 4px 0 rgba(115, 101, 97, .27);
    border: 0px solid;
    border-radius: 50px;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: 500;
    letter-spacing: 0.02em;
}

.phone--login {
    border: solid 1px #c1c1c1;
    padding: 0 25px;
    line-height: 54px;
    width: 315px;
    max-width: 100%;
    border-radius: 50px;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: 500;
    letter-spacing: 0.02em;
}

.fb-login,
.phone-number-login {
    margin-top: 30px;
}

#apps-craft-login h3 {
    margin-bottom: 30px;
    font-size: 24px;
    font-weight: 300;
    color: #333;
}

.phone-number-login {
    margin-bottom: 30px;
}

#apps-craft-login .apps-craft-download-store-btn-group {
    margin-top: 20px;
}

#apps-craft-login .apps-craft-btn.play-store-btn,
#apps-craft-login .apps-craft-btn.app-store-btn {
    margin: 0;
    box-shadow: 0 0 35px rgba(0, 0, 0, .08);
    width: auto;
    height: auto;
    line-height: 1;
}

#apps-craft-login .apps-craft-btn.play-store-btn {
    margin-right: 10px;
}

#apps-craft-login .apps-craft-btn.play-store-btn img,
#apps-craft-login .apps-craft-btn.app-store-btn img {
    max-width: 140px;
    height: auto;
    padding: 15px 20px;
}

/* For Blue version */

.apps-craft-solid-color .apps-craft-main-menu-area.sticky-menu .apps-craft-menu ul li a:hover,
.apps-craft-solid-color .apps-craft-main-menu-area.sticky-menu .apps-craft-search-bar a:hover i {
    color: #1390FB;
}

.apps-craft-solid-color .apps-craft-main-menu-area.sticky-menu .apps-craft-logo a {
    background-image: url(<?php echo $data_settings['link_logo_dark']; ?>) !important;
    font-size: 60px !important;
    height : 60px !important;
}

.la-ball-elastic-dots,
.la-ball-elastic-dots>div {
    position: relative;
    box-sizing: border-box;
}

.la-ball-elastic-dots {
    display: block;
    font-size: 0;
    color: #fff;
}

.la-ball-elastic-dots.la-dark {
    color: #333;
}

.la-ball-elastic-dots>div {
    display: inline-block;
    float: none;
    background-color: currentColor;
    border: 0 solid currentColor;
}

.la-ball-elastic-dots {
    width: 100px;
    height: 10px;
    font-size: 0;
    text-align: center;
    float: right;
    padding: 10px 0px;
    cursor: pointer;
}

body.apps-craft-solid-color .la-ball-elastic-dots {
    color: #1390FB !important;
}

.la-ball-elastic-dots>div {
    display: inline-block;
    width: 10px;
    height: 10px;
    white-space: nowrap;
    border-radius: 100%;
    -webkit-animation: ball-elastic-dots-anim 2.5s infinite;
    animation: ball-elastic-dots-anim 2.5s infinite;
}

.la-ball-elastic-dots.la-sm {
    width: 60px;
    height: 4px;
}

.la-ball-elastic-dots.la-sm>div {
    width: 4px;
    height: 4px;
}

.la-ball-elastic-dots.la-2x {
    width: 50px;
    height: 10px;
}

.la-ball-elastic-dots.la-2x>div {
    width: 8px;
    height: 8px;
}

.la-ball-elastic-dots.la-3x {
    width: 360px;
    height: 30px;
}

.la-ball-elastic-dots.la-3x>div {
    width: 30px;
    height: 30px;
}

/*
 * Animation
 */

@-webkit-keyframes ball-elastic-dots-anim {
    0%,
    100% {
        margin: 0;
        -webkit-transform: scale(1);
        transform: scale(1);
    }
    50% {
        margin: 0 5%;
        -webkit-transform: scale(.65);
        transform: scale(.65);
    }
}

@keyframes ball-elastic-dots-anim {
    0%,
    100% {
        margin: 0;
        -webkit-transform: scale(1);
        transform: scale(1);
    }
    50% {
        margin: 0 5%;
        -webkit-transform: scale(.65);
        transform: scale(.65);
    }
}

/* menu version 2*/

.apps-craft-side-bar-menu {
    position: absolute;
    height: 100%;
    width: 100%;
    z-index: 99999999;
    top: 0;
    left: 0;
}

.apps-craft-side-menu {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 300px;
}

.apps-craft-side-menu:before {
    position: absolute;
    content: "";
    top: 0;
    left: -10%;
    height: 100%;
    width: 0%;
    background-color: #f2504d;
    background-image: -webkit-linear-gradient( 63deg, rgb(250, 50, 111) 0%, rgb(246, 66, 94) 53%, rgb(242, 81, 76) 100%, rgb(242, 80, 77) 100%);
    background-image: -ms-linear-gradient( 63deg, rgb(250, 50, 111) 0%, rgb(246, 66, 94) 53%, rgb(242, 81, 76) 100%, rgb(242, 80, 77) 100%);
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    z-index: -1;
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
}

.apps-craft-side-bar-menu:before {
    position: fixed;
    content: "";
    top: 0;
    left: -10%;
    height: 100%;
    width: 0%;
    background-color: #f2504d;
    background-image: -webkit-linear-gradient( 63deg, rgb(250, 50, 111) 0%, rgb(246, 66, 94) 53%, rgb(242, 81, 76) 100%, rgb(242, 80, 77) 100%);
    background-image: -ms-linear-gradient( 63deg, rgb(250, 50, 111) 0%, rgb(246, 66, 94) 53%, rgb(242, 81, 76) 100%, rgb(242, 80, 77) 100%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    -webkit-transition: all .2s ease;
    transition: all .2s ease;
}

.apps-craft-side-bar-menu .apps-craft-logo {
    padding: 80px 0;
    text-align: center;
    position: relative;
    left: -100%;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
}

.apps-craft-menu-item ul li a {
    padding: 20px 40px;
    display: block;
    color: #fff;
    text-transform: uppercase;
    border-top: 1px solid #fff;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
    position: relative;
    left: -100%;
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
}

.apps-craft-menu-item ul li:last-child a {
    border-bottom: 1px solid #fff;
}

.apps-craft-menu-item ul li a:hover {
    background-color: #FFFFFF;
    color: #f2504d;
}

.apps-craft-humberger-menu {
    position: absolute;
    height: 50px;
    width: 55px;
    background-color: #FBFBFB;
    box-shadow: 0px 0px 35px 0px rgba(0, 0, 0, 0.08);
    left: 0%;
    top: 70px;
    z-index: 9999;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    cursor: pointer;
    overflow: hidden;
}

.apps-craft-humberger-menu span {
    display: block;
    height: 2px;
    width: calc(100% - 30px);
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
    background-color: #333;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    transition: all .4s ease;
}

.apps-craft-humberger-menu:hover span:first-child {
    -webkit-transform: translate(-50%, -8px);
    transform: translate(-50%, -8px);
}

.apps-craft-humberger-menu:hover span:last-child {
    -webkit-transform: translate(-50%, 8px);
    transform: translate(-50%, 8px);
}

.apps-craft-humberger-menu span:first-child {
    -webkit-transform: translate(-50%, -10px);
    transform: translate(-50%, -10px);
}

.apps-craft-humberger-menu span:last-child {
    -webkit-transform: translate(-50%, 10px);
    transform: translate(-50%, 10px);
}

.apps-craft-side-bar-menu.active .apps-craft-humberger-menu span:first-child,
.apps-craft-side-bar-menu.active .apps-craft-humberger-menu span:last-child {
    -webkit-transform-origin: right;
    transform-origin: right;
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
}

.apps-craft-side-bar-menu.active .apps-craft-humberger-menu span:first-child {
    -webkit-transform: translate(-70%, -10px) rotate(-45deg);
    transform: translate(-70%, -10px) rotate(-45deg);
}

.apps-craft-side-bar-menu.active .apps-craft-humberger-menu span {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    -webkit-transform: translateX(-50px);
    transform: translateX(-50px);
}

.apps-craft-side-bar-menu.active .apps-craft-humberger-menu span:last-child {
    -webkit-transform: translate(-70%, 8px) rotate(45deg);
    transform: translate(-70%, 8px) rotate(45deg);
}

.apps-craft-side-bar-menu.active:before {
    opacity: .4;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
    width: 100%;
    left: 0;
}

.apps-craft-side-bar-menu.active .apps-craft-side-menu:before {
    width: 100%;
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    left: 0;
}

.apps-craft-side-bar-menu.active .apps-craft-logo {
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    left: 0;
}

.apps-craft-side-bar-menu.active .apps-craft-menu-item ul li a {
    left: 0;
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
}

.apps-craft-side-bar-menu.active .apps-craft-menu-item ul li:nth-child(1) a {
    -webkit-transition: all .5s ease;
    transition: all .5s ease;
}

.apps-craft-side-bar-menu.active .apps-craft-menu-item ul li:nth-child(2) a {
    -webkit-transition: all .6s ease;
    transition: all .6s ease;
}

.apps-craft-side-bar-menu.active .apps-craft-menu-item ul li:nth-child(3) a {
    -webkit-transition: all .7s ease;
    transition: all .7s ease;
}

.apps-craft-side-bar-menu.active .apps-craft-menu-item ul li:nth-child(4) a {
    -webkit-transition: all .8s ease;
    transition: all .8s ease;
}

.apps-craft-side-bar-menu.active .apps-craft-menu-item ul li:nth-child(5) a {
    -webkit-transition: all .9s ease;
    transition: all .9s ease;
}

.apps-craft-side-bar-menu.active .apps-craft-menu-item ul li:nth-child(6) a {
    -webkit-transition: all 1s ease;
    transition: all 1s ease;
}

.apps-craft-side-bar-menu.active .apps-craft-menu-item ul li:nth-child(7) a {
    -webkit-transition: all 1.1s ease;
    transition: all 1.1s ease;
}

.apps-craft-side-bar-menu.active .apps-craft-humberger-menu {
    left: calc(100% - 55px);
}

/*=============================================================== 
		3. Apps Craft Welcome Section 
======================================================================================*/

.apps-craft-welcome-section {
    position: relative;
    overflow: hidden;
    height: 1060px;
    background-position: center center;
    background-repeat: no-repeat;
    min-height: 700px;
    background-color: #222838;
}

.apps-craft-welcome-section-v3.apps-craft-welcome-section {
    overflow: visible;
    height: 994px;
}

.apps-craft-welcome-section-v4.apps-craft-welcome-section {
    height: 100vh;
}

.apps-craft-welcome-section-v4.apps-craft-welcome-section .apps-craft-welcome-tbl {
    height: 100vh;
}

.apps-craft-welcome-section-v3.apps-craft-welcome-section:before,
.apps-craft-welcome-section-v3.apps-craft-welcome-section:after,
.apps-craft-welcome-section-v4.apps-craft-welcome-section:before,
.apps-craft-welcome-section-v4.apps-craft-welcome-section:after {
    position: absolute;
    content: "";
    bottom: 0;
    left: 0;
    height: 818px;
    width: 100%;
    background-image: url(img/version-3-welcome-shape-2.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
    background-position: bottom center;
}

.apps-craft-welcome-section-v3.apps-craft-welcome-section:after,
.apps-craft-welcome-section-v4.apps-craft-welcome-section:after {
    background-image: url(img/version-3-welcome-shape-1.png);
    height: 741px;
}

.apps-craft-welcome-section-v4.apps-craft-welcome-section:before,
.apps-craft-welcome-section-v4.apps-craft-welcome-section:after {
    background-size: cover;
}

.apps-craft-welcome-section .apps-craft-welcome-tbl {
    height: 750px;
}

.apps-craft-welcome-section-v19.apps-craft-welcome-section .apps-craft-welcome-tbl {
    height: 850px;
}

.apps-craft-welcome-section.apps-craft-video-bg .apps-craft-welcome-tbl {
    height: 100vh;
}

.apps-craft-welcome-screenshort .apps-craft-welcome-tbl {
    height: 850px;
}

.apps-craft-main-menu-area {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 10;
    padding: 40px 0 0;
}

body.apps-craft-video-banner .apps-craft-main-menu-area {
    z-index: 101;
}

body.apps-craft-video-banner .apps-craft-welcome-container {
    position: relative;
    z-index: 100;
}

.apps-craft-main-menu-area.apps-craft-video-section-menu {
    z-index: 9999;
}

.apps-craft-welcome-container {
    background-repeat: no-repeat;
    background-size: cover;
    background-position: bottom center;
}

.apps-craft-welcome-content {
    position: relative;
    z-index: 1;
}

.apps-craft-welcome-content h1 {
    color: #FFFFFF;
    font-size: 3.429em;
    margin: 0;
    text-transform: capitalize;
    line-height: 1.5;
    font-weight: 300;
    margin-bottom: 70px;
}

.apps-craft-welcome-content h1 span {
    font-weight: 400;
    font-size: inherit;
    letter-spacing: 1px;
    line-height: 1;
}

.apps-craft-welcome-screenshort img {
    position: relative;
    height: 500px;
}

.apps-craft-welcome-section-screen-short {
    position: relative;
    z-index: 0;
}

.apps-craft-welcome-section-v4 .apps-craft-welcome-section-screen-short {
    z-index: 1;
}

body.apps-craft-v7 .apps-craft-welcome-section-screen-short {
    z-index: 1;
}

.apps-craft-position-rel {
    position: absolute;
    width: calc(100% + 200px);
    bottom: -100px;
    left: -100px;
    z-index: 1;
}

body.apps-craft-v7 .apps-craft-position-rel {
    top: -70px;
}

.apps-craft-position-rel .layer {
    display: block;
    height: 100%;
    width: 100%;
    padding: 0;
    margin: 0;
}

.apps-craft-position-rel .layer img {
    display: block;
    width: 100%;
}

.apps-craft-welcome-section-v5 .apps-craft-position-rel {
    width: 260px;
    max-height: none;
    bottom: 150px;
    right: 20%;
    left: inherit;
}

.apps-craft-welcome-section-v5 .apps-craft-position-rel .layer {
    height: auto;
    width: auto;
}

.apps-craft-welcome-section-v5 .apps-craft-position-rel .layer img {
    width: auto;
}

/* Video Version, Slider Version, ScreenShort Version And Another Parallax Version */

.apps-craft-welcome-section.apps-craft-video-bg {
    height: 100vh;
    background-attachment: fixed;
    position: relative;
    min-height: inherit;
}

.apps-craft-welcome-section.apps-craft-video-bg:before {
    position: absolute;
    content: "";
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: rgba(35, 40, 56, 0.8);
    z-index: 99;
}

.apps-craft-video-bg .apps-craft-welcome-content h1,
.apps-craft-welcome-section-v3 .apps-craft-welcome-content h1,
.apps-craft-welcome-section-v4 .apps-craft-welcome-content h1 {
    margin: 0 auto 30px auto;
}

.apps-craft-video-bg .apps-craft-welcome-content h1 span,
.apps-craft-welcome-section-v3 .apps-craft-welcome-content h1 span,
.apps-craft-welcome-section-v4 .apps-craft-welcome-content h1 span {
    text-transform: inherit;
    font-style: inherit;
}

.apps-craft-video-bg .apps-craft-welcome-content p,
.apps-craft-welcome-section-v3 .apps-craft-welcome-content p {
    width: 66.66666666667%;
    margin: 0 auto 40px auto;
    color: #E3E3E3;
    font-size: 1.143em;
    font-weight: 300;
}

.apps-craft-welcome-screenshort-v3 {
    position: absolute;
    bottom: -75px;
    left: 50%;
    width: 90%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    max-height: 500px;
    text-align: center;
    z-index: 1;
}

#apps-craft-welcome-slider {
    position: relative;
    z-index: 9;
}

.apps-craft-welcome-screenshort-v3 figure {
    float: left;
    width: 33%;
    max-height: 500px;
}

.apps-craft-welcome-screenshort-v3 figure img {
    width: auto;
    height: auto;
    max-height: 500px;
}

.apps-craft-welcome-section-v4 .owl-carousel .owl-item.active .apps-craft-welcome-content h1 {
    -webkit-animation: fadeInRightPix 1s cubic-bezier(0.7, 0, 0.3, 1) 200ms both;
    animation: fadeInRightPix 1s cubic-bezier(0.7, 0, 0.3, 1) 200ms both;
}

.apps-craft-welcome-section-v4 .owl-carousel .owl-item.active .apps-craft-download-store-btn-group {
    -webkit-animation: fadeInRightPix 1s cubic-bezier(0.7, 0, 0.3, 1) 600ms both;
    animation: fadeInRightPix 1s cubic-bezier(0.7, 0, 0.3, 1) 600ms both;
}

.apps-craft-welcome-section-v4 .owl-carousel .owl-item.active .apps-craft-welcome-section-screen-short {
    -webkit-animation: fadeInLeftPix 1s cubic-bezier(0.7, 0, 0.3, 1) 400ms both;
    animation: fadeInLeftPix 1s cubic-bezier(0.7, 0, 0.3, 1) 400ms both;
}

.fadeInUpPix {
    -webkit-animation-name: fadeInUpPix;
    animation-name: fadeInUpPix;
}

@-webkit-keyframes fadeInUpPix {
    from {
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        -webkit-transform: translate3d(0, 20px, 0);
        transform: translate3d(0, 20px, 0);
    }
    to {
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        -webkit-transform: none;
        transform: none;
    }
}

@keyframes fadeInUpPix {
    from {
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        -webkit-transform: translate3d(0, 20px, 0);
        transform: translate3d(0, 20px, 0);
    }
    to {
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        -webkit-transform: none;
        transform: none;
    }
}

@-webkit-keyframes fadeInLeftPix {
    from {
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        -webkit-transform: translate3d(-20px, 0, 0);
        transform: translate3d(-20px, 0, 0);
    }
    to {
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        -webkit-transform: none;
        transform: none;
    }
}

@keyframes fadeInLeftPix {
    from {
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        -webkit-transform: translate3d(-20px, 0, 0);
        transform: translate3d(-20px, 0, 0);
    }
    to {
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        -webkit-transform: none;
        transform: none;
    }
}

.fadeInLeftPix {
    -webkit-animation-name: fadeInLeftPix;
    animation-name: fadeInLeftPix;
}

@-webkit-keyframes fadeInRightPix {
    from {
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        -webkit-transform: translate3d(20px, 0, 0);
        transform: translate3d(20px, 0, 0);
    }
    to {
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        -webkit-transform: none;
        transform: none;
    }
}

@keyframes fadeInRightPix {
    from {
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        -webkit-transform: translate3d(20px, 0, 0);
        transform: translate3d(20px, 0, 0);
    }
    to {
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        -webkit-transform: none;
        transform: none;
    }
}

.fadeInRightPix {
    -webkit-animation-name: fadeInRightPix;
    animation-name: fadeInRightPix;
}

#apps-craft-welcome-slider .owl-controls {
    position: absolute;
    bottom: 10px;
    width: 100%;
    text-align: center;
}

#apps-craft-welcome-slider.owl-theme .owl-controls .owl-page span {
    background: #fff;
}

/* Welcome Section For Version 5 */

.apps-craft-welcome-section.apps-craft-welcome-section-v5:after {
    position: absolute;
    content: "";
    bottom: 0;
    left: 0;
    width: 100%;
    height: 500px;
    background-image: url(img/version-4-welcome-white.png);
    background-size: 100%;
    background-position: top center;
    background-repeat: no-repeat;
}

.apps-craft-welcome-section-v5 .apps-craft-welcome-section-screen-short {
    z-index: 1;
}

.apps-craft-welcome-section-v5 .apps-craft-welcome-content h1 span {
    color: #003333;
}

.apps-craft-welcome-section-v5 .apps-craft-btn.app-store-btn {
    background-image: none;
    background-color: #232838;
}

.apps-craft-welcome-section-v5.apps-craft-welcome-section {
    background-color: #F4F4F4;
    height: 850px;
}

.apps-craft-welcome-section-v5 .apps-craft-position-rel-v2 .background {
    background-color: #232838;
    height: 100%;
    width: calc(100vw + 400px);
    position: absolute;
    left: -200px;
    top: 0px
}

.apps-craft-welcome-section-v5 .apps-craft-position-rel-v2 .background img {
    width: 100%;
}

body.apps-craft-v6 .apps-craft-welcome-section {
    height: 100vh;
    max-height: 800px;
}

body.apps-craft-v6 .apps-craft-welcome-section .apps-craft-welcome-tbl {
    height: 100vh;
    max-height: 800px;
}

body.apps-craft-v7 .apps-craft-welcome-section {
    height: 100vh;
}

body.apps-craft-v7 .apps-craft-welcome-section .apps-craft-welcome-tbl,
body.apps-craft-v7 .apps-craft-welcome-screenshort .apps-craft-welcome-tbl {
    height: 100vh;
}

body.apps-craft-v7 .apps-craft-welcome-section .apps-craft-welcome-tbl .apps-craft-welcome-tbl-c {
    vertical-align: middle;
}

body.apps-craft-v7 .apps-craft-welcome-screenshort .apps-craft-welcome-tbl .apps-craft-welcome-tbl-c {
    vertical-align: bottom;
}

body.apps-craft-v7 .apps-craft-welcome-screenshort img {
    position: relative;
    height: auto;
    max-height: 660px;
}

body.apps-craft-v7 .apps-craft-position-rel .layer img {
    display: block;
    width: 100%;
    opacity: .8;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
}

/* particles */

.particles-js-canvas-el {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 0;
    pointer-events: none;
}

/* version 13 */

.apps-craft-v13 .apps-craft-welcome-section:before {
    position: absolute;
    content: "";
    height: 240px;
    bottom: -120px;
    width: 100%;
    left: 0;
    background-color: #F4F4F4;
    transform: skewY(177deg) matrix3d(2.482602, -0.004259, 0, -0.000033, -1.922069, 2.251723, 0, -0.001121, 0, 0, 1, 0, 281, 130, 0, 1);
}

/*Version 18*/

.apps-craft-welcome-section.apps-craft-welcome-section-v18:after {
    content: none;
}

.apps-craft-welcome-section-v18 .apps-craft-position-rel-v2 .background {
    width: calc(100vw + 200px);
    left: -100px;
}

.apps-craft-welcome-section-v18 .apps-craft-position-rel-v2 .background img {
    max-height: 850px;
}

.apps-craft-welcome-section-v18 .apps-craft-welcome-content h1 {
    color: #333;
    font-size: 3.429em;
    text-transform: capitalize;
    line-height: 1.3;
    font-weight: 600;
}

.apps-craft-welcome-section-v18 .apps-craft-welcome-content h1 span {
    font-weight: 700;
    color: #fff;
    text-shadow: 4px 4px 5px rgba(0, 0, 0, .3);
}

.apps-craft-welcome-section-v18 .apps-craft-download-store-btn-group a.apps-craft-btn {
    box-shadow: 2px 3px 15px rgba(0, 0, 0, .3);
}

/*Apps Screen Codes*/

.apps-craft-welcome-section-v18 .apps-craft-position-rel .layer {
    width: 280px;
    height: 573px;
    background-image: url(img/feature-app-screenshort.png);
    background-size: 100% 100%;
}

.apps-craft-welcome-section-v18 .apps-craft-position-rel {
    bottom: 15%;
}

.appscraft-screen-container {
    width: 250px;
    height: 450px;
    background: #000;
    position: absolute;
    margin: auto;
    bottom: 60px;
    left: 16px;
    padding: 1em;
    overflow: hidden;
    background: url("img/screenshort-slider-img-5.png");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    z-index: 1;
    padding-top: 60px;
}

.appscraft-screen-container.startup {
    animation: startup 1s cubic-bezier(0.19, 1, 0.22, 1);
    -webkit-animation: startup 1s cubic-bezier(0.19, 1, 0.22, 1);
}

.appscraft-screen-container.shake {
    animation: shake 1s cubic-bezier(0.19, 1, 0.22, 1);
    -webkit-animation: shake 1s cubic-bezier(0.19, 1, 0.22, 1);
}

.appscraft-screen-container i.back {
    position: absolute;
    margin: auto;
    top: 15px;
    right: 15px;
    font-size: 22px;
    line-height: 20px;
    color: #fff;
    z-index: 10;
    opacity: 0;
}

.appscraft-screen-container i.back:hover {
    cursor: pointer;
}

.appscraft-screen-container i.back.show {
    opacity: 1;
}

.ball {
    width: 50px;
    height: 50px;
    background: #f23965;
    border-radius: 50%;
    position: absolute;
    right: 10px;
    bottom: 10px;
    overflow: hidden;
    transition: all 200ms cubic-bezier(0.25, 0.75, 0.5, 1.25);
}

.ball:before {
    content: '';
    width: 50px;
    height: 50px;
    position: absolute;
    margin: auto;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    border-radius: 50%;
    background: #b90c35;
    opacity: 0;
    cursor: pointer;
}

.ball:hover {
    cursor: pointer;
}

.ball.active {
    width: 200px;
    height: 200px;
    bottom: -65px;
    right: -65px;
}

.ball.active:hover {
    cursor: default;
}

.ball.active:before {
    opacity: 1;
}

.ball.active svg {
    transform: rotate(45deg);
    cursor: pointer;
}

.ball.active .first {
    top: 20px;
    opacity: 1;
}

.ball.active .second {
    top: 40px;
    left: 40px;
    opacity: 1;
}

.ball.active .third {
    left: 20px;
    opacity: 1;
}

.ball svg {
    position: absolute;
    margin: auto;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    transition: all 200ms cubic-bezier(0.25, 0.75, 0.5, 1.25);
}

.ball i {
    color: #fff;
    width: 24px;
    height: 24px;
    position: absolute;
    margin: auto;
    transition: all 200ms cubic-bezier(0.25, 0.75, 0.5, 1.25);
    opacity: 0;
    font-size: 1.5em;
}

.ball i.first {
    top: -40px;
    left: 0;
    right: 0;
    text-align: center;
}

.ball i.second {
    left: -25px;
    top: -25px;
}

.ball i.third {
    left: -40px;
    top: 0;
    bottom: 0;
}

.ball.expand {
    width: 200%;
    height: 150%;
    bottom: -25%;
    right: -50%;
    background-image: url(img/screenshort-slider-img-2.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
}

.ball.expand:before {
    opacity: 0;
}

.ball.expand>* {
    display: none;
}

@keyframes startup {
    0% {
        transform: translate(0, 300px);
        opacity: 0;
    }
    100% {
        transform: translate(0, 0);
        opacity: 1;
    }
}

@-webkit-keyframes startup {
    0% {
        transform: translate(0, 300px);
        opacity: 0;
    }
    100% {
        transform: translate(0, 0);
        opacity: 1;
    }
}

@keyframes shake {
    0%,
    7% {
        transform: rotateZ(0);
    }
    15% {
        transform: rotateZ(-4deg);
    }
    20% {
        transform: rotateZ(3deg);
    }
    25% {
        transform: rotateZ(-3deg);
    }
    30% {
        transform: rotateZ(2deg);
    }
    35% {
        transform: rotateZ(-1deg);
    }
    40%,
    100% {
        transform: rotateZ(0);
    }
}

@-webkit-keyframes shake {
    0%,
    7% {
        transform: rotateZ(0);
    }
    15% {
        transform: rotateZ(-4deg);
    }
    20% {
        transform: rotateZ(3deg);
    }
    25% {
        transform: rotateZ(-3deg);
    }
    30% {
        transform: rotateZ(2deg);
    }
    35% {
        transform: rotateZ(-1deg);
    }
    40%,
    100% {
        transform: rotateZ(0);
    }
}

/*=========================================================================== 
		4. Apps Craft About 
====================================================================================================*/

.apps-craft-single-about {
    text-align: center;
    color: #FFFFFF;
}

.apps-craft-single-about span {
    font-size: 2.857em;
    background-image: url(img/about-ico-bg.png);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: contain;
    display: inline-block;
    height: 97px;
    width: 97px;
    margin-bottom: 30px;
    line-height: 97px;
}

.apps-craft-single-about h3 {
    margin: 0;
    font-size: 1.714em;
    font-weight: 500;
    margin-bottom: 28px;
}

.apps-craft-single-about p {
    margin: 0;
    padding: 0 5px;
    color: #E3E3E3;
}

.apps-craft-about-section {
    position: absolute;
    width: 100%;
    bottom: 70px;
    left: 0;
    z-index: 1;
}

/*===================================================================
		5. Apps Craft Feature Section 
===================================================================================*/

.apps-craft-feature-section {
    background-color: #F4F4F4;
}

.apps-craft-single-feature {
    width: 50%;
    float: left;
    padding: 15px;
    text-align: center;
}

.apps-craft-feature-content {
    background-color: #FFFFFF;
    box-shadow: 0 0 35px rgba(0, 0, 0, .08);
    padding: 20px 20px;
    position: relative;
    z-index: 2;
}

.apps-craft-feature-content:before {
    position: absolute;
    content: "";
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: -1;
    -webkit-transition: opacity .4s linear;
    transition: opacity .4s linear;
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
}

.apps-craft-feature-content i {
    color: #FFFFFF;
    font-size: 3.000em;
    width: 76px;
    height: 76px;
    border-radius: 100%;
    background-color: #f2504d;
    box-shadow: 0 18px 32px rgba(0, 0, 0, .28);
    line-height: 76px;
    display: inline-block;
    margin-bottom: 20px;
    -webkit-transition: background .4s linear;
    transition: background .4s linear;
}

.apps-craft-feature-content h3 {
    margin: 0;
    color: #666666;
    font-size: 1.714em;
    font-weight: 500;
    margin-bottom: 25px;
}

.apps-craft-feature-content p {
    margin: 0;
}

.apps-craft-feature-content:hover:before {
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
}

.apps-craft-feature-content:hover i {
    color: #333333;
    background: none;
    background-color: #FEEDEF;
}

.apps-craft-feature-content:hover h3 {
    color: #FFFFFF;
}

.apps-craft-feature-content:hover p {
    color: #DDDDDD;
}

.apps-craft-feature-img figure {
    position: relative;
    text-align: center;
    display: inline-block;
}

.apps-craft-feature-img .apps-craft-feature-ico {
    position: absolute;
}

.apps-craft-feature-img .icon-1x {
    left: 0px;
    top: 163px;
    width: 93px;
}

.apps-craft-feature-img .icon-2x {
    left: 0;
    top: 133px;
    width: 64px;
}

.apps-craft-feature-img .icon-3x {
    left: 0;
    top: 96px;
    width: 24px;
}

.apps-craft-feature-img .icon-4x {
    left: 0;
    top: -17px;
    width: 73px;
}

.apps-craft-feature-img .icon-5x {
    left: 0;
    top: -92px;
    width: 84px;
}

.apps-craft-feature-img .icon-6x {
    top: 0;
    left: 40px;
    width: 19px;
}

.apps-craft-feature-img .icon-7x {
    top: 0;
    left: 60px;
    width: 119px;
}

.apps-craft-feature-img .icon-8x {
    top: 0;
    left: inherit;
    right: 30px;
    width: 70px;
}

.apps-craft-feature-img .icon-9x {
    top: 10px;
    left: 0;
    width: 149px;
}

.apps-craft-feature-img .icon-10x {
    top: 0;
    left: inherit;
    right: 111px;
    width: 33px;
}

.apps-craft-feature-img .icon-11x {
    top: -40px;
    left: inherit;
    right: 0;
    width: 129px;
}

.apps-craft-feature-img .icon-12x {
    top: 70px;
    left: inherit;
    right: 0;
    width: 112px;
}

.apps-craft-feature-img .icon-13x {
    top: -50px;
    left: inherit;
    right: 0;
    width: 67px;
}

.apps-craft-feature-img .icon-14x {
    top: -70px;
    left: inherit;
    right: 0;
    width: 25px;
}

.apps-craft-feature-img .icon-15x {
    top: 38px;
    left: inherit;
    right: 0;
    width: 21px;
}

.apps-craft-feature-img .icon-16x {
    top: -62px;
    left: 0;
    right: inherit;
    width: 30px;
}

/*======================================================
		6. Apps Craft Video Section 
======================================================================*/

.apps-craft-video-section {
    position: relative;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    background-attachment: fixed;
    overflow: hidden;
    z-index: 3;
    text-align: center;
    color: #FFFEFE;
    width: 100%;
    height: 600px;
    display: table;
}

.apps-craft-video-section-inner {
    display: table-cell;
    vertical-align: middle;
}

.apps-craft-video-section:before {
    position: absolute;
    content: "";
    top: 0;
    right: 0;
    height: 100%;
    width: 100%;
    background-image: url(img/video-bg-overlay.png);
    background-repeat: no-repeat;
    background-position: 100% 50%;
    background-size: 50%;
    z-index: 2;
}

.apps-craft-video-section:after {
    position: absolute;
    content: "";
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 1;
    background-color: #232838;
    background-image: -webkit-radial-gradient( 50% 50%, circle closest-side, rgba(59, 60, 62, 0.87843) 0%, rgba(59, 60, 62, 0.88) 0%, rgba(47, 50, 59, 0.94) 47%, rgb(35, 40, 56) 100%);
    background-image: -ms-radial-gradient( 50% 50%, circle closest-side, rgba(59, 60, 62, 0.87843) 0%, rgba(59, 60, 62, 0.88) 0%, rgba(47, 50, 59, 0.94) 47%, rgb(35, 40, 56) 100%);
    opacity: .93;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=93)";
}

.apps-craft-video-content {
    position: relative;
    z-index: 4;
}

.apps-craft-video-content h4 {
    margin: 0;
    font-size: 2.571em;
    text-transform: capitalize;
    margin-bottom: 63px;
}

.apps-craft-video-content a i {
    display: inline-block;
    font-size: 10.000em;
    color: #f4f4f4;
}

body.apps-craft-v6 .apps-craft-video-content {
    text-align: center;
    padding: 100px 0;
}

body.apps-craft-v6 .apps-craft-video-content h4 {
    margin-bottom: 10px;
}

body.apps-craft-v6 .apps-craft-video-content a i {
    font-size: 5.000em;
}

/*======================================================================= 
		7. Apps Craft Fun Factory 
==============================================================================================*/

.apps-craft-fun-factory-section {
    position: relative;
    background-color: #F4F4F4;
    z-index: 4;
    background-attachment: fixed;
}

.fun-factorey-paralx-bg-1 {
    width: 100%;
    background-repeat: repeat-x;
}

.fun-factorey-paralx-bg-2 {
    width: 100%;
    background-repeat: repeat-x;
}

.apps-craft-fun-factory-section div.apps-craft-tbl {
    height: 600px;
}

.apps-craft-fun-factory-wraper {
    position: relative;
    z-index: 5;
    min-height: 200px;
    box-shadow: 0 24px 35px rgba(0, 0, 0, .06);
    background-color: rgba(244, 244, 244, .89);
    padding: 44px 0;
    background-attachment: fixed;
}

.apps-craft-single-fun {
    text-align: center;
}

.apps-craft-single-fun i {
    font-size: 2.571em;
    margin-bottom: 24px;
}

.apps-craft-single-fun h5 {
    margin: 0;
    color: #444444;
    font-size: 2.143em;
    font-weight: 600;
    margin-bottom: 10px;
}

.apps-craft-single-fun h6 {
    margin: 0;
    font-size: 1em;
    color: #333333;
    font-weight: 500;
    text-transform: capitalize;
}

/*======================================================================== 
		8. Apps Craft Why Choose Us 
=======================================================================================================*/

.apps-craft-why-chose-ico {
    width: 30%;
    float: left;
    height: 100%;
    text-align: center;
}

.apps-craft-why-chose-ico span.apps-craft-round {
    width: 86px;
    height: 86px;
    border-radius: 50%;
    background-color: #232838;
    box-shadow: 0 18px 32px rgba(0, 0, 0, .28);
    line-height: 86px;
    position: relative;
    color: #fff;
    font-size: 2.571em;
    text-align: center;
}

.apps-craft-dash-border {
    position: relative;
    display: block;
    height: 100%;
    width: 100%;
}

.apps-craft-dash-border:before {
    position: absolute;
    content: "";
    top: 0;
    left: 50%;
    right: 0;
    bottom: 0;
    height: 100%;
}

.apps-craft-why-chose-txt {
    width: 70%;
    float: left;
}

.apps-craft-why-chose-single {
    margin-bottom: 35px;
}

.apps-craft-why-chose-txt h3 {
    color: #666666;
    font-size: 1.714em;
    margin: 0;
    font-weight: 500;
    text-transform: capitalize;
    margin: 29px 0 23px;
}

.apps-craft-why-chose-txt p {
    margin: 0;
    color: #333333;
    word-break: break-all;
}

.apps-craft-why-choose-us-container {
    width: calc(100% - 160px);
    margin: 0 auto;
    display: table;
}

.apps-craft-why-choose-us-container-inner {
    vertical-align: middle;
    display: table-cell;
}

.apps-craft-why-chose-img {
    width: calc(100% - 70px);
    margin: auto 0 0 0;
}

.apps-craft-why-chose-us-section {
    position: relative;
    background-color: #FEFEFE;
}

#apps-craft-chose-us {
    background-image: url(img/why-choose-us-bg.png);
    background-repeat: repeat;
}

.apps-craft-why-chose-us-section .content-margin-top {
    margin-top: 80px;
}

.apps-craft-why-chose-us-section.section-padding {
    padding: 130px 0 0 0;
}

figure.apps-craft-why-chose-img img:first-child {
    position: absolute;
    width: 305px;
    left: 0;
    bottom: 0;
    z-index: 99;
}

figure.apps-craft-why-chose-img img:last-child {
    width: 375px;
}

.apps-craft-why-chose-img {
    float: right;
}

/*======================================================== 
		9. Apps Craft Screenshort Section 
==========================================================*/

.apps-carft-screen-short-ssection {
    background-color: #F0F0F0;
}

.apps-carft-screen-short-content {
    position: relative;
}

.apps-carft-screen-short-content #options #previous,
.apps-carft-screen-short-content #options #next {
    position: absolute;
    top: 50%;
    left: 0;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    background-color: transparent;
    border: 0px solid;
    font-size: 2.571em;
}

.apps-carft-screen-short-content #options #next {
    left: inherit;
    right: 0;
}

.apps-carft-screen-short-content #options #previous:focus,
.apps-carft-screen-short-content #options #next:focus {
    outline: none;
}

/*======================================================== 
		9.1 Apps Craft Showcase (V6)
==========================================================*/

.showcase-wrap {
    position: relative;
    padding: 100px 0;
    min-height: 600px;
}

.device {
    position: absolute;
    top: -66px;
    left: 20%;
    min-height: 676px;
    width: 359px;
    background: url(img/iphone-skeleton.png) no-repeat center center;
}

.device-content {
    position: absolute;
    top: 110px;
    left: 52px;
    width: 256px;
    height: 454px;
    background: rgba(0, 0, 0, 0.3);
}

.showcase-slider ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.showcase h1 {
    margin: 0 0 20px 0;
    color: #fff;
    font-weight: 400;
    font-size: 22px;
}

.showcase p {
    margin-bottom: 25px;
    color: #fff;
}

.device-content img {
    width: 255px;
    height: 454px;
}

.avatar i {
    color: #FFFFFF;
    font-size: 3.000em;
    width: 76px;
    height: 76px;
    border-radius: 100%;
    background-color: #f2504d;
    box-shadow: 0 18px 32px rgba(0, 0, 0, .28);
    line-height: 76px;
    display: inline-block;
    margin-bottom: 20px;
    -webkit-transition: background .4s linear;
    transition: background .4s linear;
}

blockquote.team-quote {
    margin: 20px 0 20px;
}

blockquote .avatar {
    display: inline-block;
    margin-right: 20px;
    width: 64px;
    height: 64px;
    vertical-align: middle;
}

blockquote .logo-quote {
    display: inline-block;
    margin: 25px 0 25px 90px;
}

blockquote.team-quote p {
    display: inline-block;
    margin: 0;
    padding: 0;
    width: 70%;
    vertical-align: top;
    font-style: italic;
}

.showcase-content .apps-craft-btn.solid-color {
    width: 215px;
    height: 70px;
    line-height: 60px;
    font-size: 1.5em;
}

.showcase-content h1 {
    font-size: 2em;
}

.showcase-content .owl-theme .owl-controls {
    margin-top: 0;
    text-align: center;
    position: absolute;
    width: 100%;
    bottom: 5px;
}

.showcase-content .owl-theme .owl-controls .owl-page span {
    display: block;
    margin: 5px 7px;
    border-radius: 20px;
    width: 13px;
    height: 13px;
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    background: transparent;
    border: 2px solid white;
    -webkit-transition: background 0.3s;
    transition: background 0.3s;
}

.showcase-content .owl-theme .owl-controls .owl-page.active span,
.showcase-content .owl-theme .owl-controls.clickable .owl-page:hover span {
    filter: Alpha(Opacity=100);
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    background: #fff;
}

/*=========================================================
		10. Apps Craft Testimonial 
==========================================================================*/

.apps-craft-commentor-img {
    position: relative;
    display: inline-block;
}

.apps-craft-commentor-img-continer {
    width: 26%;
    float: left;
}

.apps-craft-commentor-img img {
    width: 120px;
    height: 120px;
    border-radius: 100%;
    background-color: #fff;
    box-shadow: 0 18px 32px rgba(0, 0, 0, .28);
}

.apps-craft-commentor-img figcaption {
    width: 68px;
    height: 68px;
    border-radius: 34px;
    box-shadow: 0 30px 59px rgba(0, 0, 0, .17);
    text-align: center;
    line-height: 68px;
    color: #FEFEFE;
    font-size: 1.929em;
    top: 10px;
    position: absolute;
    right: -50px;
    z-index: -1;
}

.apps-craft-testimonial-content {
    width: calc(100% - 200px);
    margin: 0 auto;
    padding: 50px 0;
}

.apps-craft-rating-and-bio {
    width: 70%;
    float: left;
    position: relative;
}

.apps-craft-rating-and-bio:before,
.apps-craft-rating-and-bio:after {
    position: absolute;
    content: "\f1b2";
    top: -30px;
    left: -48px;
    font-family: 'Material-Design-Iconic-Font';
    color: #333333;
    font-size: 2.857em;
    -webkit-transform: rotate(-180deg);
    transform: rotate(-180deg)
}

.apps-craft-rating-and-bio:after {
    top: inherit;
    bottom: 0;
    left: inherit;
    right: -30px;
    -webkit-transform: rotateX(180deg);
    transform: rotateX(180deg);
}

.apps-craft-rating-and-bio p {
    font-weight: 400;
    color: #FFFFFF;
    margin: 0;
    margin-bottom: 30px;
}

.apps-craft-rating {
    width: 20%;
    float: left;
}

.apps-craft-rating ul li {
    float: left;
}

.apps-craft-rating ul li a {
    color: #FFDC3B;
    display: block;
    font-size: 1.286em;
}

.apps-craft-rating ul li a i {
    width: auto;
}

.apps-craft-commentor-bio {
    width: 80%;
    float: left;
}

.apps-craft-commentor-bio h3 {
    margin: 0;
    font-size: 1.286em;
    color: #FEFEFE;
    text-transform: uppercase;
    font-weight: 600;
    padding: 2px 15px;
}

.apps-craft-commentor-bio h3 span {
    color: #DDDDDD;
    text-transform: capitalize;
    font-weight: 300;
}

#apps-craft-testimonial-thumb .owl-wrapper,
#apps-craft-testimonial-thumb .owl-item {
    float: left;
    padding: 20px 0;
    top: 0;
}

#apps-craft-testimonial-thumb {
    text-align: center;
    width: 170px;
    margin: 0 auto;
}

#apps-craft-testimonial-thumb figure {
    display: inline-block;
    width: 38px;
    height: 38px;
    -webkit-border-radius: 19px;
    -moz-border-radius: 19px;
    cursor: pointer;
    position: relative;
}

#apps-craft-testimonial-thumb figure img {
    border-radius: 100%;
}

#apps-craft-testimonial-thumb figure:before {
    position: absolute;
    content: "";
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    -webkit-transition: all .4s ease-in;
    transition: all .4s ease-in;
    border-radius: 100%;
}

#apps-craft-testimonial-thumb .item {
    display: inline-block;
}

#apps-craft-testimonial-thumb .owl-item.synced figure:before {
    background-color: transparent;
}

#apps-craft-testimonial-thumb .owl-item.synced figure {
    width: 53px;
    height: 53px;
    top: -15px;
}

.apps-craft-testimonial-slider-wraper {
    position: relative;
}

.apps-craft-testimonial-slider-wraper .customNavigation .prev,
.apps-craft-testimonial-slider-wraper .customNavigation .next {
    position: absolute;
    top: 50%;
    left: 0;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    color: #FFFFFF;
    font-size: 2.571em;
    cursor: pointer;
}

.apps-craft-testimonial-slider-wraper .customNavigation .next {
    left: inherit;
    right: 0;
}

.owl-carousel .owl-item.active .apps-craft-commentor-img {
    -webkit-animation: fadeInRightPix 1s cubic-bezier(0.7, 0, 0.3, 1) 600ms both;
    animation: fadeInRightPix 1s cubic-bezier(0.7, 0, 0.3, 1) 600ms both;
}

.owl-carousel .owl-item.active .apps-craft-rating-and-bio {
    -webkit-animation: fadeInRightPix .8s cubic-bezier(0.7, 0, 0.3, 1) 600ms both;
    animation: fadeInRightPix .8s cubic-bezier(0.7, 0, 0.3, 1) 600ms both;
}

/*============================================================
		11. Apps Craft Pricing Table 
===========================================================================================*/

.apps-craft-single-pricing {
    text-align: center;
    background-color: #fff;
    box-shadow: 0 0 35px rgba(0, 0, 0, .09);
    padding: 60px 5px;
    background-repeat: no-repeat;
    background-position: bottom;
    background-size: contain;
}

.apps-craft-pricing-head {
    border-bottom: 1px solid #F4F4F4;
    padding-bottom: 32px;
    width: calc(100% - 36px);
    margin: 0 auto 28px auto;
}

.apps-craft-pricing-head h3 {
    color: #333333;
    margin: 0;
    font-size: 1.714em;
    font-weight: 500;
    text-transform: uppercase;
}

.apps-craft-pricing-body h2 {
    margin: 0;
    font-size: 4.286em;
    font-weight: 500;
    margin-bottom: 55px;
}

.apps-craft-pricing-body p {
    color: #333333;
    font-weight: 400;
    margin: 0 auto 10px auto;
    width: calc(100% - 50px);
    line-height: 1.7;
    text-transform: capitalize;
}

.apps-craft-pricing-1 {
    background-image: url(img/pricing-body-bg-1.png);
}

.apps-craft-pricing-2 {
    background-image: url(img/pricing-body-bg-2.png);
}

.apps-craft-pricing-3 {
    background-image: url(img/pricing-body-bg-3.png);
}

/*=============================================================================== 
		12. Apps Craft Team 
===================================================================================================*/

.apps-craft-team-section {
    background: #F4F4F4;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 100%;
    background-attachment: fixed;
}

.team-parallax-bg {
    background-image: url(img/team-bg.png);
    background-repeat: repeat-x;
    background-attachment: fixed;
}

.apps-craft-team-member-pic {
    width: 133px;
    height: 133px;
    border-radius: 100%;
    background-color: #fff;
    box-shadow: 0 18px 32px rgba(0, 0, 0, .08);
    margin: 0 auto;
    text-align: center;
    line-height: 133px;
    display: block;
}

.apps-craft-team-member-pic img {
    width: 112px;
    height: 112px;
    border-radius: 50%;
    background-color: #fff;
    box-shadow: 0 18px 32px rgba(0, 0, 0, .28);
}

.apps-craft-social-link {
    text-align: center;
}

.apps-craft-social-link ul li {
    display: inline-block;
    margin: 0 6px 0 0;
}

.apps-craft-social-link ul li:last-child {
    margin: 0;
}

.apps-craft-social-link ul li a {
    color: #FFFFFF;
    font-size: 1.714em;
    display: block;
}

.apps-craft-team-img {
    position: relative;
    margin-bottom: 90px;
}

.apps-craft-team-img .apps-craft-team-hover {
    position: absolute;
    top: 65%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    -webkit-transition: all .5s linear;
    transition: all .5s linear;
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
}

.apps-craft-team-member-pic:hover .apps-craft-team-hover {
    top: 50%;
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
}

.apps-craft-team-img:before {
    position: absolute;
    content: "";
    top: 100%;
    left: 50%;
    height: 89px;
    width: 1px;
}

.apps-craft-team-bio {
    text-align: center;
}

.apps-craft-team-bio h2 {
    margin: 0;
    text-transform: uppercase;
    color: #333333;
    font-size: 1.714em;
    font-weight: 500;
    margin-bottom: 18px;
}

.apps-craft-team-bio h5 {
    margin: 0;
    font-size: 1em;
    color: #666666;
    font-weight: 400;
    text-transform: capitalize;
}

.apps-craft-team-bio h5 span {
    color: #333333;
    font-weight: 500;
}

.apps-craft-team-member-pic:before {
    position: absolute;
    content: "";
    top: 0;
    left: 50%;
    width: 133px;
    height: 133px;
    border-radius: 100%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    -webkit-transition: all .4s linear;
    transition: all .4s linear;
}

.apps-craft-team-member-pic:hover:before {
    opacity: .83;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=83)";
}

/*============================================================= 
		13. Apps Craft now Available 
=======================================================================================*/

.apps-craft-now-available-section {
    background-color: #232838;
    position: relative;
    background-repeat: no-repeat;
    background-position: center center;
    text-align: center;
}

.apps-craft-app-secreenshort {
    width: calc(100% - 200px);
    margin: 0 auto;
    position: absolute;
    bottom: 0;
    left: 50%;
}

.apps-craft-now-available-section div.apps-craft-tbl {
    height: 630px;
}

.apps-craft-now-available-content {
    width: 56.6666667%;
    margin: 0 auto;
}

.apps-craft-now-available-content h3 {
    margin: 0;
    text-transform: capitalize;
    font-size: 2.571em;
    font-weight: 500;
    color: #FFFFFF;
    margin-bottom: 55px;
}

.apps-craft-now-available-content p {
    margin: 0;
    font-weight: 400;
    color: #E3E3E3;
    margin-bottom: 66px;
    line-height: 2;
}

/*=============================================================== 
		14. Apps Craft Subscribe 
===============================================================================================*/

.apps-craft-subscribe-wraper {
    position: relative;
    background-color: #fff;
    box-shadow: 0px 29px 43px 0px rgba(0, 0, 0, 0.21);
    text-align: center;
    padding: 162px 0;
    min-height: 410px;
}

/*
.apps-craft-subscribe-wraper:before,
.apps-craft-subscribe-wraper:after {
    position: absolute;
    content: "";
    top: -75px;
    left: 29px;
    width: 17px;
    height: 240px;
    background-color: #fff;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    border-radius: 50px;
}
*/

.apps-craft-subscribe-wraper:after {
    left: inherit;
    right: 29px;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
}

.apps-craft-3-bar {
    position: absolute;
    top: 0;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
}

.apps-craft-subscribe-content {
    width: 50%;
    margin: 0 auto;
    color: #FFFFFF;
}

.apps-craft-subscribe-content h2 {
    font-size: 2.571em;
    margin: 0;
    text-transform: capitalize;
    margin-bottom: 57px;
    font-weight: 400;
    text-align: center;
    line-height: 1.3;
}

.apps-craft-subscribe-content h2 span {
    font-weight: 600;
}

.apps-craft-subscribe-form input[type="email"] {
    width: calc(100% - 0px);
    height: 70px;
    border-radius: 35px;
    background-color: rgba(244, 244, 244, .98);
    border: solid 1px #c1c1c1;
    padding: 0 30px;
    color: #000;
    float: left;
}

.apps-craft-subscribe-form input[type="email"]::-webkit-input-placeholder {
    /* Chrome/Opera/Safari */
    color: #666666;
}

.apps-craft-subscribe-form input[type="email"]::-moz-placeholder {
    /* Firefox 19+ */
    color: #666666;
}

.apps-craft-subscribe-form input[type="email"]:-ms-input-placeholder {
    /* IE 10+ */
    color: #666666;
}

.apps-craft-subscribe-form input[type="email"]:-moz-placeholder {
    /* Firefox 18- */
    color: #666666;
}

.apps-craft-subscribe-form input[type="submit"] {
    width: 160px;
    height: 54px;
    border-radius: 27px;
    border: 0px;
    margin-left: -170px;
    font-size: 1.286em;
    font-weight: 500;
    color: #FFFFFF;
    text-transform: capitalize;
    float: left;
    margin-top: 8px;
}

body.apps-craft-v6 .apps-craft-subscribe-content {
    position: relative;
    z-index: 4;
}

/*============================================================ 
		15. Apps Craft FAQ Section 
====================================================================================*/

.apps-craft-faq-section {
    background-color: #F4F4F4;
}

.apps-craft-accordion .panel-title a {
    display: block;
}

.apps-craft-accordion .panel-heading {
    background-color: transparent;
    border: 0px solid;
    border-color: transparent;
    padding: 0;
}

.apps-craft-accordion .panel-default {
    border-color: transparent;
}

.apps-craft-accordion .panel {
    box-shadow: none;
    margin-bottom: 35px;
}

.apps-craft-accordion .panel-default>.panel-heading+.panel-collapse>.panel-body {
    border-top-color: transparent;
    border: 0px solid;
    padding: 22px 42px;
}

.apps-craft-accordion .panel-title {
    width: 100%;
    height: 90px;
    border-radius: 3px;
    display: table;
    padding: 0 30px;
    -webkit-transition: all .4s linear;
    transition: all .4s linear;
}

.apps-craft-accordion .panel-title a {
    display: table-cell;
    vertical-align: middle;
    color: #FFFFFF;
    font-weight: 500;
    font-size: 1.714em;
    position: relative;
    padding: 0 0 0 72px;
    -webkit-transition: all .4s linear;
    transition: all .4s linear;
}

.apps-craft-accordion .panel-title a.collapsed:before {
    position: absolute;
    content: "+";
    width: 36px;
    height: 36px;
    border-radius: 18px;
    background-color: #f4f4f4;
    font-size: 1.083em;
    font-weight: 500;
    text-align: center;
    line-height: 38px;
    top: 50%;
    left: 0;
    -webkit-transform: translateY(-50%) rotate(0deg);
    transform: translateY(-50%) rotate(0deg);
    -webkit-transition: all .4s ease-in;
    transition: all .4s ease-in;
}

.apps-craft-accordion .panel-title a:before {
    position: absolute;
    content: "-";
    width: 36px;
    height: 36px;
    border-radius: 18px;
    font-size: 1.083em;
    font-weight: 500;
    text-align: center;
    top: 50%;
    left: 0;
    -webkit-transition: all .4s ease-in;
    transition: all .4s ease-in;
    line-height: 38px;
    -webkit-transform: translateY(-50%) rotate(360deg);
    transform: translateY(-50%) rotate(360deg);
    color: #FFFFFF;
}

.apps-craft-accordion .panel-collapse.collapse.in {
    border-radius: 3px;
    background-color: #fff;
    box-shadow: 0 0 32px rgba(0, 0, 0, .05);
}

.apps-craft-accordion .panel-collapse .panel-body {
    color: #666666;
    font-size: 1em;
}

.apps-craft-accordion .panel-title.click {
    background-color: #FFFFFF;
    background-image: none;
}

.apps-craft-accordion .panel-title.click a {
    color: #333333;
}

.apps-craft-contact-form-content {
    background-color: #fff;
    box-shadow: 0 0 32px rgba(0, 0, 0, .05);
}

.apps-craft-contact-form-content-inner {
    width: calc(100% - 170px);
    margin: 0 auto;
    padding: 86px 0;
}

.apps-craft-contact-form-content h2 {
    color: #666666;
    margin: 0;
    text-transform: capitalize;
    font-weight: 400;
    font-size: 2.571em;
    margin-bottom: 32px;
    line-height: 1.2;
}

.apps-craft-contact-form-content h2 span {
    font-weight: 700;
}

.apps-craft-contact-form input[type="email"],
.apps-craft-contact-form textarea {
    width: 100%;
    height: 60px;
    background-color: #FFFFFF;
    border: 1px solid #DDDDDD;
    border-radius: 0;
    padding: 0 25px;
    -webkit-transition: all .4s linear;
    transition: all .4s linear;
    display: block;
    margin-bottom: 15px;
}

.apps-craft-contact-form textarea {
    resize: none;
    height: 180px;
    padding: 25px;
}

.apps-craft-contact-form input[type="email"]:focus,
.apps-craft-contact-form textarea:focus {
    box-shadow: 0 3px 27px rgba(0, 0, 0, .08);
    border-color: #fff;
}

.apps-craft-contact-form input[type="submit"] {
    width: 180px;
    height: 60px;
    border-radius: 3px;
    border: 0px solid;
    color: #FFFFFF;
    font-weight: 400;
    font-size: 1.286em;
    text-transform: capitalize;
}

/*======================================================= 
		16. Apps Craft Footer 
===========================================================================*/

.apps-craft-footer-section {
    background-color: #F4F4F4;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    padding-bottom: 80px;
    padding-top: 360px;
    background-image: url(img/footer-bg.png);
}

.apps-craft-subscribe-form-box-shadow {
    background-color: rgba(244, 244, 244, .98);
    box-shadow: 0 8px 32px rgba(0, 0, 0, .28);
    border-color: #c1c1c1;
    border-radius: 35px;
}

.apps-craft-footer-section .apps-craft-subscribe-content {
    margin-bottom: 115px;
}

.apps-craft-footer-logo {
    padding-bottom: 77px;
}

.apps-craft-footer-logo-and-social {
    padding-bottom: 120px;
}

.apps-craft-solid-color .apps-craft-footer-section .apps-craft-footer-logo {
    padding-bottom: 47px;
}

.apps-craft-solid-color .apps-craft-welcome-section .apps-craft-about-section .apps-craft-subscribe-content {
    width: 50%;
    margin: 0 auto;
    padding: 0;
}

.apps-craft-footer-menu-and-copyright-txt .apps-craft-copyright-txt {
    width: 25%;
    float: left;
    text-align: left;
}

.apps-craft-copyright-txt p {
    color: #FFFFFF;
    margin: 0;
    text-transform: uppercase;
    font-weight: 500;
}

.apps-craft-footer-menu-and-copyright-txt .apps-craft-footer-menu {
    width: 75%;
    float: left;
    text-align: right;
}

.apps-craft-footer-menu ul li {
    display: inline-block;
}

.apps-craft-footer-menu ul li a {
    display: block;
    color: #FFFFFF;
    text-transform: uppercase;
    font-weight: 500;
    margin: 0 11px;
}

/*===============================================================
		17. Apps Craft Magnific Custom Css 
 =====================================================================================*/

.mfp-fade.mfp-bg {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    -webkit-transition: all 0.15s ease-out;
    transition: all 0.15s ease-out;
}

.mfp-fade.mfp-bg.mfp-ready {
    opacity: 0.8;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
}

.mfp-fade.mfp-bg.mfp-removing {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
}

.mfp-fade.mfp-wrap .mfp-content {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    -webkit-transition: all 0.15s ease-out;
    transition: all 0.15s ease-out;
}

.mfp-fade.mfp-wrap.mfp-ready .mfp-content {
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
}

.mfp-fade.mfp-wrap.mfp-removing .mfp-content {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
}

/*==================================================================
  18. Contact Form
  =================================================================*/

form#apps-craft-form {
    position: relative;
}

div.apps_craft_error {
    color: red;
    position: absolute;
    top: -30px;
    left: 0;
    font-size: 1em;
    width: 100%;
    height: inherit;
    box-shadow: 0 0 black;
    margin: 0;
}

input.apps_craft_input_error {
    border: 1px solid red;
    -webkit-transition: all .4s;
    transition: all .4s;
}

div.apps-craft-success-message {
    color: green;
    margin-top: 15px;
    position: absolute;
    width: 100%;
    text-align: center;
    left: 0;
}

.apps-craft-submit-btn-ar {
    position: relative;
    display: inline-block;
}

/*================================================================= 
			Preloader 
=================================================================*/

span.apps-craft-loader.apps-craft-loader1 {
    position: absolute;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    top: 50%;
    right: -52px;
}

.apps-craft-loader,
.apps-craft-loader:before,
.apps-craft-loader:after {
    display: inline-block;
    width: 30px;
    height: 30px;
    vertical-align: middle;
    border-radius: 30px;
    border: 5px solid transparent;
    margin-right: 10px;
}

/**
 * Loader1
 */

.apps-craft-loader1 {
    position: relative;
    border: 5px solid rgb(29, 70, 82);
}

.apps-craft-loader1:after {
    content: '';
    position: absolute;
    top: -5px;
    left: -5px;
    border: 5px solid transparent;
    border-top-color: #fff;
    -webkit-animation: spin 1s linear infinite;
    animation: spin 1s linear infinite;
}

/**
 *======================== Animations
 */

@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg)
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg)
    }
}

@keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg)
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg)
    }
}

@-webkit-keyframes spin-r {
    from {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg)
    }
    to {
        -webkit-transform: rotate(-360deg);
        transform: rotate(-360deg)
    }
}

@keyframes spin-r {
    from {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg)
    }
    to {
        -webkit-transform: rotate(-360deg);
        transform: rotate(-360deg)
    }
}

@-webkit-keyframes grow {
    0% {
        -webkit-transform: scaleY(1);
        transform: scaleY(1);
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    }
    50% {
        -webkit-transform: scaleY(0.5);
        transform: scaleY(0.5);
        opacity: 0.5;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    }
    100% {
        -webkit-transform: scaleY(1);
        transform: scaleY(1);
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    }
}

@keyframes grow {
    0% {
        -webkit-transform: scaleY(1);
        transform: scaleY(1);
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    }
    50% {
        -webkit-transform: scaleY(0.5);
        transform: scaleY(0.5);
        opacity: 0.5;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    }
    100% {
        -webkit-transform: scaleY(1);
        transform: scaleY(1);
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    }
}

@-webkit-keyframes fade {
    0% {
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    }
    100% {
        opacity: 0.2;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
    }
}

@keyframes fade {
    0% {
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    }
    100% {
        opacity: 0.2;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
    }
}

@-webkit-keyframes orbit {
    0% {
        -webkit-transform: rotate(225deg);
        transform: rotate(225deg);
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }
    7% {
        -webkit-transform: rotate(345deg);
        transform: rotate(345deg);
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
    }
    30% {
        -webkit-transform: rotate(455deg);
        transform: rotate(455deg);
        -webkit-animation-timing-function: ease-in-out;
        animation-timing-function: ease-in-out;
    }
    39% {
        -webkit-transform: rotate(690deg);
        transform: rotate(690deg);
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
    }
    70% {
        -webkit-transform: rotate(815deg);
        transform: rotate(815deg);
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }
    75% {
        -webkit-transform: rotate(945deg);
        transform: rotate(945deg);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }
    76% {
        -webkit-transform: rotate(945deg);
        transform: rotate(945deg);
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    }
    100% {
        -webkit-transform: rotate(945deg);
        transform: rotate(945deg);
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    }
}

@keyframes orbit {
    0% {
        -webkit-transform: rotate(225deg);
        transform: rotate(225deg);
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }
    7% {
        -webkit-transform: rotate(345deg);
        transform: rotate(345deg);
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
    }
    30% {
        -webkit-transform: rotate(455deg);
        transform: rotate(455deg);
        -webkit-animation-timing-function: ease-in-out;
        animation-timing-function: ease-in-out;
    }
    39% {
        -webkit-transform: rotate(690deg);
        transform: rotate(690deg);
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
    }
    70% {
        -webkit-transform: rotate(815deg);
        transform: rotate(815deg);
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }
    75% {
        -webkit-transform: rotate(945deg);
        transform: rotate(945deg);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }
    76% {
        -webkit-transform: rotate(945deg);
        transform: rotate(945deg);
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    }
    100% {
        -webkit-transform: rotate(945deg);
        transform: rotate(945deg);
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    }
}

/*=================================================================== 
			Extra 
=========================================================*/

.apps-craft-subscribe-form form#mc-form {
    position: relative;
    text-align: center;
}

.apps-craft-subscribe-form label.error {
    color: red;
}

.apps-craft-subscribe-form label.valid {
    color: green;
}

.apps-craft-subscribe-form label {
    display: block;
    text-align: center;
    width: 100%;
    left: 0;
    bottom: -33px;
    font-weight: normal;
    padding: 10px;
    overflow: hidden;
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    position: absolute;
    -webkit-transition: opacity .4s;
    transition: opacity .4s;
}

label.apps-craft-subscribed-label {
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    position: static;
}

.apps-craft-subscribe-form {
    background-color: #fff;
    border-top-right-radius: 35px;
    border-top-left-radius: 35px;
    border-bottom-left-radius: 35px;
    border-bottom-right-radius: 35px;
}

/*Swiper Slider*/

.swiper-container.one {
    padding-bottom: 0;
}

.swiper-container.one .swiper-slide {
    margin: 0 -5px !important;
}

.home-screen-bg {
    position: relative;
    padding: 90px 48px;
}

.home-screen-bg:after {
    position: absolute;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: -1;
    content: "";
    background: url(img/mobile.png) center center / 100% 100% no-repeat scroll;
}

.apps-craft-banner-swiper {
    position: absolute;
    width: 100%;
    z-index: 9;
    bottom: 0px;
}

body.apps-craft-v9 .apps-craft-welcome-section {
    background-position: bottom center;
}

.apps-craft-banner-swiper:before {
    content: "";
    position: absolute;
    width: 0;
    height: 0;
    border-left: 50vw solid transparent;
    border-right: 50vw solid transparent;
    border-bottom: 50vh solid #F4F4F4;
    bottom: 0;
}

.apps-craft-banner-swiper:after {
    content: "";
}

body.apps-craft-v9 .apps-craft-welcome-content {
    text-align: center;
    color: #FFFFFF;
}

body.apps-craft-v9 .apps-craft-welcome-content h1 {
    margin-bottom: 25px;
}

.apps-craft-download-store-btn-group {
    margin-top: 40px;
}

body.apps-craft-v9 .apps-craft-welcome-section .apps-craft-welcome-tbl {
    height: 650px;
}