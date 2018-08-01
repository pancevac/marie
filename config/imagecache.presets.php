<?php

/**
 * Key value pair of presets with the name and dimensions to be used
 *
 * 'PRESET_NAME' => array(
 *   'width'  => INT, // in pixels
 *   'height' => INT, // in pixels
 *   'method' => STRING, // 'crop' or 'resize'
 *   'background_color' => '#000000', //  (optional) Used with resize
 * )
 *
 * eg   'presets' => array(
 *        '800x600' => array(
 *          'width' => 800,
 *          'height' => 600,
 *          'method' => 'resize',
 *          'background_color' => '#000000',
 *        )
 *      ),
 *
 */
return array(

    '120x120' => array(
        'width' => 120,
        'height' => 'auto',
        'method' => 'resize',
    ),
    '308x173' => array(
        'width' => 308,
        'height' => 173,
        'method' => 'crop',
    ),
    '650x278' => array(
        'width' => 650,
        'height' => 278,
        'method' => 'crop',
    ),
    '800x342' => array(
        'width' => 800,
        'height' => 342,
        'method' => 'crop',
    ),

);
