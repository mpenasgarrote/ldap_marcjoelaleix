<?php
$ldap_host = 'pateratore.org';
$ldap_port = 389;
$ldap_base_dn = 'dc=pateratore,dc=org';
$ldap_user_suffix = '@pateratore.org';
$ldap_group_dn = 'cn=group500,dc=pateratore,dc=org';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = htmlspecialchars($_POST['login__username']);
    $password = htmlspecialchars($_POST['login__password']);

    $ldap_conn = ldap_connect($ldap_host, $ldap_port);

    if ($ldap_conn) {
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

        $ldap_bind = ldap_bind($ldap_conn, $user, $password);

        if ($ldap_bind) {
            $is_in_group_500 = ldap_search($ldap_conn, $ldap_group_dn, "(member=cn=$user,$ldap_base_dn)");
            if ($is_in_group_500) {
                header('Location: pagicm/zonaClients.html');
                exit();
            } else {
                header('Location: pagicm/zonaPrivada.html');
                exit();
            }
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Failed to connect to LDAP server.";
    }

    if ($ldap_conn) {
        ldap_close($ldap_conn);
    }
}
?>
