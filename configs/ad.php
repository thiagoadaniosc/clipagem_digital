<?php 

define('LDAP_SERVER', 'ad.cmsj.sc.gov.br');
define('LDAP_PORT', '389');
define('LDAP_DN', 'DC=ad,DC=cmsj,DC=sc,DC=gov,DC=br');
define('LDAP_USER', ''); // Não é necessário para Login
define('LDAP_PASSWORD', ''); // Não é necessário para login
define('LDAP_LOGIN', false); // True or False, ativa autenticação com LDAP
define('LDAP_GROUP_ADMIN', 'Comunicação'); // Define grupo com privilégio de administrador