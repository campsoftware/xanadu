<?php
// Tags Cell
$tagsCellEmpty = new \xan\tags( [ 'border-0', 'pb-2', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellLeftMiddle = new \xan\tags( [ 'border-0', 'pb-2', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellLeftTop = new \xan\tags( [ 'border-0', 'pb-2', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], [], [] );
$tagsCellRightMiddle = new \xan\tags( [ 'border-0', 'pb-2', TEXT_ALIGN_RIGHT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellRightTop = new \xan\tags( [ 'border-0', 'pb-1', TEXT_ALIGN_RIGHT, TABLE_ALIGN_TOP ], [], [] );
$tagsCellCenterMiddle = new \xan\tags( [ 'border-0', 'pb-2', TEXT_ALIGN_CENTER, TABLE_ALIGN_MIDDLE ], [], [] );

// Tags Ele
$tagsEleLabel = new \xan\tags( [ 'small' ], [], [] );
$tagsEleInput = new \xan\tags( [ 'col' ], [], [] );
$tagsEleSelector = new \xan\tags( [], [], [] );

// Detail Cards Append
require_once( 'contentCard-home.php' );
?>