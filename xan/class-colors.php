<?php

namespace xan;

class colorHex {

    // Constructor
    public function __construct() {
    }

    // Light and Dark Colors
    function background( $isDark ) { ( $isDark == false ? '#ffffffff' : '#000000ff' ); }
    function background2( $isDark ) { ( $isDark == false ? '#f2f2f7ff' : '#1c1c1eff' ); }
    function background3( $isDark ) { ( $isDark == false ? '#ffffffff' : '#2c2c2eff' ); }
    function backgroundGrouped( $isDark ) { ( $isDark == false ? '#f2f2f7ff' : '#000000ff' ); }
    function backgroundGrouped2( $isDark ) { ( $isDark == false ? '#ffffffff' : '#1c1c1eff' ); }
    function backgroundGrouped3( $isDark ) { ( $isDark == false ? '#f2f2f7ff' : '#2c2c2eff' ); }
    function blue( $isDark ) { ( $isDark == false ? '#007affff' : '#0a84ffff' ); }
    function fill( $isDark ) { ( $isDark == false ? '#78788033' : '#7878805b' ); }
    function fill2( $isDark ) { ( $isDark == false ? '#78788028' : '#78788051' ); }
    function fill3( $isDark ) { ( $isDark == false ? '#7676801e' : '#7676803d' ); }
    function fill4( $isDark ) { ( $isDark == false ? '#74748014' : '#7676802d' ); }
    function gray( $isDark ) { ( $isDark == false ? '#8e8e93ff' : '#8e8e93ff' ); }
    function gray2( $isDark ) { ( $isDark == false ? '#aeaeb2ff' : '#636366ff' ); }
    function gray3( $isDark ) { ( $isDark == false ? '#c7c7ccff' : '#48484aff' ); }
    function gray4( $isDark ) { ( $isDark == false ? '#d1d1d6ff' : '#3a3a3cff' ); }
    function gray5( $isDark ) { ( $isDark == false ? '#e5e5eaff' : '#2c2c2eff' ); }
    function gray6( $isDark ) { ( $isDark == false ? '#f2f2f7ff' : '#1c1c1eff' ); }
    function green( $isDark ) { ( $isDark == false ? '#34c759ff' : '#30d158ff' ); }
    function indigo( $isDark ) { ( $isDark == false ? '#5856d6ff' : '#5e5ce6ff' ); }
    function label( $isDark ) { ( $isDark == false ? '#000000ff' : '#ffffffff' ); }
    function label2( $isDark ) { ( $isDark == false ? '#3c3c4399' : '#ebebf599' ); }
    function label3( $isDark ) { ( $isDark == false ? '#3c3c434c' : '#ebebf54c' ); }
    function label4( $isDark ) { ( $isDark == false ? '#3c3c432d' : '#ebebf52d' ); }
    function link( $isDark ) { ( $isDark == false ? '#007affff' : '#0984ffff' ); }
    function orange( $isDark ) { ( $isDark == false ? '#ff9500ff' : '#ff9f0aff' ); }
    function pink( $isDark ) { ( $isDark == false ? '#ff2d55ff' : '#ff375fff' ); }
    function placeholderText( $isDark ) { ( $isDark == false ? '#3c3c434c' : '#ebebf54c' ); }
    function purple( $isDark ) { ( $isDark == false ? '#af52deff' : '#bf5af2ff' ); }
    function red( $isDark ) { ( $isDark == false ? '#ff3b30ff' : '#ff453aff' ); }
    function separator( $isDark ) { ( $isDark == false ? '#3c3c4349' : '#54545899' ); }
    function separatorOpaque( $isDark ) { ( $isDark == false ? '#c6c6c8ff' : '#38383aff' ); }
    function teal( $isDark ) { ( $isDark == false ? '#5ac8faff' : '#64d2ffff' ); }
    function textDark( $isDark ) { ( $isDark == false ? '#000000ff' : '#000000ff' ); }
    function textLight( $isDark ) { ( $isDark == false ? '#ffffff99' : '#ffffff99' ); }
    function yellow( $isDark ) { ( $isDark == false ? '#ffcc00ff' : '#ffd60aff' ); }

}

?>