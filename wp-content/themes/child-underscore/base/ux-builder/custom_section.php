<?php
add_ux_builder_shortcode('custom_section', array(
	'type'      => 'container',
	'name'      => __('Custom Section', 'ux-builder'),
	'category'  => __('Layout'),
	'template'  => custom_flatsome_ux_builder_template('section.html'), // cách hiển thị trong UX Builder
	'thumbnail' => custom_flatsome_ux_builder_thumbnail('section'), // hình đại diện trong UX Builder
	'info'      => '{{ label }}',
	'priority'  => -1, // thứ tự sắp xếp trong danh mục, nhỏ trước lớn sau
	// ---------------Các thuộc tính cho phép nested-------------
	'wrap'      => false,
	'require'   => array(),  // Không yêu cầu wrapper
	'allow'     => array(),  // Cho phép tất cả elements
	// ---------------Các thuộc tính cho phép nested-------------
	'options' => array(
		'label'      => array(
			'type'        => 'textfield',
			'heading'     => 'Admin label',
			'placeholder' => 'Enter admin label...',
		),

		'layout_options'     => array(
			'type'    => 'group',
			'heading' => __('Layout'),
			'options' => array(
				'dark'            => array(
					'type'    => 'radio-buttons',
					'heading' => 'Color',
					'default' => 'false',
					'options' => array(
						'true'  => array('title' => 'Light'),
						'false' => array('title' => 'Dark'),
					),
				),
				'sticky'          => array(
					'type'    => 'radio-buttons',
					'heading' => 'Sticky',
					'default' => '',
					'options' => array(
						'true' => array('title' => 'On'),
						''     => array('title' => 'Off'),
					),
				),
				'padding'         => array(
					'type'       => 'scrubfield',
					'heading'    => 'Padding',
					'responsive' => true,
					'default'    => '30px',
					'min'        => 0,
					'max'        => 500,
				),
				'height'          => array(
					'type'       => 'scrubfield',
					'heading'    => 'Min Height',
					'responsive' => true,
					'min'        => 0,
					'max'        => 1000,
				),
				'margin'          => array(
					'type'    => 'scrubfield',
					'heading' => 'Margin',
					'min'     => -500,
					'max'     => 500,
				),
				'scroll_for_more' => array(
					'type'    => 'radio-buttons',
					'heading' => 'Scroll For More',
					'default' => '',
					'options' => array(
						''     => array('title' => 'Off'),
						'true' => array('title' => 'On'),
					),
				),
				'loading'         => array(
					'type'    => 'radio-buttons',
					'heading' => 'Loading Spinner',
					'default' => '',
					'options' => array(
						''     => array('title' => 'Off'),
						'true' => array('title' => 'On'),
					),
				),
			),
		),
		'advanced_options' => require(get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php'),
	),
));
