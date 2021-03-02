<?php
// Tags Cell
$tagsCellEmpty = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellLeftMiddle = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellLeftTop = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], [], [] );
$tagsCellRightMiddle = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellRightTop = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_TOP ], [], [] );

// Tags Ele
$tagsEleLabel = new xan\tags( [ 'small' ], [], [] );
$tagsEleInput = new xan\tags( [ 'col' ], [], [] );
$tagsEleSelector = new xan\tags( [], [], [] );

// Detail Cards Append
require_once( 'content-card-stats-diskram.php' );
require_once( 'content-card-stats-diskdir.php' );
require_once( 'content-card-stats-processes.php' );
require_once( 'content-card-stats-sessions.php' );
require_once( 'content-card-stats-sessionsarray.php' );
require_once( 'content-card-stats-processespools.php' );
?>