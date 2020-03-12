
// 获取ciphertext参数 get_cipher()

// 获取DES解密后的返回值 get_result()
function get_result(result,secretKey,date) {
    des3 = DES3.new(key=secretKey.encode(), mode=DES3.MODE_CBC, iv=date.encode())
    decrypted_data = des3.decrypt(base64.b64decode(result))
    plain_text = unpad(decrypted_data, DES3.block_size).decode()
    return plain_text
}

// 获取__RequestVerificationToken参数 get_token()
function random(size){
    var str = "",
    arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    for(var i=0; i<size; i++){
        str += arr[Math.round(Math.random() * (arr.length-1))];
    }
    return str;
}

// 获取pageid get_pageid()
function happy() {
    var guid = "";
    for (var i = 1; i <= 32; i++) {
        var n = Math.floor(Math.random() * 16.0).toString(16);
        guid += n;
        // if ((i == 8) || (i == 12) || (i == 16) || (i == 20)) guid +=
        // "-";
    }
    return guid;
}