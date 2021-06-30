<?php
/*
Plugin Name: Publicaciones NLG
Plugin URI: https://github.com/Kevin-RB
Description: Prototipo de plugin para gestion de publicaciónes
Version: 1
Author: Kevin Romero Bedoya - Alexander Ordoñez
License: GPLv2 or later
Text Domain: kevin
*/

function register_my_post_type() {
    global $post;

    register_post_type('publicaciones', [
        'labels' => [
            'name' => __('Publicaciones'),
            'singular_name' => __('Publicacion')
        ],
        'public' =>  true,
        'supports' => ['title'],
        'rewrite' => [
            'slug' => 'publicacion',
        ]
    ]);
}

add_action('init', 'register_my_post_type');


function show_publications($content) {
    global $post;

    if (is_singular('publicaciones')) {
        $autor = get_field('autor', $post->ID);
        $descripcion = get_field('descripcion', $post->ID);
        $imagen = get_field('imagen', $post->ID);

        $content .= "<div class='autor'>{$autor}</div>";
        $content .= "<div class='autor'>{$descripcion }</div>";
        $content .= "<div class='image'><img src='{$imagen}'></div>";

        // foreach ($galeria as $image) {
        //     $content .= "<div class='image'><img src='{$image['image']}'></div>";
        // }

        // $form = "<form method='POST'><input type='hidden' name='action' value='accept'><button>Accept</button></form>";
        // $form .= "<form method='POST'><input type='hidden' name='action' value='reject'><button>Reject</button></form>";

        // $content .= $form;
    }

    return $content;
}

add_filter('the_content', 'show_publications', 10, 1);
