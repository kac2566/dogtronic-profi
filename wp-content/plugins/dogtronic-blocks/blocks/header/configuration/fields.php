<?php
if (function_exists('acf_add_local_field_group')):

	acf_add_local_field_group(
		[
			'key' => 'group_block_header',
			'title' => 'Block: Header',
			'fields' => [
				[
					'key' => 'field_header_sticky',
					'label' => 'Sticky Header',
					'name' => 'sticky',
					'type' => 'true_false',
					'ui' => 1,
					'default_value' => 0,
				],
			],
			'location' => [
				[
					[
						'param' => 'block',
						'operator' => '==',
						'value' => 'dogtronic/header',
					],
				],
			],
		]
	);

endif;
