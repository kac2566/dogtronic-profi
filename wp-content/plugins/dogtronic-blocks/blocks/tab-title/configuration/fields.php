<?php
if (function_exists('acf_add_local_field_group')):

	acf_add_local_field_group(
		[
			'key' => 'group_block_tab_title',
			'title' => 'Block: Tab Title',
			'fields' => [
				[
					'key' => 'field_tab_title_label',
					'label' => 'Label',
					'name' => 'label',
					'type' => 'text',
					'default_value' => 'Tab',
					'required' => 1,
				],
			],
			'location' => [
				[
					[
						'param' => 'block',
						'operator' => '==',
						'value' => 'dogtronic-blocks/tab-title',
					],
				],
			],
		]
	);

endif;
