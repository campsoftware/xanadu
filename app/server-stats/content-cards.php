<?php
// Tags Cell
$tagsCellEmpty = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellLeftMiddle = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellLeftTop = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], [], [] );
$tagsCellRightMiddle = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellRightTop = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_TOP ], [], [] );

// Tags Ele
$tagsEleLabel = new \xan\tags( [ 'small' ], [], [] );
$tagsEleInput = new \xan\tags( [ 'col' ], [], [] );
$tagsEleSelector = new \xan\tags( [], [], [] );

// Detail Cards Append
require_once( 'contentCard-stats-diskRam.php' );
require_once( 'contentCard-stats-diskDir.php' );
require_once( 'contentCard-stats-processes.php' );
require_once( 'contentCard-stats-sessions.php' );
require_once( 'contentCard-stats-processesPools.php' );
// require_once( 'contentCard-stats-sessionsArray.php' );

?>