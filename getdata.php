<?php
/**
* Plugin Name: User Data
* Plugin URI: https://github.com/BRdhanani/gutenberg-call-to-action
* Author: Brijesh Dhanani
* Version: 1.0.0
* License: GPL2+
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
* Description: Custom Call to Action Gutenberg Block
*/

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue the block's assets for the editor.
 *
 * wp-blocks:  The registerBlockType() function to register blocks.
 * wp-element: The wp.element.createElement() function to create elements.
 *
 * @since 1.0.0
 */

function userdata_scripts() {
    wp_enqueue_style('bootstrap', plugins_url('/css/bootstrap.min.css', __FILE__));
    wp_enqueue_script('js', plugins_url('/js/general.js', __FILE__), array(), '', true);
}
add_action( 'wp_enqueue_scripts', 'userdata_scripts' );

add_action( 'pre_get_posts', function ($query ){
    global $wp;

    if ( !is_admin() && $query->is_main_query() ) {
        if ($wp->request == 'users'){
            wp_head();
            $data = wp_remote_get( 'https://jsonplaceholder.typicode.com/users' );
            $users = json_decode($data['body']);
            echo '<div class="container">
                    <table id="board" class="table table-striped" >
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Website</th>
                        </tr>';
                        foreach ($users as $user) {
                            echo '<tr>
                                    <td>
                                        <a href="javascript:void(0)" onclick="doPostBack('.$user->id.')">'.$user->id.'</a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="doPostBack('.$user->id.')">'.$user->name.'</a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="doPostBack('.$user->id.')">'.$user->username.'</a>
                                    </td>
                                    <td>
                                        '.$user->email.'
                                    </td>
                                    <td>
                                        '.$user->phone.'
                                    </td>
                                    <td>
                                        '.$user->website.'
                                    </td>
                                </tr>';
                        }
            echo    '</table>
                    <div id="result">
                    </div>
                </div>';
            wp_footer();
            exit;
        }
    }
});
?>