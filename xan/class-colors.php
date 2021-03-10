<?php

namespace xan;

class colorHex {

    // Constructor
    public function __construct() {
    }

    // Light and Dark Colors
    public function background( $isDark ) { ( $isDark == false ? '#ffffffff' : '#000000ff' ); }
    public function background2( $isDark ) { ( $isDark == false ? '#f2f2f7ff' : '#1c1c1eff' ); }
    public function background3( $isDark ) { ( $isDark == false ? '#ffffffff' : '#2c2c2eff' ); }
    public function backgroundGrouped( $isDark ) { ( $isDark == false ? '#f2f2f7ff' : '#000000ff' ); }
    public function backgroundGrouped2( $isDark ) { ( $isDark == false ? '#ffffffff' : '#1c1c1eff' ); }
    public function backgroundGrouped3( $isDark ) { ( $isDark == false ? '#f2f2f7ff' : '#2c2c2eff' ); }
    public function blue( $isDark ) { ( $isDark == false ? '#007affff' : '#0a84ffff' ); }
    public function fill( $isDark ) { ( $isDark == false ? '#78788033' : '#7878805b' ); }
    public function fill2( $isDark ) { ( $isDark == false ? '#78788028' : '#78788051' ); }
    public function fill3( $isDark ) { ( $isDark == false ? '#7676801e' : '#7676803d' ); }
    public function fill4( $isDark ) { ( $isDark == false ? '#74748014' : '#7676802d' ); }
    public function gray( $isDark ) { ( $isDark == false ? '#8e8e93ff' : '#8e8e93ff' ); }
    public function gray2( $isDark ) { ( $isDark == false ? '#aeaeb2ff' : '#636366ff' ); }
    public function gray3( $isDark ) { ( $isDark == false ? '#c7c7ccff' : '#48484aff' ); }
    public function gray4( $isDark ) { ( $isDark == false ? '#d1d1d6ff' : '#3a3a3cff' ); }
    public function gray5( $isDark ) { ( $isDark == false ? '#e5e5eaff' : '#2c2c2eff' ); }
    public function gray6( $isDark ) { ( $isDark == false ? '#f2f2f7ff' : '#1c1c1eff' ); }
    public function green( $isDark ) { ( $isDark == false ? '#34c759ff' : '#30d158ff' ); }
    public function indigo( $isDark ) { ( $isDark == false ? '#5856d6ff' : '#5e5ce6ff' ); }
    public function label( $isDark ) { ( $isDark == false ? '#000000ff' : '#ffffffff' ); }
    public function label2( $isDark ) { ( $isDark == false ? '#3c3c4399' : '#ebebf599' ); }
    public function label3( $isDark ) { ( $isDark == false ? '#3c3c434c' : '#ebebf54c' ); }
    public function label4( $isDark ) { ( $isDark == false ? '#3c3c432d' : '#ebebf52d' ); }
    public function link( $isDark ) { ( $isDark == false ? '#007affff' : '#0984ffff' ); }
    public function orange( $isDark ) { ( $isDark == false ? '#ff9500ff' : '#ff9f0aff' ); }
    public function pink( $isDark ) { ( $isDark == false ? '#ff2d55ff' : '#ff375fff' ); }
    public function placeholderText( $isDark ) { ( $isDark == false ? '#3c3c434c' : '#ebebf54c' ); }
    public function purple( $isDark ) { ( $isDark == false ? '#af52deff' : '#bf5af2ff' ); }
    public function red( $isDark ) { ( $isDark == false ? '#ff3b30ff' : '#ff453aff' ); }
    public function separator( $isDark ) { ( $isDark == false ? '#3c3c4349' : '#54545899' ); }
    public function separatorOpaque( $isDark ) { ( $isDark == false ? '#c6c6c8ff' : '#38383aff' ); }
    public function teal( $isDark ) { ( $isDark == false ? '#5ac8faff' : '#64d2ffff' ); }
    public function textDark( $isDark ) { ( $isDark == false ? '#000000ff' : '#000000ff' ); }
    public function textLight( $isDark ) { ( $isDark == false ? '#ffffff99' : '#ffffff99' ); }
    public function yellow( $isDark ) { ( $isDark == false ? '#ffcc00ff' : '#ffd60aff' ); }

}

?>