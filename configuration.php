<?php
class JConfig {
	public $offline = '0';
	public $offline_message = 'Trang web này đang được bảo trì.</br>Xin quay trở lại sau. ';
	public $display_offline_message = '1';
	public $offline_image = '';
	public $sitename = 'Tri learning';
	public $editor = 'tinymce';
	public $captcha = '0';
	public $list_limit = '10';
	public $access = '1';
	public $debug = '0';
	public $debug_lang = '0';
	public $dbtype = 'mysqli';

	public $user = 'root';

	public $host = 'localhost';
	public $password = '';
	public $db = 'cbccvc_v2_2503';
//  	public $host = '10.49.45.51';
//  	public $password = '123456';
//  	public $db = 'cbcc_code';
	

	public $dbprefix = 'jos_';
	public $live_site = '';
	public $secret = 'UPhHpEuT0TtQxsav';
	public $gzip = '1';
	public $error_reporting = 'default';
	public $helpurl = 'http://help.joomla.org/proxy/index.php?option=com_help&keyref=Help{major}{minor}:{keyref}';
	public $ftp_host = '';
	public $ftp_port = '';
	public $ftp_user = '';
	public $ftp_pass = '';
	public $ftp_root = '';
	public $ftp_enable = '0';
	public $offset = 'UTC';
	public $mailer = 'mail';
	public $mailfrom = 'phucnh.dn.vn@gmail.com';
	public $fromname = 'Tri learning';
	public $sendmail = '/usr/sbin/sendmail';
	public $smtpauth = '0';
	public $smtpuser = '';
	public $smtppass = '';
	public $smtphost = 'localhost';
	public $smtpsecure = 'none';
	public $smtpport = '25';
	public $caching = '0';
	public $cache_handler = 'file';
	public $cachetime = '600';
	public $MetaDesc = '';
	public $MetaKeys = '';
	public $MetaTitle = '1';
	public $MetaAuthor = '1';
	public $MetaVersion = '1';
	public $robots = '';
	public $sef = '1';
	public $sef_rewrite = '0';
	public $sef_suffix = '0';
	public $unicodeslugs = '0';
	public $feed_limit = '10';
	public $log_path = 'E:\\PHP\\cbcc_snv\\logs';
	public $tmp_path = 'E:\\PHP\\cbcc_snv\\tmp';
	public $lifetime = '600';
	public $session_handler = 'database';
	public $MetaRights = '';
	public $sitename_pagetitles = '0';
	public $force_ssl = '0';
	public $feed_email = 'author';
	public $cookie_domain = '';
	public $cookie_path = '';
	public $mailonline = '1';
	public $frontediting = '1';
	public $asset_id = '1';
}