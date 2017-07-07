<?php

//判断当前浏览器是否为微信内置的浏览器
function is_weixin() {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    }
    return false;
}

/**
 * 是否为移动端访问
 *
 * @return bool
 */
function is_mobile() {

    // returns true if one of the specified mobile browsers is detected
    // 如果监测到是指定的浏览器之一则返回true
    $regex_match = "/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";

    $regex_match .= "htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";

    $regex_match .= "blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";

    $regex_match .= "symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";

    $regex_match .= "jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";

    $regex_match .= ")/i";

    // preg_match()方法功能为匹配字符，既第二个参数所含字符是否包含第一个参数所含字符，包含则返回1既true
    return preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
}

//后台菜单
function ZEN_MEUN($structures, $managements, $controller) {
    $structure = json_decode($structures, true);
    $management = json_decode($managements, true);

    //数据重组
    $ZEN_MEUN = [];
    foreach ($structure as $key => $value) {

        $ZEN_MEUN[$value['id']] = $value['id'];

        //如果有二级菜单则显示
        if (isset($management[$value['id']])) {
            foreach ($management[$value['id']] as $k => $sub) {

                if ($sub['structure_id'] == $value['id']) {
                    $value['sub'][] = $sub;
                }

                //当前页面选中状态
                if (strtoupper($sub['name']) == strtoupper($controller)) {
                    $ZEN_MEUN['bannerActive'] = $sub['structure_id'];
                }
            }

            //设置一级菜单选中状态
            $value['name'] = $management[$value['id']][0]['name'];
        }
        $ZEN_MEUN[$value['id']] = $value;
    }

    return $ZEN_MEUN;
}

//路径导航
function breadcrumb($ZEN_MEUN, $bannerActive, $listsName, $child = false) {
    $i = 1;
    $breadcrumb[0]['label'] = $ZEN_MEUN[$bannerActive]['label'];
    $breadcrumb[0]['url'] = $ZEN_MEUN[$bannerActive]['url'];
    $name = strtolower($ZEN_MEUN[$bannerActive]['name']);
    foreach ($ZEN_MEUN[$bannerActive]['sub'] as $bre => $_breadcrumb) {
        if (strtolower($_breadcrumb['name']) == strtolower($listsName)) {
            $breadcrumb[$i]['label'] = $_breadcrumb['label'];
            $breadcrumb[$i]['url'] = $_breadcrumb['url'];
            if (strtolower($_breadcrumb['name']) == $name) {
                //unset($breadcrumb[$i]);
            }
        }
        $i++;
    }
    if ($child) {
        unset($breadcrumb[0]);
    }
    return $breadcrumb;
}

//根据权限重组菜单
function get_authorized($authorized, $structures, $managements) {

    //以,分割数组
    $_temp = explode(',', $authorized);
    foreach ($_temp as $key => $val) {
        //以-分割数组
        list($stru[], $mana[]) = explode('-', $val);
    }

    $result = [];

    //根据权限重组一级菜单
    $_st = array_unique($stru);
    $_oldst = setArrayByField(json_decode($structures, true), 'id');
    unset($structures);
    foreach ($_st as $key => $str) {
        $_structures[] = $_oldst[$str];
    }
    $result['structures'] = json_encode($_structures);

    //根据权限重组二级菜单
    $_mana = array_unique($mana);
    $_oldmana = json_decode($managements, true);
    unset($managements);
    foreach ($_mana as $val) {
        foreach ($_oldmana as $maval) {
            foreach ($maval as $usb) {
                if ($usb['id'] == $val) {
                    $subMent[$usb['structure_id']][] = $usb;
                }
            }
        }
    }
    $result['managements'] = json_encode($subMent);
    return $result;
}

function get_extension($file) {
    return pathinfo($file, PATHINFO_EXTENSION);
}

// 获取某个程序当前的进程数
function get_proc_count($name) {
    $cmd = "ps -e"; //调用ps命令
    $output = shell_exec($cmd);
    $result = substr_count($output, ' ' . $name);
    return $result;
}

//截取中文标题
function getShortTitle($title, $length = 12, $stat = '') {
    return msubstr(html_entity_decode($title), 0, $length, 'utf-8', $stat);
}

//截取中文字符串
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
    $str = strip_tags($str);
    if (function_exists("iconv_substr")) {
        return iconv_substr($str, $start, $length, $charset) . $suffix;
    } elseif (function_exists('mb_substr')) {
        return mb_substr($str, $start, $length, $charset) . $suffix;
    }
    $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("", array_slice($match[0], $start, $length));
    if ($suffix) {
        return $slice . "…";
    }
    return $slice;
}

//https请求,支持GET和POST
function https_request($url, $data = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);

    //将获取的信息以文件流的形式返回
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    if (!empty($data)) {
        //模拟POST请求
        curl_setopt($ch, CURLOPT_POST, 1);

        //POST内容
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    $outopt = curl_exec($ch);
    curl_close($ch);
    return json_decode($outopt, true);
}

//curl模拟post 数据
function curl_post($url, $post = array()) {
    $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $post,
    );

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

/**
 * 通过curl方式获取url地址的html内容
 * $url 目标网站
 * return string 返回HTML内容
 */
function getHtmlByCurl($url) {
    // curl 初始化
    $ch = curl_init();

    // 需要抓取的页面路径
    curl_setopt($ch, CURLOPT_URL, $url);

    // 伪造火狐浏览器
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    // 将获取的信息以文件流的形式返回，而不是直接输出
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // 超时时间
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    // 伪造ip
    curl_setopt($ch, CURLOPT_PROXY, C('CURL_AGENT_IP'));

    // 抓取的内容放在变量中
    $file_contents = curl_exec($ch);
    $curl_info = curl_getinfo($ch);

    // 状态码
    $http_code = $curl_info['http_code'];

    // 关闭 curl 资源
    curl_close($ch);
    if ($http_code == '200') {
        return $file_contents;
    } else {
        return '';
    }
}

/*
 * getValueByField
 * 获取数组字段值
 * @param array $array 数组 默认为 array()
 * @param string $field 字段名 默认为id
 *
 * @return array $result 数组(各字段值)
 *
 */
function getValueByField($array = array(), $field = 'id') {
    $result = array();
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $result[] = $value[$field];
        }
    }
    return $result;
}

//读取配置
function C($key) {
    return Configure::read($key);
}

/*
 * setArrayByField
 * 根据字段重组数组
 * @param array $array 数组 默认为 array()
 * @param string $field 字段名 默认为id
 *
 * @return array $result 重组好的数组
 *
 */
function setArrayByField($array = array(), $field = 'id') {
    $result = array();
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $result[$value[$field]] = $value;
        }
    }
    return $result;
}

/*
 * 获取某个时间段里的工作日
 * @param int $time 时间戳
 * @param int $days 天数
 */
function afterWorkingDay($time, $days) {
    $count = 0;

    //2016年法定节假日
    $legal_holidays = C('LEGAL_HOLIDAYS');
    $legal_workdays = C('LEGAL_WORKDAYS');

    while (intval($count) < $days) {
        $week = date('w', $time + (24 * 3600));
        if (in_array(C('LEGAL_WORKDAYS')) || ($week != 6 && $week != 0 && !in_array(date('Ymd', $time + (24 * 3600)), C('LEGAL_HOLIDAYS')))) {
            // if ($week != 6 && $week != 0 && !in_array(date('Ymd', $time + (24 * 3600)), $legal_holidays)) {
            $count++;
        }
        $time = $time + (24 * 3600);
    }
    return $time;
}

/**
 * 文件下载
 * @param $filepath 文件路径
 * @param $filename 文件名称
 */

function file_down($filepath, $filename = '') {
    if (!$filename) {
        $filename = basename($filepath);
    }

    if (is_ie()) {
        $filename = rawurlencode($filename);
    }

    $filetype = fileext($filename);
    $filesize = sprintf("%u", filesize($filepath));
    if (ob_get_length() !== false) {
        @ob_end_clean();
    }

    header('Pragma: public');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: pre-check=0, post-check=0, max-age=0');
    header('Content-Transfer-Encoding: binary');
    header('Content-Encoding: none');
    header('Content-type: ' . $filetype);
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-length: ' . $filesize);
    readfile($filepath);
    exit;
}

/*
 * download
 * 下载
 * @param string $filePath 文件相对路径 例: /Uploads/test/
 * @param string $fileName 下载文件名称 例: uploads
 * @param string $ext  文件后缀名 例: rar
 *
 */
function download($filePath, $fileName, $ext, $flag = true) {
    if ($flag) {
        $filePath = $filePath . $fileName . '.' . $ext;
    }
    $filesize = filesize($filePath);
    $downloadType = C('DOWNLOAD_TYPE');
    $type = $downloadType[$ext] ? $downloadType[$ext] : 'octet-stream';
    // fopen读取文件，重新输出
    if ($handle = fopen($filePath, "r")) {

        Header("Content-type:text/html;charset=utf8");
        Header("Content-type: application/" . $type);
        Header("Accept-Ranges: bytes");
        Header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        Header("Pragma: public");
        Header("Content-Length: " . $filesize);
        Header("Content-Disposition: attachment; filename=" . $fileName . '.' . $ext);
        readfile($filePath);
        fclose($handle);
        clearstatcache();
        exit();
    } else {
        Header('Location: http://' . $_SERVER['HTTP_HOST']);
    }
}

//汉字转拼音
function pinyin($_String, $_Code = 'gb2312') {
    $_DataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha" .
        "|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|" .
        "cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er" .
        "|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui" .
        "|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang" .
        "|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang" .
        "|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue" .
        "|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne" .
        "|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen" .
        "|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang" .
        "|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|" .
        "she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|" .
        "tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu" .
        "|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you" .
        "|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|" .
        "zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";

    $_DataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990" .
        "|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725" .
        "|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263" .
        "|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003" .
        "|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697" .
        "|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211" .
        "|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922" .
        "|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468" .
        "|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664" .
        "|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407" .
        "|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959" .
        "|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652" .
        "|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369" .
        "|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128" .
        "|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914" .
        "|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645" .
        "|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149" .
        "|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087" .
        "|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658" .
        "|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340" .
        "|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888" .
        "|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585" .
        "|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847" .
        "|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055" .
        "|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780" .
        "|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274" .
        "|-10270|-10262|-10260|-10256|-10254";

    $_TDataKey = explode('|', $_DataKey);
    $_TDataValue = explode('|', $_DataValue);
    $_Data = (PHP_VERSION >= '5.0') ? array_combine($_TDataKey, $_TDataValue) : _Array_Combine($_TDataKey, $_TDataValue);

    arsort($_Data);
    reset($_Data);

    if ($_Code != 'gb2312') {
        $_String = _U2_Utf8_Gb($_String);
    }
    $_Res = '';
    for ($i = 0; $i < strlen($_String); $i++) {
        $_P = ord(substr($_String, $i, 1));
        if ($_P > 160) {
            $_Q = ord(substr($_String, ++$i, 1));
            $_P = $_P * 256 + $_Q - 65536;
        }
        $_Res .= _Pinyin($_P, $_Data);
    }

    return preg_replace("/[^a-z0-9]*/", '', $_Res);
}

//汉字转拼音
function _Pinyin($_Num, $_Data) {
    if ($_Num > 0 && $_Num < 160) {
        return chr($_Num);
    } elseif ($_Num < -20319 || $_Num > -10247) {
        return '';
    } else {
        foreach ($_Data as $k => $v) {
            if ($v <= $_Num) {
                break;
            }
        }
        return $k;
    }
}

function _U2_Utf8_Gb($_C) {
    $_String = '';
    if ($_C < 0x80) {
        $_String .= $_C;
    } elseif ($_C < 0x800) {
        $_String .= chr(0xC0 | $_C >> 6);
        $_String .= chr(0x80 | $_C & 0x3F);
    } elseif ($_C < 0x10000) {
        $_String .= chr(0xE0 | $_C >> 12);
        $_String .= chr(0x80 | $_C >> 6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    } elseif ($_C < 0x200000) {
        $_String .= chr(0xF0 | $_C >> 18);
        $_String .= chr(0x80 | $_C >> 12 & 0x3F);
        $_String .= chr(0x80 | $_C >> 6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    }
    return iconv('UTF-8', 'GBK', $_String);
}

function _Array_Combine($_Arr1, $_Arr2) {
    for ($i = 0; $i < count($_Arr1); $i++) {
        $_Res[$_Arr1[$i]] = $_Arr2[$i];
    }
    return $_Res;
}

//获取封面图
function getCover($data) {
    $path = substr($data['art_cover_path'] . DS . 'thumbnail-' . $data['art_cover'], 7);
    if (file_exists('.' . $path)) {
        $result = $path;
    } else {
        $result = '/img/default.png';
    }
    return $result;
}

/**
 * 时间格式化
 * 格式如：yyyy-MM-dd HH:mm:ss
 */
function fromDate($datetime, $from = 'yyyy-MM-dd') {
    // use Cake\I18n\Time;
    class_alias('Cake\I18n\Time', 'Time');
    $now = Time::parse($datetime);
    return $now->i18nFormat($from);
}

/**
 * 生成随机字符串
 * @param string $lenth 长度
 * @return string 字符串
 */
function create_randomstr($lenth = 6) {
    return random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
}

//发送短信
function sendSMS($data) {

    //整理数据
    $mobile = $data['mobile'];
    $verify = $data['verify'];

    //引入阿里大于SDK，并实例化
    require_once ROOT . DS . 'vendor' . DS . "alidayu-sdk" . DS . "TopSdk.php";
    $c = new TopClient;

    //请填写自己的app key
    $c->appkey = "23446879";

    //请填写自己的app secret
    $c->secretKey = "2cda01a03c4fc50fcf86088a80715a2f";

    $req = new AlibabaAliqinFcSmsNumSendRequest;

    //公共回传参数
    $req->setExtend("123456");

    //短信类型，传入值请填写normal
    $req->setSmsType("normal");

    //短信签名，传入的短信签名必须是在阿里大于“管理中心-短信签名管理”中的可用签名。
    $req->setSmsFreeSignName("销保网");

    /** 短信模板变量，传参规则{"key":"value"}，
     * key的名字须和申请模板中的变量名一致，多个变量之间以逗号隔开。
     *示例：
     *
     *针对模板“验证码${code}，您正在进行${product}身份验证，打死不要告诉别人哦！”，
     *
     *传参时需传入{"code":"1234","product":"alidayu"}
     */
    // $req->setSmsParam("{\"code\":\"1234\",\"product\":\"alidayu\"}");
    $req->setSmsParam("{\"verify\": \"$verify\"}");

    //请填写需要接收的手机号码
    // $req->setRecNum('13693640316');
    $req->setRecNum("$mobile");

    //短信模板id
    // $req->setSmsTemplateCode("SMS_585014");
    $req->setSmsTemplateCode("SMS_14266852");

    $resp = $c->execute($req);
    pr($resp);

}

//递归创建目录
function mkpath($path) {
    // Make the slashes are all single and lean the right way
    $path = preg_replace('/(\/){2,}|(\\\){1,}/', '/', $path);

    // Make an array of all the directories in path
    $dirs = explode("/", $path);

    // Verify that each directory in path exist. Create it if it doesn't
    $path = "";
    foreach ($dirs as $element) {
        $path .= $element . "/";
        if (!is_dir($path)) { // Directory verified here
            mkdir($path); // Created if it doesn't exist
        }
    }
}

//获取微信公众号文章内容
function wechat($target) {
    require_once ROOT . DS . 'vendor' . DS . "Wechat.php";

    $path = './files' . DS . 'Articles' . DS . 'weixin' . DS . date('Y') . DS . date('md');
    $res = new Wechat($target, $path);

    // $tmp = $res->fetch();
    // var_dump($res);exit();
    return $res->fetch();
}

//自动提取第一张图片为缩略图
function autoThumb($str) {
    $res = [];
    // $content = strip_tags($str, "");
    $content = stripslashes($str);
    //提取不包含指定网址的图片地址
    // preg_match('#<img src="(?!http:\/\/mmbiz.qpic.cn)([^"]+)"#', $content, $matches);
    preg_match_all("/src=([\"|']?)([^ \"'>]+\.(jpg|jpeg|bmp|png))/isU", $content, $matches);

    $_savePath = 'files' . DS . 'Articles' . DS . 'art_cover' . DS . date('Y') . DS . date('md');
    $path = WWW_ROOT . $_savePath;
    mkpath($path);
    $name = time();
    // var_dump($matches[2]);exit;
    if (empty($matches[2])) {
        $res['path'] = '';
        $res['name'] = '';
        return ($res);exit;
    }

    $info = getimagesize(WWW_ROOT . $matches[2][0]);
    $type = str_replace('image/', '', $info['mime']);
    $fileName = $path . DIRECTORY_SEPARATOR . 'thumbnail-' . $name . ".$type";

    $url = WWW_ROOT . $matches[2][0];
    img2thumb($url, $fileName);
    $res['path'] = 'webroot' . DS . $_savePath;
    $res['name'] = $name . ".$type";
    return ($res);
}

/**
 * 生成缩略图
 * @author yangzhiguo0903@163.com
 * @param string     源图绝对完整地址{带文件名及后缀名}
 * @param string     目标图绝对完整地址{带文件名及后缀名}
 * @param int        缩略图宽{0:此时目标高度不能为0，目标宽度为源图宽*(目标高度/源图高)}
 * @param int        缩略图高{0:此时目标宽度不能为0，目标高度为源图高*(目标宽度/源图宽)}
 * @param int        是否裁切{宽,高必须非0}
 * @param int/float  缩放{0:不缩放, 0<this<1:缩放到相应比例(此时宽高限制和裁切均失效)}
 * @return boolean
 */
function img2thumb($src_img, $dst_img, $width = 150, $height = 0, $cut = 0, $proportion = 0) {
    if (!is_file($src_img)) {
        return false;
    }

    $ot = fileext($dst_img);
    $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
    $srcinfo = getimagesize($src_img);
    $src_w = $srcinfo[0];
    $src_h = $srcinfo[1];
    $type = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
    $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

    $dst_h = $height;
    $dst_w = $width;
    $x = $y = 0;

    /**
     * 缩略图不超过源图尺寸（前提是宽或高只有一个）
     */
    if (($width > $src_w && $height > $src_h) || ($height > $src_h && $width == 0) || ($width > $src_w && $height == 0)) {
        $proportion = 1;
    }
    if ($width > $src_w) {
        $dst_w = $width = $src_w;
    }
    if ($height > $src_h) {
        $dst_h = $height = $src_h;
    }

    if (!$width && !$height && !$proportion) {
        return false;
    }
    if (!$proportion) {
        if ($cut == 0) {
            if ($dst_w && $dst_h) {
                if ($dst_w / $src_w > $dst_h / $src_h) {
                    $dst_w = $src_w * ($dst_h / $src_h);
                    $x = 0 - ($dst_w - $width) / 2;
                } else {
                    $dst_h = $src_h * ($dst_w / $src_w);
                    $y = 0 - ($dst_h - $height) / 2;
                }
            } else if ($dst_w xor $dst_h) {
                if ($dst_w && !$dst_h) {
                    //有宽无高
                    $propor = $dst_w / $src_w;
                    $height = $dst_h = $src_h * $propor;
                } else if (!$dst_w && $dst_h) {
                    //有高无宽
                    $propor = $dst_h / $src_h;
                    $width = $dst_w = $src_w * $propor;
                }
            }
        } else {
            //裁剪时无高
            if (!$dst_h) {
                $height = $dst_h = $dst_w;
            }
            //裁剪时无宽
            if (!$dst_w) {
                $width = $dst_w = $dst_h;
            }
            $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
            $dst_w = (int) round($src_w * $propor);
            $dst_h = (int) round($src_h * $propor);
            $x = ($width - $dst_w) / 2;
            $y = ($height - $dst_h) / 2;
        }
    } else {
        $proportion = min($proportion, 1);
        $height = $dst_h = $src_h * $proportion;
        $width = $dst_w = $src_w * $proportion;
    }

    $src = $createfun($src_img);
    $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);

    if (function_exists('imagecopyresampled')) {
        imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    } else {
        imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    $otfunc($dst, $dst_img);
    imagedestroy($dst);
    imagedestroy($src);
    return true;
}

function fileext($file) {
    return pathinfo($file, PATHINFO_EXTENSION);
}

//删除特殊符号
function delete_special_mark($str) {
    //去除字符串 首尾 空白等特殊符号或指定字符序列
    $str = trim($str);

    //去掉 HTML、XML 以及 PHP 的标签
    $str = strip_tags($str, "");

    //去掉TAB切换产生的符号
    $str = ereg_replace("\t", "", $str);

    //去掉换行 通常是两个enter造成
    $str = ereg_replace("\r\n", "", $str);

    //去掉enter换行
    $str = ereg_replace("\r", "", $str);

    //去掉换行
    $str = ereg_replace("\n", "", $str);

    //去掉|
    // $str = str_replace("|", "", $str);

    //去掉空白
    $str = ereg_replace(" ", " ", $str);

    //处理从数据库或 HTML 表单中取回数据包含的特殊符号
    $str = stripslashes($str);

    //删除bom标记
    $str = preg_replace('/^(\xef\xbb\xbf)/', '', $str);

    return $str;
}

function parse_array($string, $beg_tag, $close_tag) {
    preg_match_all("($beg_tag(.*)$close_tag)siU", $string, $matching_data);
    return $matching_data[0];
}

function remove($string, $open_tag, $close_tag) {
    # Get array of things that should be removed from the input string
    $remove_array = parse_array($string, $open_tag, $close_tag);

    # Remove each occurrence of each array element from string;
    for ($xx = 0; $xx < count($remove_array); $xx++) {
        $string = str_replace($remove_array, "", $string);
    }

    return $string;
}

//从文章内容中保存远程图片
function saveRemoteImages($body) {

    require_once ROOT . DS . 'vendor' . DS . "autoload.php";
    // use MajaLin\Webbot\Parse as MS_Parse;
    // class_alias('MajaLin\Webbot', 'Parse');
    $parse = new Parse();

    $img_tag_array = $parse->parse_array($body, "<img", ">");

    if (count($img_tag_array) == 0) {
        return $body;
        exit;
    }

    var_dump($img_tag_array);exit;
}

/**
 * 拉取远程图片
 * @return mixed
 */
function saveRemote($body) {
    $imgUrl = htmlspecialchars($body);
    $imgUrl = str_replace("&amp;", "&", $imgUrl);

    //http开头验证
    if (strpos($imgUrl, "http") !== 0) {
        $this->stateInfo = $this->getStateInfo("ERROR_HTTP_LINK");
        return;
    }
    //获取请求头并检测死链
    $heads = get_headers($imgUrl);
    if (!(stristr($heads[0], "200") && stristr($heads[0], "OK"))) {
        $this->stateInfo = $this->getStateInfo("ERROR_DEAD_LINK");
        return;
    }
    //格式验证(扩展名验证和Content-Type验证)
    $fileType = strtolower(strrchr($imgUrl, '.'));
    if (!in_array($fileType, $this->config['allowFiles']) || stristr($heads['Content-Type'], "image")) {
        $this->stateInfo = $this->getStateInfo("ERROR_HTTP_CONTENTTYPE");
        return;
    }

    //打开输出缓冲区并获取远程图片
    ob_start();
    $context = stream_context_create(
        array('http' => array(
            'follow_location' => false, // don't follow redirects
        ))
    );
    readfile($imgUrl, false, $context);
    $img = ob_get_contents();
    ob_end_clean();
    preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/", $imgUrl, $m);

    $this->oriName = $m ? $m[1] : "";
    $this->fileSize = strlen($img);
    $this->fileType = $this->getFileExt();
    $this->fullName = $this->getFullName();
    $this->filePath = $this->getFilePath();
    $this->fileName = $this->getFileName();
    $dirname = dirname($this->filePath);

    //检查文件大小是否超出限制
    if (!$this->checkSize()) {
        $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
        return;
    }

    //创建目录失败
    if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
        $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
        return;
    } else if (!is_writeable($dirname)) {
        $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
        return;
    }

    //移动文件
    if (!(file_put_contents($this->filePath, $img) && file_exists($this->filePath))) {
        //移动失败
        $this->stateInfo = $this->getStateInfo("ERROR_WRITE_CONTENT");
    } else {
        //移动成功
        $this->stateInfo = $this->stateMap[0];
    }
}

//试题类型
function getSubjectType($id = 0) {
    $arr = [
        0 => '',
        1 => '单选题',
        2 => '多选题',
        3 => '判断题',
    ];
    return $arr[intval($id)];exit;
}
