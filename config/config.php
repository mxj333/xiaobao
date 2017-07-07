<?php
//ADDS CONFIGURE TO ALL VIEWS
class_alias('Cake\Core\Configure', 'Configure');

//LOAD PLUGINS
// CakePlugin::load('DebugKit');

$config = include CACHE . '~config.php';

foreach ($config as $key => $value) {
    Configure::write($key, $value);
}

//2016年法定节假日
$legal_holidays = array('20160101', '20160207', '20160208', '20160209', '20160210', '20160211', '20160212', '20160213', '20160404', '20160501', '20160502', '20160609', '20160610', '20160611', '20160915', '20160916', '20160917', '20161001', '20161002', '20161003', '20161004', '20161005', '20161006', '20161007');
//工作日
$legal_workdays = array('20160918', '20161008', '20161009');

Configure::write('LEGAL_HOLIDAYS', $legal_holidays);
Configure::write('LEGAL_WORKDAYS', $legal_workdays);
// //CUSTOM VALUES
// Configure::write('BASE_URL', '');
// Configure::write('site_title', '鉴定钱币微拍');
// Configure::write('sub_title', '北京德泉缘古钱币艺术品鉴定有限公司');
// Configure::write('metadescription', '北京德泉缘古钱币艺术品鉴定有限公司');
// Configure::write('metakeywords', '北京德泉缘古钱币艺术品鉴定有限公司');
// Configure::write('contact_email', 'admin@admin.com');
// Configure::write('theme', 'default');

// define("EXCL", true);
// define("INCL", false);
// # Specifies if parse returns the text before or after the delineator
// define("BEFORE", true);
// define("AFTER", false);
include 'functions.php';
include 'version.php';
