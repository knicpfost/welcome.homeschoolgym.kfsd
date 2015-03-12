<?php

if ( function_exists('register_sidebar') )
    register_sidebar(array('name'=>'sidebar',
        'before_widget' => '<li>',
    'after_widget' => '</li>',
 'before_title' => '',
        'after_title' => '',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array('name'=>'sidebar2',
        'before_widget' => '<li>',
    'after_widget' => '</li>',
 'before_title' => '',
        'after_title' => '',
    ));
    
?>