<?php
/**
 * 九九乘法表
 */
header('Content-Type:text/html;charset=UTF-8');

echo "<table border=1>";
for ($i = 1; $i < 10; $i++) {
    echo "<tr>";for ($j = 1; $j <= $i; $j++) {echo "<td>$j*$i=" . $j * $i . "</td>";}
    echo "</tr>";
}
echo "</table>";

echo "<br>";
echo "<table border=1>";
for ($i = 9; $i >= 1; $i--) {
    echo "<tr>";
    for ($j = $i; $j >= 1; $j--) {echo "<td>$i x $j=" . $j * $i . "</td>";}
    echo "</tr>";
}
echo "</table>";

echo "<br>";
$i = 1;
while ($i <= 9) {
    $j = 1;while ($j <= $i) {
        echo "$i x $j=" . $j * $i . "&nbsp;&nbsp;";
        $j++;
    }
    $i++;
    echo "<br>";
}

for ($j = 1; $j <= 9; $j++) {
    for ($i = 1; $i <= $j; $i++) {
        echo "{$i}x{$j}=" . ($i * $j) . " ";
    }
    echo "<br />";
}

$j = 1;
while ($j <= 9) {
    $i = 1;
    while ($i <= $j) {
        echo "{$i}x{$j}=" . ($i * $j) . " ";
        $i++;
    }
    echo "<br />";
    $j++;
}

$j = 1;
do {
    $i = 1;
    do {
        echo "{$i}x{$j}=" . ($i * $j) . " ";
        $i++;
    } while ($i <= $j);
    echo "<br />";
    $j++;
} while ($j <= 9);

echo "<table width='600' border='1'>";
for ($j = 1; $j <= 9; $j++) {
    echo "<tr>";
    for ($i = 1; $i <= $j; $i++) {
        echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

echo "<table width='600' border='1'>";
for ($j = 9; $j >= 1; $j--) {
    echo "<tr>";
    for ($i = 1; $i <= $j; $i++) {
        echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

echo "<table width='600' border='1'>";
for ($j = 9; $j >= 1; $j--) {
    echo "<tr>";
    for ($z = 0; $z < 9 - $j; $z++) {
        echo "<td> </td>";
    }
    for ($i = 1; $i <= $j; $i++) {
        echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

echo "<table width='600' border='1'>";
for ($j = 1; $j <= 9; $j++) {
    echo "<tr>";
    for ($z = 0; $z < 9 - $j; $z++) {
        echo "<td> </td>";
    }
    for ($i = $j; $i >= 1; $i--) {
        echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
    }

    echo "</tr>";
}
echo "</table>";
?>

<?php
/*PHP九九乘法表(三种循环、4种角度)
首先按照规矩，还是先废话一番，对于刚学PHP的新手来讲，用php写九九乘法表无疑是非常经典的一道练习题。
但不要小看这道练习题，它对于逻辑的考验还是相当到位的。
也许有人会觉得，九九乘法表有什么难的，我两分钟就可以写出来。
是的，所谓难者不会，会者不难，对于一些老手来讲，这确实算不得什么。可是对于新手，却是可以锻炼逻辑思维的。
而且，你就真觉得这是一道小儿科的题？ www.it165.net
如果不限制条件，可能你两分钟确实可以敲完整段代码，熟练的话还可以用几种方式实现，但是如果是让你写出四个角度的九九乘法表呢？（还可以继续延伸下去）
别的不多说，奉上大乘佛法之PHP九九乘法表(三种循环、4种角度)：*/

/*// 一、使用for循环打印九九乘法表：
for ($j = 1; $j <= 9; $j++) {
for ($i = 1; $i <= $j; $i++) {
echo "{$i}x{$j}=" . ($i * $j) . " ";
}
echo "<br />";
}

// 二、使用while循环打印九九乘法表:
$j = 1;
while ($j <= 9) {
$i = 1;
while ($i <= $j) {
echo "{$i}x{$j}=" . ($i * $j) . " ";
$i++;
}
echo "<br />";
$j++;
}

// 三、使用do while循环打印九九乘法表:
$j = 1;
do {
$i = 1;
do {
echo "{$i}x{$j}=" . ($i * $j) . " ";
$i++;
} while ($i <= $j);
echo "<br />";
$j++;
} while ($j <= 9);

// 下面使用for循环以表格形式输出九九乘法表
// 角度一：（最普通的常规写法）
echo "<table width='600' border='1'>";
for ($j = 1; $j <= 9; $j++) {
echo "<tr>";
for ($i = 1; $i <= $j; $i++) {
echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
}
echo "</tr>";
}
echo "</table>";

// 角度二：（与常规写法成X轴对称）
echo "<table width='600' border='1'>";
for ($j = 9; $j >= 1; $j--) {
echo "<tr>";
for ($i = 1; $i <= $j; $i++) {
echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
}
echo "</tr>";
}
echo "</table>";

// 角度三：（与角度二成Y轴对称）
echo "<table width='600' border='1'>";
for ($j = 9; $j >= 1; $j--) {
echo "<tr>";
for ($z = 0; $z < 9 - $j; $z++) {
echo "<td> </td>";
}
for ($i = 1; $i <= $j; $i++) {
echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
}
echo "</tr>";
}
echo "</table>";

// 角度四：（与常规写法成Y轴对称）
echo "<table width='600' border='1'>";
for ($j = 1; $j <= 9; $j++) {
echo "<tr>";
for ($z = 0; $z < 9 - $j; $z++) {
echo "<td> </td>";
}
for ($i = $j; $i >= 1; $i--) {
echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
}
echo "</tr>";
}
echo "</table>";*/

?>