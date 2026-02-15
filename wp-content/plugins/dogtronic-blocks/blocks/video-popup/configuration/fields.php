<?php
if (function_exists('acf_add_local_field_group')):

	acf_add_local_field_group(
		[
			'key' => 'group_block_video_popup',
			'title' => 'Block: Video Popup',
			'fields' => [
				[
					'key' => 'field_video_popup_file',
					'label' => 'Video File',
					'name' => 'video_file',
					'type' => 'file',
					'return_format' => 'array',
					'library' => 'all',
					'mime_types' => 'mp4,webm',
					'required' => 1,
				],
				[
					'key' => 'field_video_popup_cover',
					'label' => 'Cover Image',
					'name' => 'cover_image',
					'type' => 'image',
					'return_format' => 'array',
					'preview_size' => 'medium',
					'library' => 'all',
				],
				[
					'key' => 'field_video_popup_play_label',
					'label' => 'Play Button Label',
					'name' => 'play_label',
					'type' => 'text',
					'default_value' => 'Play Video',
				],
			],
			'location' => [
				[
					[
						'param' => 'block',
						'operator' => '==',
						'value' => 'dogtronic-blocks/video-popup',
					],
				],
			],
		]
	);

endif;
