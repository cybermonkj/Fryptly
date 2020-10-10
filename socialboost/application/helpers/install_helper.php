<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('setup_install')) {
    /**
     * @param [type] $purchase_code
     * @param [type] $host
     * @param [type] $db_user
     * @param [type] $db_password
     * @param [type] $db_name
     * @param [type] $name
     * @param [type] $username
     * @param [type] $email
     * @param [type] $password
     * @param [type] $timezone
     * @return void
     */
    function setup_install($purchase_code, $host, $db_user, $db_password, $db_name, $name, $username, $email, $password, $timezone)
    {
        $ci = &get_instance();

        $ci->load->model('setup_model');

        // Connection MYSQL
        $config['hostname'] = $host;
        $config['username'] = $db_user;
        $config['password'] = $db_password;
        $config['database'] = $db_name;
        $config['dbdriver'] = 'mysqli';

        $ci->load->database($config);
        $error_db = $ci->db->error();

        if ($error_db['code'] != 0) {
            json([
                'csrf' => $ci->security->get_csrf_hash(),
                'type' => 'error',
                'message' => 'Host data for installation is incorrect.',
            ]);
        }

        // Installation
        $curl = api_connect("https://esjdev.com/api/license/v2/install?code=" . $purchase_code, '', true, true);

        if (!isset($curl['error'])) {
            $success = encrypt_decrypt($purchase_code, base_url(), $curl['success']);
            $output_file_install = 'install.sql';

            if (!is_file($output_file_install)) {
                file_put_contents($output_file_install, $success);
            }

            $database = file_get_contents($output_file_install);

            $sql = explode(';', $database);
            foreach ($sql as $sqls) {
                $statement = $sqls . ";";
                $ci->setup_model->createTable($statement);
            }

            unlink($output_file_install); // Excluding install.sql after installation

            $ci->model->insert(TABLE_USERS, [
                'uuid' => uuid(),
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'timezone' => $timezone,
                'balance' => 0,
                'role' => 'ADMIN',
                'api_key' => create_random_api_key(""),
                'activation_token' => 0,
                'custom_rate' => 0,
                'status' => 'Active',
                'created_at' => NOW,
            ]);

            $ci->model->insert('purchase_code', [
                'purchase_code' => $purchase_code,
                'version' => '1.0.0.0',
                'created_at' => NOW,
                'updated_at' => NOW
            ]);
            change_config('mysqli', $host, $db_user, $db_password, $db_name, $timezone);

            $protocolo = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' || $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $url = $protocolo . '://' . $host;

            json([
                'csrf' => $ci->security->get_csrf_hash(),
                'type' => 'success',
                'title' => lang("installed_success"),
                'html' => lang("redirect_install"),
                'language' => "Installing ...",
                'base_url' => $url,
            ]);
        } else {
            json([
                'csrf' => $ci->security->get_csrf_hash(),
                'type' => 'error',
                'message' => $curl['error'],
            ]);
        }
    }
}

if (!function_exists('update_boostpanel')) {
    /**
     * @return void
     */
    function update_boostpanel()
    {
        $ci = &get_instance();
        $output_filename = 'update_boostpanel.zip';

        $purchase = $ci->model->get('*', 'purchase_code', '', '', '', true);
        $curl = api_connect('https://esjdev.com/api/license/v2/update?code=' . $purchase['purchase_code'], '', true);

        if (isset($curl['error'])) {
            json([
                'type' => 'error',
                'message' => $curl['error'],
            ]);
        }

        $version_boostpanel_extern = api_connect('https://esjdev.com/api/tmp/boostpanel/version_boostpanel.txt');

        if ($version_boostpanel_extern == $purchase['version']) {
            json([
                'type' => 'error',
                'message' => lang("error_already_updated"),
            ]);
        }

        curl_download('https://esjdev.com/api/license/v2/update?code=' . $purchase['purchase_code'], $output_filename);

        $zip = new ZipArchive;
        if ($zip->open($output_filename) === TRUE) {
            $zip->extractTo("./");
            $zip->close();

            unlink('update_boostpanel.zip');

            if (file_exists('database.sql')) {
                $file = file_read('database.sql');

                $sql = explode(';', $file);
                foreach ($sql as $sqls) {
                    $statement = $sqls . ";";
                    $this->model->query($statement);
                }

                unlink('database.sql');
            }

            $ci->model->update('purchase_code', ['purchase_code' => $purchase['purchase_code']], ['version' => $version_boostpanel_extern]);

            json([
                'type' => 'success',
                'message' => lang("success_updated_successfully"),
            ]);
        }
    }
}

if (!function_exists('verify_update_boostpanel')) {
    /**
     * @return void
     */
    function verify_update_boostpanel()
    {
        $ci = &get_instance();
        $version_boostpanel_extern = api_connect('https://esjdev.com/api/tmp/boostpanel/version_boostpanel.txt');

        $purchase = $ci->model->get('*', 'purchase_code', '', '', '', true);

        if ($version_boostpanel_extern != $purchase['version']) {
            return true;
        } else {
            return false;
        }
    }
}
