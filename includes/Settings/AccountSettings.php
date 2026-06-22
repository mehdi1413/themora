<?php

namespace Themora\Inc\Settings;

use Themora\Inc\Settings\Contracts\SettingInterface;

class AccountSettings implements SettingInterface{

	public function validate( array $input ): array {
		$output = [
			'menu' => []
		];


		if (
			empty($input['menu'])
			|| ! is_array($input['menu'])
		){
			return $output;
		}

		foreach ($input['menu'] as $item){
			if( ! is_array($item) ){
				continue;
			}

			$output['menu'][] = [
				'key' => sanitize_key( $item['key'] ?? '' ),
				'label' => sanitize_text_field( $item['label'] ?? '' ),
				'enabled' => !empty( $item['enabled'] ),
				'showIcon' => !empty( $item['showIcon'] ),
				'icon' => $this->validateIcon( $item['icon'] ?? null )
			];
		}

		return $output;
	}

	private function validateIcon( ?array $icon ): ?array {
		if( empty($icon) || !is_array($icon) ){
			return null;
		}

		return [
			'pack' => sanitize_key( $icon['pack'] ?? '' ),
			'icon' => sanitize_text_field( $icon['icon'] ?? '' )
		];
	}
}