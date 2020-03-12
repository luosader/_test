<?php
/**
 * 谷歌验证 (Google Authenticator) PHP版
 * https://blog.csdn.net/luxiaoqi1188/article/details/78891167
 */
// 开启Google的登陆二步验证（即Google Authenticator服务）后用户登陆时需要输入额外由手机客户端生成的一次性密码。
// 实现Google Authenticator功能需要服务器端和客户端的支持。
//     服务器端负责密钥的生成、验证一次性密码是否正确。
//     客户端记录密钥后生成一次性密码。
// 算法类保存为GoogleAuthenticator.php 的文件

// 怎么接在网站上？以下是做法参考：
//     第一种，做登陆验证码时，第一次生成密钥不变，然后生成一个二维码用GoogleAuthenticatorAPP扫一下就添加进去了。
//     服务器判断secret为第一次生成的密钥，code就是动态验证码，这样比较一下如果相同就通过。

//     第二种，对每个会员邦定动态验证或密码。注册会员时首次生成一个密钥保存到会员表里，下次登陆就把那个对应的密钥输出来，相当于 $ga->verifyCode('会员注册时生成的密钥secret','在登陆时或其它操作时需要动态验证code',1);
//         因为每个会员生成的密钥不一样，个人认为这样更安全些。
?>

<?php
/**
 * 客户端调用
 */
// require_once 'GoogleAuthenticator.php';
$ga = new PHPGangsta_GoogleAuthenticator();

//创建一个新的"安全密匙SecretKey"
//把本次的"安全密匙SecretKey"入库,和账户关系绑定,客户端也是绑定这同一个"安全密匙SecretKey"
$secret = $ga->createSecret();
echo "安全密匙SecretKey: " . $secret . '<br>';

$qrCodeUrl = $ga->getQRCodeGoogleUrl('www.2asp.cn', $secret); //第一个参数是"标识",第二个参数为"安全密匙SecretKey" 生成二维码信息
echo "Google Charts URL for the QR-Code: " . $qrCodeUrl . '<br>'; //Google Charts接口 生成的二维码图片,方便手机端扫描绑定安全密匙SecretKey


/*服务端验证*/
$oneCode = $ga->getCode($secret); //服务端计算"一次性验证码"
echo "服务端计算的验证码是:" . $oneCode . '<br>';

/**
 * 把提交的验证码和服务端上生成的验证码做对比
 * @var $secret 服务端的 "安全密匙SecretKey"
 * @var $oneCode 手机上看到的 "一次性验证码"
 * @var 最后一个参数 为容差时间,这里是2 那么就是 2* 30 sec 一分钟.
 */
$checkResult = $ga->verifyCode($secret, $oneCode, 1);
if ($checkResult) {
    echo '匹配! OK';
} else {
    echo '不匹配! FAILED';
}
?>

<?php
/**
 * GoogleAuthenticator.php
 * PHP Class for handling Google Authenticator 2-factor authentication.
 * @link https://github.com/PHPGangsta/GoogleAuthenticator/
 *
 * @author Michael Kliewe
 * @copyright 2012 Michael Kliewe
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link http://www.phpgangsta.de/
 */
class PHPGangsta_GoogleAuthenticator
{
    protected $_codeLength = 6;

    /**
     * Create new secret.
     * 16 characters, randomly chosen from the allowed base32 characters.
     * @param int $secretLength
     * @return string
     */
    public function createSecret($secretLength = 16)
    {
        $validChars = $this->_getBase32LookupTable();

        // Valid secret lengths are 80 to 640 bits
        if ($secretLength < 16 || $secretLength > 128) {
            throw new Exception('Bad secret length');
        }
        $secret = '';
        $rnd    = false;
        if (function_exists('random_bytes')) {
            $rnd = random_bytes($secretLength);
        } elseif (function_exists('mcrypt_create_iv')) {
            $rnd = mcrypt_create_iv($secretLength, MCRYPT_DEV_URANDOM);
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $rnd = openssl_random_pseudo_bytes($secretLength, $cryptoStrong);
            if (!$cryptoStrong) {
                $rnd = false;
            }
        }
        if ($rnd !== false) {
            for ($i = 0; $i < $secretLength; ++$i) {
                $secret .= $validChars[ord($rnd[$i]) & 31];
            }
        } else {
            throw new Exception('No source of secure random');
        }

        return $secret;
    }

    /**
     * Calculate the code, with given secret and point in time.
     * @param string   $secret
     * @param int|null $timeSlice
     * @return string
     */
    public function getCode($secret, $timeSlice = null)
    {
        if ($timeSlice === null) {
            $timeSlice = floor(time() / 30);
        }

        $secretkey = $this->_base32Decode($secret);

        // Pack time into binary string
        $time = chr(0) . chr(0) . chr(0) . chr(0) . pack('N*', $timeSlice);
        // Hash it with users secret key
        $hm = hash_hmac('SHA1', $time, $secretkey, true);
        // Use last nipple of result as index/offset
        $offset = ord(substr($hm, -1)) & 0x0F;
        // grab 4 bytes of the result
        $hashpart = substr($hm, $offset, 4);

        // Unpak binary value
        $value = unpack('N', $hashpart);
        $value = $value[1];
        // Only 32 bits
        $value = $value & 0x7FFFFFFF;

        $modulo = pow(10, $this->_codeLength);

        return str_pad($value % $modulo, $this->_codeLength, '0', STR_PAD_LEFT);
    }

    /**
     * Get QR-Code URL for image, from google charts.
     * @param string $name
     * @param string $secret
     * @param string $title
     * @param array  $params
     * @return string
     */
    public function getQRCodeGoogleUrl($name, $secret, $title = null, $params = array())
    {
        $width  = !empty($params['width']) && (int) $params['width'] > 0 ? (int) $params['width'] : 200;
        $height = !empty($params['height']) && (int) $params['height'] > 0 ? (int) $params['height'] : 200;
        $level  = !empty($params['level']) && array_search($params['level'], array('L', 'M', 'Q', 'H')) !== false ? $params['level'] : 'M';

        $urlencoded = urlencode('otpauth://totp/' . $name . '?secret=' . $secret . '');
        if (isset($title)) {
            $urlencoded .= urlencode('&issuer=' . urlencode($title));
        }

        return 'https://chart.googleapis.com/chart?chs=' . $width . 'x' . $height . '&chld=' . $level . '|0&cht=qr&chl=' . $urlencoded . '';
    }

    /**
     * Check if the code is correct. This will accept codes starting from $discrepancy*30sec ago to $discrepancy*30sec from now.
     * @param string   $secret
     * @param string   $code
     * @param int      $discrepancy      This is the allowed time drift in 30 second units (8 means 4 minutes before or after)
     * @param int|null $currentTimeSlice time slice if we want use other that time()
     * @return bool
     */
    public function verifyCode($secret, $code, $discrepancy = 1, $currentTimeSlice = null)
    {
        if ($currentTimeSlice === null) {
            $currentTimeSlice = floor(time() / 30);
        }

        if (strlen($code) != 6) {
            return false;
        }

        for ($i = -$discrepancy; $i <= $discrepancy; ++$i) {
            $calculatedCode = $this->getCode($secret, $currentTimeSlice + $i);
            if ($this->timingSafeEquals($calculatedCode, $code)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Set the code length, should be >=6.
     * @param int $length
     * @return PHPGangsta_GoogleAuthenticator
     */
    public function setCodeLength($length)
    {
        $this->_codeLength = $length;

        return $this;
    }

    /**
     * Helper class to decode base32.
     * @param $secret
     * @return bool|string
     */
    protected function _base32Decode($secret)
    {
        if (empty($secret)) {
            return '';
        }

        $base32chars        = $this->_getBase32LookupTable();
        $base32charsFlipped = array_flip($base32chars);

        $paddingCharCount = substr_count($secret, $base32chars[32]);
        $allowedValues    = array(6, 4, 3, 1, 0);
        if (!in_array($paddingCharCount, $allowedValues)) {
            return false;
        }
        for ($i = 0; $i < 4; ++$i) {
            if ($paddingCharCount == $allowedValues[$i] &&
                substr($secret, -($allowedValues[$i])) != str_repeat($base32chars[32], $allowedValues[$i])) {
                return false;
            }
        }
        $secret       = str_replace('=', '', $secret);
        $secret       = str_split($secret);
        $binaryString = '';
        for ($i = 0; $i < count($secret); $i = $i + 8) {
            $x = '';
            if (!in_array($secret[$i], $base32chars)) {
                return false;
            }
            for ($j = 0; $j < 8; ++$j) {
                $x .= str_pad(base_convert(@$base32charsFlipped[@$secret[$i + $j]], 10, 2), 5, '0', STR_PAD_LEFT);
            }
            $eightBits = str_split($x, 8);
            for ($z = 0; $z < count($eightBits); ++$z) {
                $binaryString .= (($y = chr(base_convert($eightBits[$z], 2, 10))) || ord($y) == 48) ? $y : '';
            }
        }

        return $binaryString;
    }

    /**
     * Get array with all 32 characters for decoding from/encoding to base32.
     * @return array
     */
    protected function _getBase32LookupTable()
    {
        return array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', //  7
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 15
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 23
            'Y', 'Z', '2', '3', '4', '5', '6', '7', // 31
            '=', // padding char
        );
    }

    /**
     * A timing safe equals comparison
     * more info here: http://blog.ircmaxell.com/2014/11/its-all-about-time.html.
     * @param string $safeString The internal (safe) value to be checked
     * @param string $userString The user submitted (unsafe) value
     * @return bool True if the two strings are identical
     */
    private function timingSafeEquals($safeString, $userString)
    {
        if (function_exists('hash_equals')) {
            return hash_equals($safeString, $userString);
        }
        $safeLen = strlen($safeString);
        $userLen = strlen($userString);
        if ($userLen != $safeLen) {
            return false;
        }

        $result = 0;
        for ($i = 0; $i < $userLen; ++$i) {
            $result |= (ord($safeString[$i]) ^ ord($userString[$i]));
        }

        // They are only identical strings if $result is exactly 0...
        return $result === 0;
    }
}
?>