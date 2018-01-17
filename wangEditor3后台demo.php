<?php

// -->  1. 接收文件, 区别于$_POST、$_GET
//var_dump($_FILES);

// --> 2. 获取图片所有信息
$files = $_FILES;
$result = array();

while ($item = current($files)) {
    upload($item);
    next($files);
}

function upload($img){

    global $result;
    // --> 3. 先判断有没有错
    if ($img["error"] == 0) {
        // 成功
        // 判断传输的文件是否是图片，类型是否合适
        // 获取传输的文件类型
        $typeArr = explode("/", $img["type"]);
        if ($typeArr[0] == "image") {

            // --> 5. 定义几种图片类型
            $imgType = array("png", "jpg", "jpeg");

            // --> 判断上传的文件类型是否包括在图片类型数组中
            if (in_array($typeArr[1], $imgType)) {

                // 6. 类型检查无误，保存到文件夹内
                // -->  给图片定一个新名字 (使用时间戳，防止重复)
                $imgname = "file/" . time() . explode('/',$img["name"])[0]. "." . $typeArr[1];
                // 7. 将上传的文件写入到文件夹中
                // -->  参数1: 图片在服务器缓存的地址 ,参数2: 图片的目的地址（最终保存的位置）
                // -->  最终会有一个布尔返回值
                $bol = move_uploaded_file($img["tmp_name"], $imgname);
                if ($bol) {
                    $result['errno'] = 0;
                    $result['data'][]='/test/'.$imgname;
                }
            };
        } else {
            // 不是图片类型
            $result['errno'] = "没有图片，再检查一下吧！";
//            echo "没有图片，再检查一下吧！";
        };
    } else {
        // 失败
        $result['errno'] = $img["error"];
//        echo $img["error"];
    };

}

// --> 返回js数据
echo json_encode($result);
