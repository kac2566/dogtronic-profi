<?php
if (function_exists('acf_add_local_field_group')):

	acf_add_local_field_group(
		[
			'key' => 'group_block_static_image',
			'title' => 'Block: Static Image',
			'fields' => [
				[
					'key' => 'field_static_image_desktop',
					'label' => 'Image (Desktop)',
					'name' => 'image_desktop',
					'type' => 'image',
					'return_format' => 'array',
					'preview_size' => 'medium',
					'library' => 'all',
					'required' => 1,
				],
				[
					'key' => 'field_static_image_mobile',
					'label' => 'Image (Mobile)',
					'name' => 'image_mobile',
					'type' => 'image',
					'return_format' => 'array',
					'preview_size' => 'medium',
					'library' => 'all',
					'required' => 1,
				],
				[
					'key' => 'field_static_image_contrast',
					'label' => 'Image (Contrast)',
					'name' => 'image_contrast',
					'type' => 'image',
					'return_format' => 'array',
					'preview_size' => 'medium',
					'library' => 'all',
					'instructions' => 'Optional. Shown when user prefers high contrast.',
				],
				[
					'key' => 'field_static_image_size',
					'label' => 'Image Size',
					'name' => 'image_size',
					'type' => 'select',
					'choices' => [
						'full' => 'Full Size',
						'large' => 'Large',
						'medium' => 'Medium',
						'thumbnail' => 'Thumbnail',
					],
					'default_value' => 'full',
					'return_format' => 'value',
				],
			],
			'location' => [
				[
					[
						'param' => 'block',
						'operator' => '==',
						'value' => 'dogtronic-blocks/static-image',
					],
				],
			],
		]
	);

endif;
