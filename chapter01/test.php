<?php
$out = `ls -la`;
echo '<pre>' . $out . '</pre>';
class sampleClass{};
$myObject = new sampleClass();
if ($myObject instanceof sampleClass) {
    echo "myObject is an instance of sampleClass";
}

?>
