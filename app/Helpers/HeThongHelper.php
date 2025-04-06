<?php

if (!function_exists('xoa_ky_tu_dat_biet')) {
    function xoa_ky_tu_dat_biet($str)
    {
        $unicode = [
            'a' => 'à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ',
            'd' => 'đ',
            'e' => 'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ',
            'i' => 'ì|í|ị|ỉ|ĩ',
            'o' => 'ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ',
            'u' => 'ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ',
            'y' => 'ỳ|ý|ỵ|ỷ|ỹ',
            'A' => 'À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ',
            'D' => 'Đ',
            'E' => 'È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ',
            'I' => 'Ì|Í|Ị|Ỉ|Ĩ',
            'O' => 'Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ',
            'U' => 'Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ',
            'Y' => 'Ỳ|Ý|Ỵ|Ỷ|Ỹ'
        ];

        // Thay thế các ký tự có dấu thành không dấu
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }

        // Thay thế các ký tự đặc biệt bằng khoảng trắng
        $str = preg_replace('#[^\w()/.%\-&]#', ' ', $str);

        // Chuyển về chữ thường và tạo slug
        return strtolower(create_slug(rand(100, 999) . "-" . $str));
    }
}
function create_slug($string)
{
    // Chuyển về chữ thường
    $string = strtolower($string);

    // Thay thế các ký tự đặc biệt bằng khoảng trắng
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);

    // Thay thế khoảng trắng thành dấu gạch nối
    $string = str_replace('/[\s-]+/', '-', trim($string));

    // Bỏ dấu gạch nối thừa ở đầu và cuối
    $string = trim($string, '-');

    return $string;
}