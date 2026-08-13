<?php

function crb_load()
{
    require_once( __DIR__ . "/../vendor/autoload.php" );
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'after_setup_theme', 'crb_load' );

function crb_attach_theme_options()
{
    \Carbon_Fields\Container::make( 'theme_options', __( 'Theme Options' ) )
        ->add_fields( array(
            \Carbon_Fields\Field::make( 'text', 'setting_facebook', 'Facebook URL' ),
            \Carbon_Fields\Field::make( 'text', 'setting_twitter', 'Twitter URL' ),
            \Carbon_Fields\Field::make( 'text', 'setting_instagram', 'Instagram URL' ),
            \Carbon_Fields\Field::make( 'text', 'setting_linkedin', 'LinkedIn URL' ),
        ) );

    \Carbon_Fields\Container::make( 'post_meta', 'Homepage Settings' )
        ->where( 'post_id', '=', get_option( 'page_on_front' ) )
        ->add_fields([
            \Carbon_Fields\Field::make('text', 'number_of_posts', 'How many latest articles?'),
            \Carbon_Fields\Field::make('text', 'number_of_category_posts', 'How many category articles?'),
            \Carbon_Fields\Field::make('complex', 'categories', 'Selected Categories')
                ->add_fields([
                    \Carbon_Fields\Field::make('select', 'category_id', 'Category')
                        ->set_options(function () {
                            $categories = get_categories([
                                'hide_empty' => false,
                            ]);

                            $options = [];

                            foreach ($categories as $category) {
                                $options[$category->term_id] = $category->name;
                            }

                            return $options;
                        }),
                ])
        ]);

    \Carbon_Fields\Container::make( 'term_meta', __( 'Writer Options') )
        ->where( 'term_taxonomy', '=', 'writer' )
        ->add_fields( [
            \Carbon_Fields\Field::make( 'image', 'writer_photo', 'Photo' )
                ->set_value_type('url')
        ]);
}

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );