<?php

class IAG_Mega_Menu_Walker extends Walker_Nav_Menu {

	private string $menu_id_attr = 'menu-header-menu';

	public function __construct( string $menu_slug = 'header-menu' ) {
		$this->menu_id_attr = 'menu-' . sanitize_title( $menu_slug );
	}

	public function walk( $elements, $max_depth, ...$args ) {
		if ( empty( $elements ) ) {
			return '';
		}

		$items = [];

		foreach ( $elements as $item ) {
			$item->children = [];
			$items[ (int) $item->ID ] = $item;
		}

		$top_items = [];

		foreach ( $items as $item ) {
			$parent_id = (int) $item->menu_item_parent;

			if ( $parent_id === 0 ) {
				$top_items[] = $item;
			} elseif ( isset( $items[ $parent_id ] ) ) {
				$items[ $parent_id ]->children[] = $item;
			}
		}

		$html = '<ul id="' . esc_attr( $this->menu_id_attr ) . '" class="main-menu">';

		foreach ( $top_items as $top_item ) {
			$has_children = ! empty( $top_item->children );

			$html .= '<li class="' . esc_attr( $this->get_item_classes( $top_item, [
				'menu-item',
				$has_children ? 'menu-item-has-children' : '',
			] ) ) . '">';

			$html .= $this->render_top_link( $top_item, $has_children );

			if ( $has_children ) {
				$html .= $this->render_mega_menu( $top_item );
			}

			$html .= '</li>';
		}

		$html .= '</ul>';

		return $html;
	}

	private function render_top_link( object $item, bool $has_children ) : string {
		$title = esc_html( $item->title );
		$url   = ! empty( $item->url ) ? esc_url( $item->url ) : '#';

		if ( $has_children ) {
			return '
				<div class="menu-item__link menu-item__link--button" aria-expanded="false">
					<span>' . $title . '</span>
					<svg class="menu-item__link-icon"><use xlink:href="#angle-down"></use></svg>
				</div>
			';
		}

		return '<a class="menu-item__link" href="' . $url . '">' . $title . '</a>';
	}

	private function render_mega_menu( object $top_item ) : string {
		$html  = '<div class="mega-menu" data-mega-menu>';
		$html .= '<div class="mega-menu__inner">';

		foreach ( $top_item->children as $column ) {
			$html .= $this->render_column( $column );
		}

		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	private function render_column( object $column ) : string {
		$is_advanced     = get_field( 'column_advanced', $column->ID );
		$is_column_title = get_field( 'column_title', $column->ID );

		$extra_classes = [
			'mega-menu__column',
		];

		if ( $is_advanced ) {
			$extra_classes[] = 'mega-menu__column--advanced';
		}

		$classes = $this->get_item_classes( $column, $extra_classes );

		$html  = '<div class="' . esc_attr( $classes ) . '">';

		if ( $is_column_title ) {
			$html .= $this->render_column_header( $column );
		}

		if ( ! empty( $column->children ) || ! $is_column_title ) {
			$html .= '<div class="mega-menu__column-list">';

			/**
			 * If layer 2 item is NOT column title,
			 * render it as regular menu link.
			 */
			if ( ! $is_column_title ) {
				$html .= $this->render_column_link( $column );
			}

			if ( ! empty( $column->children ) ) {
				foreach ( $column->children as $link ) {
					$html .= $this->render_column_link( $link );
				}
			}

			$html .= '</div>';
		}

		$html .= '</div>';

		return $html;
	}

	private function render_column_header( object $column ) : string {
		$subtitle = get_field( 'menu_subtitle', $column->ID );
		$icon_id  = get_field( 'menu_icon', $column->ID );

		$html = '<div class="mega-menu__column-header">';

		if ( $icon_id ) {
			$html .= '<div class="mega-menu__column-header-icon">';
			$html .= wp_get_attachment_image(
				$icon_id,
				'thumbnail',
				false,
				[
					'class' => 'icon',
				]
			);
			$html .= '</div>';
		}

		$html .= '<div class="mega-menu__column-header-data">';

		$html .= '<span class="mega-menu__column-header-title">';
		$html .= esc_html( $column->title );
		$html .= '</span>';

		if ( $subtitle ) {
			$html .= '<span class="mega-menu__column-header-subtitle">';
			$html .= esc_html( $subtitle );
			$html .= '</span>';
		}

		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	private function render_column_link( object $item ) : string {
		$url             = ! empty( $item->url ) ? esc_url( $item->url ) : '#';
		$icon_id         = get_field( 'menu_icon', $item->ID ) ?? false;
		$is_column_title = get_field( 'column_title', $item->ID ) ?? false;
		$is_advanced     = get_field( 'advanced_item', $item->ID ) ?? false;
		$uptitle         = get_field( 'menu_uptitle', $item->ID ) ?? false;
		$extra_classes   = [ 'mega-menu__column-list-item' ];

		if ( !$is_column_title && $is_advanced ) {
			$extra_classes[] = 'menu-item__advanced';
		}

		$icon_class = $icon_id ? '' : 'no-icon';

		$html  = '<div class="' . esc_attr( $this->get_item_classes( $item, $extra_classes ) ) . '">';

		$html .= '<a class="mega-menu__link" href="' . $url . '">';

		if ( !$is_column_title && $is_advanced && $uptitle ) {
			$html .= '<span class="mega-menu__link-uptitle">';
			$html .= esc_html( $uptitle );
			$html .= '</span>';
		}
		$html .= '<div class="mega-menu__link-data">';
		$html .= '<div class="mega-menu__link-icon ' . $icon_class . '">';
		if ( $icon_id ) {
			$html .= wp_get_attachment_image( $icon_id, 'thumbnail', false, [ 'class' => 'icon' ]);
		}
		$html .= '</div>';

		$html .= '<span class="mega-menu__link-text">';
		$html .= esc_html( $item->title );
		$html .= '</span>';

		$html .= '<svg class="mega-menu__link-arrow">';
		$html .= '<use xlink:href="#angle-right"></use>';
		$html .= '</svg>';
		$html .= '</div>';
		$html .= '</a>';
		$html .= '</div>';

		return $html;
	}

	private function get_item_classes( object $item, array $extra_classes = [] ) : string {
		$classes = [];

		if ( ! empty( $item->classes ) && is_array( $item->classes ) ) {
			$classes = array_filter( $item->classes );
		}

		$classes = array_merge( $classes, $extra_classes );

		return implode( ' ', array_filter( array_unique( $classes ) ) );
	}
}