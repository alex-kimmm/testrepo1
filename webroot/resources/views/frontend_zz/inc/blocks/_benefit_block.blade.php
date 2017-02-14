<?php
$positions = ['left','right'];
$position = $homePageBlock->position;
$position = in_array($position,$positions)? $position : $positions[0];
?>
@include('frontend_zz.inc.blocks._benefit_block_'.$position)