// http://wenshu.court.gov.cn/common/static/scripts/lawyeeui/website.js?v=1565674603120

// get_result()
var DES3 = {
    iv: function() {
        return formatDate(new Date(), 'yyyyMMdd');
    },
    encrypt: function(b, c, a) {
        if (c) {
            return (CrytoJS.TripleDES.encrypt(b, CrytoJS.enc.Utf8.parse(c), {
                iv: CrytoJS.enc.Utf8.parse(a || DES3.iv()),
                mode: CrytoJS.mode.CBC,
                padding: CrytoJS.pad.Pkcs7
            })).toString();
        }
        return '';
    },
    decrypt: function(b, c , a) {
        if (c) {
            return CrytoJS.enc.Utf8.stringify(CrytoJS.TripleDES.decrypt(b, CrytoJS.enc.Utf8.parse(c), {
                iv: CrytoJS.enc.Utf8.parse(a || DES3.iv()),
                mode: CrytoJS.mode.CBC,
                padding: CrytoJS.pad.Pkcs7
            })).toString();
        }
        return '';
    }
};

