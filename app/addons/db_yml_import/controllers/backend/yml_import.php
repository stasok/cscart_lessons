<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

use Tygh\Registry;
use Tygh\YImport\Import;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD']	== 'POST') {

    if ($mode == 'import') {

        $file = fn_filter_uploaded_data('yml_file');
        $price_type = 'RRP';

        if (!empty($file)) {

            $path = $file[0]['path'];
            $import = new Import($path, $price_type);
            $import->run();

        } else {
            fn_set_notification('E', __('error'), __('error_exim_no_file_uploaded'));
        }

        $suffix = ".manage";
    }

    if ($mode == 'save') {

        $urls = $_REQUEST['import_data']['urls'];

        foreach($urls as $url) {
            $url_id = fn_db_yml_import_update_url($url);
            $url_ids[] = $url_id;
        }

        $original_url_ids = $_REQUEST['import_data']['original_url_ids'];

        if (!empty($original_url_ids)) {
            $original_url_ids = explode(',', $original_url_ids);
            $deleted_urls = array_diff($original_url_ids, $url_ids);

            fn_db_yml_import_delete_urls($deleted_urls);
        }

        $suffix = ".manage";
    }


    return array(CONTROLLER_STATUS_OK, "yml_import$suffix");
}


if ($mode == 'manage') {


    Registry::set('navigation.tabs', array (
        'general' => array (
            'title' => __('general'),
            'js' => true
        ),
    ));

    Registry::get('view')->assign('yml', 1);

    $urls = fn_db_yml_import_get_urls();

    Registry::get('view')->assign('urls', $urls);
}
