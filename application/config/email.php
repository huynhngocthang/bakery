<?php if (!defined("BASEPATH")) {
	exit("No direct script access allowed");
}

$config["protocol"] = "smtp";
$config["smtp_host"] = "ssl://smtp.yandex.com";
$config["smtp_port"] = "465";
$config["smtp_timeout"] = "300";
$config["smtp_user"] = "no-reply@bpotech.comm.vn";
$config["smtp_pass"] = "BPOTech@1506";
$config["charset"] = "utf-8";
$config["newline"] = "\r\n";
$config["mailtype"] = "html";
