<?php
$ACAIVIPPRO = new ACAIVIPPRO;

function error_alert($text)
{
    return '<div name="login_error" class="alert alert-danger" id="login_error" style="">' . $text . '</div>';
}
function success_alert($text)
{
    return '<div name="login_success" class="alert alert-success" id="login_success" style="">' . $text . '</div>';
}
function admin_error($text)
{
    return die('<div class="alert alert-danger fade in alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Error!</strong> ' . $text . '!
</div>');
}
function role($text)
{
    if ($text == '0') {
        $status = '<button type="button" class="btn btn-danger waves-effect">NO</button>';
    } else {
        $status = '<button type="button" class="btn btn-success waves-effect">YES</button>';
    }
    return $status;
}
function admin_success($text)
{
    return die('<div class="alert alert-success fade in alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Success!</strong> ' . $text . '
</div>');
}
function format_date($time)
{
    return date("H:i:s d/m/Y", $time);
}
function redirect($url)
{
    header("Location: {$url}");
    exit();
}
function RemoveCredits($user_id, $amount, $reason)
{
    global $ACAIVIPPRO;
    $ACAIVIPPRO->insert("dongtien", array(
        'sotientruoc' => getUser($user_id, 'coin'),
        'sotienthaydoi' => $amount,
        'sotiensau' => getUser($user_id, 'coin') + $amount,
        'thoigian' => gettime(),
        'noidung' => $reason,
        'user_id' => $user_id
    ));
    $isRemove = $ACAIVIPPRO->tru("user", "coin", $amount, " `id` = '$user_id' ");
    $ACAIVIPPRO->tru("user", "total_coin", $amount, " `id` = '$user_id' ");
    if ($isRemove) {
        return true;
    } else {
        return false;
    }
}
function PlusCredits($user_id, $amount, $reason)
{
    global $ACAIVIPPRO;
    $ACAIVIPPRO->insert("dongtien", array(
        'sotientruoc' => getUser($user_id, 'coin'),
        'sotienthaydoi' => $amount,
        'sotiensau' => getUser($user_id, 'coin') + $amount,
        'thoigian' => gettime(),
        'noidung' => $reason,
        'user_id' => $user_id
    ));
    $isRemove = $ACAIVIPPRO->cong("user", "coin", $amount, " `id` = '$user_id' ");
    $ACAIVIPPRO->cong("user", "total_coin", $amount, " `id` = '$user_id' ");
    if ($isRemove) {
        return true;
    } else {
        return false;
    }
}
function upload_imgur($client_id, $images)
{
    $header = array('Authorization: Client-ID ' . $client_id);
    $data = array('image' => base64_encode($images));
    return CURL("https://api.imgur.com/3/image",$header,$data);
}
function CURL($action, $header, $data)
{
    $curl = curl_init();
    // echo strlen($Data); die;
    $opt = array(
        CURLOPT_URL => $action,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_POST => empty($data) ? FALSE : TRUE,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_CUSTOMREQUEST => empty($data) ? 'GET' : 'POST',
        CURLOPT_HTTPHEADER => $header,
        CURLOPT_ENCODING => "",
        CURLOPT_HEADER => FALSE,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_TIMEOUT => 20,
    );
    curl_setopt_array($curl, $opt);
    $body = curl_exec($curl);

    return $body;
}
function gachThe1s($loaithe, $menhgia, $seri, $pin, $code)
{
    global $partner_id_card, $partner_key_card;
    // ĐẶT GIÁ TRỊ MẢNG THÀNH NULL TRÁNH LỖI
    $POSTGET = array();

    // YÊU CẦU ID
    $POSTGET['request_id'] = $code;

    // MÃ THẺ NẠP TỪ POST USER
    $POSTGET['code'] = $pin;

    // PARTENER ID
    $POSTGET['partner_id'] = $partner_id_card;

    // SERI THẺ CÀO TỪ POST USER
    $POSTGET['serial'] = $seri;

    // NHÀ MẠNG TỪ POST USER
    $POSTGET['telco'] = $loaithe;

    // LỆNH (MẶC ĐỊNH: NẠP THẺ)
    $POSTGET['command'] = 'charging';

    // SẮP XẾP MẢNG
    ksort($POSTGET);

    //CHỮ KÝ KHI ĐỔI THẺ
    $sign = $partner_key_card;

    //Đặt chữ ký MD5 vào item
    foreach ($POSTGET as $item) {
        $sign .= $item;
    }

    //CHUYỂN CHỮ KÝ SANG ĐỊNH DẠNG MD5 (BẮT BUỘC)
    $mysign = md5($sign);

    // MỆNH GIÁ THẺ TỪ POST USER
    $POSTGET['amount'] = $menhgia;

    // CHỮ KÝ MD5
    $POSTGET['sign'] = $mysign;

    // XUẤT RA URL ĐỂ GỬI LÊN TSR
    $data = http_build_query($POSTGET);
    // CHẠY CURL
    $ch = curl_init();
    // QUÁ TRÌNH GỬI LÊN TSR (ĐỪNG THAY ĐỔI)
    curl_setopt($ch, CURLOPT_URL, "https://gachthe1s.com/chargingws/v2");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $SERVER_NAME = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    curl_setopt($ch, CURLOPT_REFERER, $SERVER_NAME);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    // ĐÓNG GỬI LÊN TSR
    curl_close($ch);

    // XUẤT RA JSON (STD CLASS)
    $json = json_decode($result);
    return $json;
}
function TheSieuRe($loaithe, $menhgia, $seri, $pin, $code)
{
    global $partner_id_card, $partner_key_card;
    $return = '';
    // ĐẶT GIÁ TRỊ MẢNG THÀNH NULL TRÁNH LỖI
    $POSTGET = array();

    // YÊU CẦU ID
    $POSTGET['request_id'] = $code;

    // MÃ THẺ NẠP TỪ POST USER
    $POSTGET['code'] = $pin;

    // PARTENER ID
    $POSTGET['partner_id'] = $partner_id_card;

    // SERI THẺ CÀO TỪ POST USER
    $POSTGET['serial'] = $seri;

    // NHÀ MẠNG TỪ POST USER
    $POSTGET['telco'] = $loaithe;

    // LỆNH (MẶC ĐỊNH: NẠP THẺ)
    $POSTGET['command'] = 'charging';

    // SẮP XẾP MẢNG
    ksort($POSTGET);

    //CHỮ KÝ KHI ĐỔI THẺ
    $sign = $partner_key_card;

    //Đặt chữ ký MD5 vào item
    foreach ($POSTGET as $item) {
        $sign .= $item;
    }

    //CHUYỂN CHỮ KÝ SANG ĐỊNH DẠNG MD5 (BẮT BUỘC)
    $mysign = md5($sign);

    // MỆNH GIÁ THẺ TỪ POST USER
    $POSTGET['amount'] = $menhgia;

    // CHỮ KÝ MD5
    $POSTGET['sign'] = $mysign;

    // XUẤT RA URL ĐỂ GỬI LÊN TSR
    $data = http_build_query($POSTGET);
    // CHẠY CURL
    $ch = curl_init();
    // QUÁ TRÌNH GỬI LÊN TSR (ĐỪNG THAY ĐỔI)
    curl_setopt($ch, CURLOPT_URL, "https://thesieure.com/chargingws/v2");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $SERVER_NAME = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    curl_setopt($ch, CURLOPT_REFERER, $SERVER_NAME);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    // ĐÓNG GỬI LÊN TSR
    curl_close($ch);

    // XUẤT RA JSON (STD CLASS)
    $json = json_decode($result);
    return $json;
}
function status_card($data)
{
    if ($data == '1') {
        $show = '<span class="label label-danger">Thẻ sai</span>';
    } else if ($data == '0') {
        $show = '<span class="label label-warning">Đang xử lý <i class="fa fa-spinner fa-spin"></i></span>';
    } else if ($data == '2') {
        $show = '<span class="label label-success">Thành công</span>';
    }
    return $show;
}
function status_cate($data){
    if ($data == '0') {
        $show = '<span class="badge badge-danger">Đang ẩn</span>';
    }
    else if ($data == '1') {
        $show = '<span class="badge badge-success">Hiển thị</span>';
    }
    return $show;
}
function getUser($id, $row)
{
    global $ACAIVIPPRO;
    return $ACAIVIPPRO->get_row("SELECT * FROM `user` WHERE `id` = '$id' ")[$row];
}
function getRowRealtime($table, $id, $row)
{
    global $ACAIVIPPRO;
    return $ACAIVIPPRO->get_row("SELECT * FROM `$table` WHERE `id` = '$id' ")[$row];
}
function numRowRealtime($table, $id)
{
    global $ACAIVIPPRO;
    return $ACAIVIPPRO->num_rows("SELECT * FROM `$table` WHERE `id` = '$id' ");
}

function pagination($url, $start, $total, $kmess)
{
    $out[] = '<div class="pupu"> <center><ul class="pagination">';
    $neighbors = 2;
    if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
    else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
    $base_link = '<li><a class="pagenav" href="' . strtr($url, array('%' => '%%')) . 'page/%d' . '">%s</a></li>';
    $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, '&lt;&lt;');
    if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
    if ($start > $kmess * ($neighbors + 1)) $out[] = '<li><a>...</a></li>';
    for ($nCont = $neighbors; $nCont >= 1; $nCont--) if ($start >= $kmess * $nCont) {
        $tmpStart = $start - $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    $out[] = '<li class="active"><a>' . ($start / $kmess + 1) . '</a></li>';
    $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
    for ($nCont = 1; $nCont <= $neighbors; $nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
        $tmpStart = $start + $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<li><a>...</a></li>';
    if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
    if ($start + $kmess < $total) {
        $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
        $out[] = sprintf($base_link, $display_page, '&gt;&gt;');
    }
    $out[] = '</ul></center></div>';
    return implode('', $out);
}
function pagination_account($url, $start, $total, $kmess)
{
    $out[] = ' <div class="pupu"> <div class="pagination" role="navigation">';
    $neighbors = 2;
    if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
    else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
    $base_link = '<a class="page-numbers" href="' . strtr($url, array('%' => '%%')) . '%d' . '.html">%s</a>';
    $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, '«');
    if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
    if ($start > $kmess * ($neighbors + 1)) $out[] = '<a class="page-numbers">...</a>';
    for ($nCont = $neighbors; $nCont >= 1; $nCont--) if ($start >= $kmess * $nCont) {
        $tmpStart = $start - $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    $out[] = '<a class="active">' . ($start / $kmess + 1) . '</a>';
    $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
    for ($nCont = 1; $nCont <= $neighbors; $nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
        $tmpStart = $start + $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<a class="active">...</a>';
    if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
    if ($start + $kmess < $total) {
        $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
        $out[] = sprintf($base_link, $display_page, '»');
    }
    $out[] = '</div></div>';
    return implode('', $out);
}
function pagination_category_home($url, $start, $total, $kmess)
{
    $out[] = ' <center><ul>';
    $neighbors = 2;
    if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
    else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
    $base_link = '<li class="page-item"><a class="page-link" href="' . strtr($url, array('%' => '%%')) . 'p=%d' . '">%s</a></li>';
    $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, 'Previous');
    if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
    if ($start > $kmess * ($neighbors + 1)) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    for ($nCont = $neighbors; $nCont >= 1; $nCont--) if ($start >= $kmess * $nCont) {
        $tmpStart = $start - $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    $out[] = '<li class="page-item active"><a class="page-link">' . ($start / $kmess + 1) . '</a></li>';
    $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
    for ($nCont = 1; $nCont <= $neighbors; $nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
        $tmpStart = $start + $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
    if ($start + $kmess < $total) {
        $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
        $out[] = sprintf($base_link, $display_page, 'Next');
    }
    $out[] = '</ul></center>';
    return implode('', $out);
}
function loai()
{
    /* BÁN GÌ THÌ THÊM Ở ĐÂY NHÉ, <option value="MÃ SẢN PHẨM">TÊN SẢN PHẨM</option> */
    $html = '
    <option value="CLONE">CLONE</option>
    <option value="VIA">VIA</option>
    <option value="GMAIL">GMAIL</option>
    <option value="BM">BM</option>
    <option value="KHÁC">KHÁC</option>

    ';
    return $html;
}
function livefb($data)
{
    if ($data == 'DIE') {
        $show = '<span class="badge bg-danger">DIE</span>';
    } else if ($data == 'LIVE') {
        $show = '<span class="badge bg-success">LIVE</span>';
    }
    return $show;
}
function display_loai($data)
{
    if ($data == 'FACEBOOK') {
        $show = '<span class="badge badge-primary">FACEBOOK</span>';
    } else if ($data == 'GMAIL') {
        $show = '<span class="badge badge-warning">GMAIL</span>';
    } else if ($data == 'HOTMAIL') {
        $show = '<span class="badge badge-warning">HOTMAIL</span>';
    } else if ($data == 'ZALO') {
        $show = '<span class="badge badge-primary">ZALO</span>';
    } else if ($data == 'TWITTER') {
        $show = '<span class="badge badge-info">TWITTER</span>';
    } else if ($data == 'MAILEDU') {
        $show = '<span class="badge badge-info">MAIL EDU</span>';
    } else if ($data == 'BM') {
        $show = '<span class="badge badge-primary">BM</span>';
    } else {
        $show = '<span class="badge badge-dark">' . $data . '</span>';
    }
    return $show;
}
function daily($ck)
{
    if ($ck == 0) {
        return lang(64);
    } else if ($ck > 0) {
        return lang(65);
    }
}
function trangthai($data)
{
    if ($data == 'xuly') {
        return 'Đang xử lý';
    } else if ($data == 'hoantat') {
        return 'Hoàn tất';
    } else if ($data == 'thanhcong') {
        return 'Thành công';
    } else if ($data == 'huy') {
        return 'Hủy';
    } else if ($data == 'thatbai') {
        return 'Thất bại';
    } else {
        return 'Khác';
    }
}

function loaithe($data)
{
    if ($data == 'Viettel' || $data == 'viettel') {
        $show = 'https://i.imgur.com/xFePMtd.png';
    } else if ($data == 'Vinaphone' || $data == 'vinaphone') {
        $show = 'https://i.imgur.com/s9Qq3Fz.png';
    } else if ($data == 'Mobifone' || $data == 'mobifone') {
        $show = 'https://i.imgur.com/qQtcWJW.png';
    } else if ($data == 'Vietnamobile' || $data == 'vietnamobile') {
        $show = 'https://i.imgur.com/IHm28mq.png';
    } else if ($data == 'Zing' || $data == 'zing') {
        $show = 'https://i.imgur.com/xkd7kQ0.png';
    } else if ($data == 'Garena' || $data == 'garena') {
        $show = 'https://i.imgur.com/BLkY5qm.png';
    }
    return '<img style="text-align: center;" src="' . $show . '" width="70px" />';
}

function parse_order_id($des)
{
    global $MEMO_PREFIX;
    $re = '/' . $MEMO_PREFIX . '\d+/im';
    preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0)
        return null;
    // Print the entire match result
    $orderCode = $matches[0][0];
    $prefixLength = strlen($MEMO_PREFIX);
    $orderId = intval(substr($orderCode, $prefixLength));
    return $orderId;
}


function BASE_URL($url)
{
    $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
    if ($base_url == 'http://localhost') {
        $base_url = 'http://localhost/shopaccv2';
    }
    return $base_url . $url;
}
function gettime()
{
    return date('Y/m/d H:i:s', time());
}
// function check_string($data)
// {
//     return trim(htmlspecialchars(addslashes($data)));
//     //return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($data))));
// }
// function compact_string($string, $length=5, $replace) {
//     $compact = substr($string,  0, $length );
//     $compact = $compact.$replace;
//     return $compact;
// }
function create_slug($string)
{
    $search = array(
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
        '#(ì|í|ị|ỉ|ĩ)#',
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',
        '#(đ)#',
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
        '#(Đ)#',
        "/[^a-zA-Z0-9\-\_]/",
    );
    $replace = array(
        'a',
        'e',
        'i',
        'o',
        'u',
        'y',
        'd',
        'A',
        'E',
        'I',
        'O',
        'U',
        'Y',
        'D',
        '-',
    );
    $string = preg_replace($search, $replace, $string);
    $string = preg_replace('/(-)+/', '-', $string);
    $string = strtolower($string);
    return $string;
}
function xss($data)
{
    // Fix &entity\n;
    $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    } while ($old_data !== $data);

    // we are done...
    $nhatloc = htmlspecialchars(addslashes(trim($data)));

    return $nhatloc;
}
function format_cash($number, $suffix = '')
{
    return number_format($number, 0, ',', '.') . "{$suffix}";
}
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);

    curl_close($ch);
    return $data;
}
function random($string, $int)
{
    return substr(str_shuffle($string), 0, $int);
}
function pheptru($int1, $int2)
{
    return $int1 - $int2;
}
function phepcong($int1, $int2)
{
    return $int1 + $int2;
}
function phepnhan($int1, $int2)
{
    return $int1 * $int2;
}
function phepchia($int1, $int2)
{
    return $int1 / $int2;
}
function check_img($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("png", "jpeg", "jpg", "PNG", "JPEG", "JPG", "gif", "GIF");
    if (in_array($ext, $valid_ext)) {
        return true;
    }
}
function msg_success_time($text, $url, $time)
{
    return die('<script type="text/javascript">
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: "slideDown",
        timeOut: 1500
    };
    toastr.success("' . $text . '", "Thành công");
    setTimeout(function(){ location.href = "' . $url . '" },' . $time . ');</script>');
}
/*
function msg_success2($text)
{
    return die('<div class="alert alert-success alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
}
function msg_error2($text)
{
    return die('<div class="alert alert-danger alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
}
function msg_warning2($text)
{
    return die('<div class="alert alert-warning alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
}
function msg_success($text, $url, $time)
{
    return die('<div class="alert alert-success alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div><script type="text/javascript">setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_error($text, $url, $time)
{
    return die('<div class="alert alert-danger alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div><script type="text/javascript">setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_warning($text, $url, $time)
{
    return die('<div class="alert alert-warning alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div><script type="text/javascript">setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
*/

function display_banned($data)
{
    if ($data == 1) {
        $show = '<span class="badge badge-danger">Banned</span>';
    } else if ($data == 0) {
        $show = '<span class="badge badge-success">Hoạt động</span>';
    }
    return $show;
}
function display_loaithe($data)
{
    if ($data == 0) {
        $show = '<span class="label label-warning">Bảo trì</span>';
    } else {
        $show = '<span class="label label-success">Hoạt động</span>';
    }
    return $show;
}
function display_ruttien($data)
{
    if ($data == 'xuly') {
        $show = '<span class="label label-info">Đang xử lý</span>';
    } else if ($data == 'hoantat') {
        $show = '<span class="label label-success">Đã thanh toán</span>';
    } else if ($data == 'huy') {
        $show = '<span class="label label-danger">Hủy</span>';
    }
    return $show;
}
function XoaDauCach($text)
{
    return trim(preg_replace('/\s+/', ' ', $text));
}
function display($data)
{
    if ($data == '0') {
        $show = '<span class="badge badge-danger">ẨN</span>';
    } else if ($data == '1') {
        $show = '<span class="badge badge-success">HIỂN THỊ</span>';
    }
    return $show;
}
function status($data)
{
    if ($data == 'xuly') {
        $show = '<span class="label label-info">Đang xử lý</span>';
    } else if ($data == 'hoantat') {
        $show = '<span class="label label-success">Hoàn tất</span>';
    }else if ($data == 'dangcay') {
        $show = '<span class="label label-warning">Đang cày</span>';
    } else if ($data == 'thanhcong') {
        $show = '<span class="label label-success">Thành công</span>';
    } else if ($data == 'success') {
        $show = '<span class="label label-success">Success</span>';
    } else if ($data == 'thatbai') {
        $show = '<span class="label label-danger">Thất bại</span>';
    } else if ($data == 'huy') {
        $show = '<span class="label label-danger">Đơn cày đã hủy</span>';
    } else if ($data == 'loi') {
        $show = '<span class="label label-danger">Lỗi</span>';
    } else if ($data == 'huy') {
        $show = '<span class="label label-danger">Hủy</span>';
    } else if ($data == 'dangnap') {
        $show = '<span class="label label-warning">Đang đợi nạp</span>';
    } else if ($data == 2) {
        $show = '<span class="label label-success">Hoàn tất</span>';
    } else if ($data == 1) {
        $show = '<span class="label label-info">Đang xử lý</span>';
    } else {
        $show = '<span class="label label-warning">Khác</span>';
    }
    return $show;
}
function status_withdraw_home($data)
{
    if ($data == '0') {
        $show = '<span class="label label-warning">Đang xử lý</span>';
    } else if ($data == '1') {
        $show = '<span class="label label-success">Hoàn tất</span>';
    }else if ($data == '2') {
        $show = '<span class="label label-danger">Đã hủy</span>';
    }
    return $show;
}
function status_withdraw($data)
{
    if ($data == '0') {
        $show = '<span class="badge badge-warning">Đang xử lý</span>';
    } else if ($data == '1') {
        $show = '<span class="badge badge-success">Hoàn tất</span>';
    }else if ($data == '2') {
        $show = '<span class="badge badge-danger">Đã hủy</span>';
    }
    return $show;
}
function sale($money, $sale)
{
    $total = $money - ($money * $sale / 100);
    return format_cash($total);
}
function getHeader()
{
    $headers = array();
    $copy_server = array(
        'CONTENT_TYPE'   => 'Content-Type',
        'CONTENT_LENGTH' => 'Content-Length',
        'CONTENT_MD5'    => 'Content-Md5',
    );
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) === 'HTTP_') {
            $key = substr($key, 5);
            if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                $headers[$key] = $value;
            }
        } elseif (isset($copy_server[$key])) {
            $headers[$copy_server[$key]] = $value;
        }
    }
    if (!isset($headers['Authorization'])) {
        if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
            $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
            $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
        } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
            $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
        }
    }
    return $headers;
}

function check_username($data)
{
    if (preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $data, $matches)) {
        return True;
    } else {
        return False;
    }
}
function check_email($data)
{
    if (preg_match('/^.+@.+$/', $data, $matches)) {
        return True;
    } else {
        return False;
    }
}
function check_phone($data)
{
    if (preg_match('/^\+?(\d.*){3,}$/', $data, $matches)) {
        return True;
    } else {
        return False;
    }
}
function check_url($url)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_HEADER, 1);
    curl_setopt($c, CURLOPT_NOBODY, 1);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_FRESH_CONNECT, 1);
    if (!curl_exec($c)) {
        return false;
    } else {
        return true;
    }
}
function check_zip($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("zip", "ZIP");
    if (in_array($ext, $valid_ext)) {
        return true;
    }
}
function TypePassword($string)
{
    global $NNL;
    if ($NNL->site('TypePassword') == 'md5') {
        return md5($string);
    } else if ($NNL->site('TypePassword') == 'sha1') {
        return sha1($string);
    } else if ($NNL->site('TypePassword') == '') {
        return $string;
    } else {
        return md5($string);
    }
}
function phantrang($url, $start, $total, $kmess)
{
    $out[] = '<nav aria-label="Page navigation example"><ul class="pagination pagination-lg">';
    $neighbors = 2;
    if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
    else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
    $base_link = '<li class="page-item"><a class="page-link" href="' . strtr($url, array('%' => '%%')) . 'p=%d' . '">%s</a></li>';
    $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, '<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>');
    if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
    if ($start > $kmess * ($neighbors + 1)) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    for ($nCont = $neighbors; $nCont >= 1; $nCont--) if ($start >= $kmess * $nCont) {
        $tmpStart = $start - $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    $out[] = '<li class="page-item active"><a class="page-link">' . ($start / $kmess + 1) . '</a></li>';
    $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
    for ($nCont = 1; $nCont <= $neighbors; $nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
        $tmpStart = $start + $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
    if ($start + $kmess < $total) {
        $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
        $out[] = sprintf($base_link, $display_page, '<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
        ');
    }
    $out[] = '</ul></nav>';
    return implode('', $out);
}
function myip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}
function timeAgo($time_ago)
{
    $time_ago   = date("Y-m-d H:i:s", $time_ago);
    $time_ago   = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed;
    $minutes    = round($time_elapsed / 60);
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400);
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640);
    $years      = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        return "$seconds giây trước";
    }
    //Minutes
    else if ($minutes <= 60) {
        return "$minutes phút trước";
    }
    //Hours
    else if ($hours <= 24) {
        return "$hours tiếng trước";
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            return "Hôm qua";
        } else {
            return "$days ngày trước";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        return "$weeks tuần trước";
    }
    //Months
    else if ($months <= 12) {
        return "$months tháng trước";
    }
    //Years
    else {
        return "$years năm trước";
    }
}
function dirToArray($dir)
{

    $result = array();

    $cdir = scandir($dir);
    foreach ($cdir as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            } else {
                $result[] = $value;
            }
        }
    }

    return $result;
}

function realFileSize($path)
{
    if (!file_exists($path))
        return false;

    $size = filesize($path);

    if (!($file = fopen($path, 'rb')))
        return false;

    if ($size >= 0) { //Check if it really is a small file (< 2 GB)
        if (fseek($file, 0, SEEK_END) === 0) { //It really is a small file
            fclose($file);
            return $size;
        }
    }

    //Quickly jump the first 2 GB with fseek. After that fseek is not working on 32 bit php (it uses int internally)
    $size = PHP_INT_MAX - 1;
    if (fseek($file, PHP_INT_MAX - 1) !== 0) {
        fclose($file);
        return false;
    }

    $length = 1024 * 1024;
    while (!feof($file)) { //Read the file until end
        $read = fread($file, $length);
        $size = bcadd($size, $length);
    }
    $size = bcsub($size, $length);
    $size = bcadd($size, strlen($read));

    fclose($file);
    return $size;
}
function FileSizeConvert($bytes)
{
    $result = null;
    $bytes = floatval($bytes);
    $arBytes = array(
        0 => array(
            "UNIT" => "TB",
            "VALUE" => pow(1024, 4)
        ),
        1 => array(
            "UNIT" => "GB",
            "VALUE" => pow(1024, 3)
        ),
        2 => array(
            "UNIT" => "MB",
            "VALUE" => pow(1024, 2)
        ),
        3 => array(
            "UNIT" => "KB",
            "VALUE" => 1024
        ),
        4 => array(
            "UNIT" => "B",
            "VALUE" => 1
        ),
    );

    foreach ($arBytes as $arItem) {
        if ($bytes >= $arItem["VALUE"]) {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", ",", strval(round($result, 2))) . " " . $arItem["UNIT"];
            break;
        }
    }
    return $result;
}
function GetCorrectMTime($filePath)
{

    $time = filemtime($filePath);

    $isDST = (date('I', $time) == 1);
    $systemDST = (date('I') == 1);

    $adjustment = 0;

    if ($isDST == false && $systemDST == true)
        $adjustment = 3600;

    else if ($isDST == true && $systemDST == false)
        $adjustment = -3600;

    else
        $adjustment = 0;

    return ($time + $adjustment);
}
function DownloadFile($file)
{ // $file = include path
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}

function isOnLine($user_id){
    global $ACAIVIPPRO;
    $online = $ACAIVIPPRO->get_row("SELECT * FROM `user` WHERE `user_id` = '".$user_id."'");
    if($online['time_online']+300 > time())
        $echo = "https://gofarmvn.pro/upload/assets/images/online.png";
    else
        $echo = "https://gofarmvn.pro/upload/assets/images/offline.png";
    return $echo;
}
function getUserName($user_id){
    global $ACAIVIPPRO;
    $get_User = $ACAIVIPPRO->get_row("SELECT * FROM `user` WHERE `user_id` = '".$user_id."'");
    $username = $get_User['username'];
    return $username;
}
function check_title($title){
    if(preg_match('/'.preg_quote('^\'£$%^&*()}{@#~?><,@|-=-_+-¬', '/').'/', $title)) {
        return true;
    }else{
        return false;
    }
}

function Setting($values){
    global $ACAIVIPPRO;
    $getSetting = $ACAIVIPPRO->get_row("SELECT * FROM `setting` WHERE `id` = '1'");
    return $getSetting[$values];
}

function formatViews($views) {
    if ($views < 1000) {
        return $views;
    } elseif ($views < 1000000) {
        return number_format($views / 1000, 1) . 'k';
    } else {
        return number_format($views / 1000000, 1) . 'M';
    }
}

if (!function_exists('create_slug')) {
    function create_slug($string)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}
function xss_jquery($values){
    // Loại bỏ mọi ký tự không phải chữ cái, số, hoặc dấu gạch ngang
    $sanitizedURL = preg_replace('/[^a-zA-Z0-9-]/', '', $values);
    return $sanitizedURL;
}
function get_url(){
    $currentURL = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . rtrim($_SERVER['REQUEST_URI'], '/');

    return $currentURL;
}
function categoy_name($name){
    global $ACAIVIPPRO;
    $get_ctgr = $ACAIVIPPRO->get_row("SELECT * FROM `category` WHERE `id` = '$name'");
    return $get_ctgr['title'];
}
function get($string)
    {
        return htmlspecialchars(addslashes($string));
    }
function tags($inputString) {
    $strings_array = explode(",", $inputString);
    return $strings_array;
}
function hidden($values){
    switch ($values) {
        case '1':
            $result = '<span class="badge badge-sm bg-gradient-secondary">Ẩn</span>';
            break;
        default:
            $result = '<span class="badge badge-sm bg-gradient-success">Hiển thị</span>';
            break;
    }
    return $result;
}
function category($name,$values){
    global $ACAIVIPPRO;
    $get_ctgr = $ACAIVIPPRO->get_row("SELECT * FROM `category` WHERE `id` = '$name'");
    return $get_ctgr[$values];
}

$currentDate = date("Y-m-d");
if (date("d", strtotime($currentDate)) === "01") {
    $tong_thang_cu = $ACAIVIPPRO->get_row("SELECT SUM(view) AS thang FROM `posts` WHERE `view_month` > 0")['thang'];
    $thangcu = date("m")-1;
if(tongket_view("$thangcu",$tong_thang_cu,date("Y"))){
$create = $ACAIVIPPRO->update("posts", [
    'view_month'       => 0,
    ], " `id` > 0 ");
    if ($create) {
    } else {
    }
}
}
// show active sidebar AdminLTE3
function active_sidebar($action)
{
    foreach ($action as $row) {
        if (isset($_GET['action']) && $_GET['action'] == $row) {
            return 'active';
        }
    }
    return '';
}
function menuopen_sidebar($action)
{
    foreach ($action as $row) {
        if (isset($_GET['action']) && $_GET['action'] == $row) {
            return 'menu-open';
        }
    }
    return '';
}

function tongket_view($thang,$view,$tong){
    $filePath = "$tong.json";
    if (file_exists($filePath)) {
    // Đọc dữ liệu từ tệp JSON và chuyển nó thành mảng
    $jsonData = file_get_contents($filePath);
    $data = json_decode($jsonData, true);
    if ($data === null) {
        // Đảm bảo rằng $data là mảng và không phải là null
        $data = array();
    }
} else {
    // Tệp JSON chưa tồn tại, tạo một mảng trống
    $data = array();
}
// Dữ liệu mới cần được thêm vào mảng $data
$newData = array(
    "$thang" => $view,
    // Thêm dữ liệu của các tháng khác ở đây
);
// Thêm dữ liệu mới vào mảng $data
$data = array_merge($data, $newData);
// Chuyển mảng $data thành chuỗi JSON
$jsonData = json_encode($data);
// Ghi dữ liệu JSON mới vào tệp
if (file_put_contents($filePath, $jsonData)) {
} else {
}
}

function page_category($url, $start, $total, $kmess)
{
    $out[] = ' <div class="navigation" role="navigation">';
    $neighbors = 2;
    if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
    else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
    $base_link = '<a class="page-numbers" href="' . strtr($url, array('%' => '%%')) . '%d' . '">%s</a>';
    $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, '«');
    if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
    if ($start > $kmess * ($neighbors + 1)) $out[] = '<a class="page-numbers">...</a>';
    for ($nCont = $neighbors; $nCont >= 1; $nCont--) if ($start >= $kmess * $nCont) {
        $tmpStart = $start - $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    $out[] = '<a class="currentpage">' . ($start / $kmess + 1) . '</a>';
    $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
    for ($nCont = 1; $nCont <= $neighbors; $nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
        $tmpStart = $start + $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<a class="currentpage">...</a>';
    if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
    if ($start + $kmess < $total) {
        $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
        $out[] = sprintf($base_link, $display_page, '»');
    }
    $out[] = '</div>';
    return implode('', $out);
}
