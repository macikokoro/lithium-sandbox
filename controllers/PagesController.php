<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;

/**
 * This controller is used for serving static pages by name, which are located in the `/views/pages`
 * folder.
 *
 * A Lithium application's default routing provides for automatically routing and rendering
 * static pages using this controller. The default route (`/`) will render the `home` template, as
 * specified in the `view()` action.
 *
 * Additionally, any other static templates in `/views/pages` can be called by name in the URL. For
 * example, browsing to `/pages/about` will render `/views/pages/about.html.php`, if it exists.
 *
 * Templates can be nested within directories as well, which will automatically be accounted for.
 * For example, browsing to `/pages/about/company` will render
 * `/views/pages/about/company.html.php`.
 */
class PagesController extends \lithium\action\Controller {
	
	/**
	 * Basic static pages.
	 * 
	 * @return
	*/
	public function view() {
		$path = func_get_args() ?: array('home');
		return $this->render(array('template' => join('/', $path)));
	}
	
	/**
	 * Admin static pages. Protected - only administrator users can see these.
	 * 
	*/
	public function admin_view() {
		$this->_render['layout'] = 'admin';
		
		$path = func_get_args() ?: array('home');
		// Always prefix the last item in the path with admin_
		$last_piece = end($path);
		$last_piece = (substr($last_piece, 0, 6) != 'admin_') ? 'admin_' . $last_piece:$last_piece;
		$last_key = (count($path) - 1);
		$path[$last_key] = $last_piece;
		return $this->render(array('template' => join('/', $path)));
	}
	
}
?>