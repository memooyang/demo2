<?php

namespace app\AdminDashboard\controller;
use app\AdminDashboard\common\BaseController;

class Test extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->setController(__CLASS__);
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Test/Slexx
    https://www.getpointsfun.com//AdminDashboard/Test/Slexx
    @return 
array(3) { ["cpu"]=> int(1272036439) ["cpu0"]=> int(635811825) ["cpu1"]=> int(636224610) } array(2) { ["ram"]=> array(3) { ["all"]=> int(4015784) ["used"]=> int(1238680) ["free"]=> int(565172) } ["swap"]=> array(3) { ["all"]=> int(524284) ["used"]=> int(504640) ["free"]=> int(19644) } } string(6) "8.2.20" array(6) { ["name"]=> string(12) "Alpine Linux" ["id"]=> string(6) "alpine" ["version_id"]=> string(6) "3.20.1" ["pretty_name"]=> string(18) "Alpine Linux v3.20" ["home_url"]=> string(24) "https://alpinelinux.org/" ["bug_report_url"]=> string(53) "https://gitlab.alpinelinux.org/alpine/aports/-/issues" } string(31) "AMD EPYC 7713 64-Core Processor"    
    */
    public function Slexx()
    {
var_dump(\Slexx\Server::CPUUsage());
// [
//     'cpu' => 13202110,
//     'cpu0' => 3299864,
//     'cpu1' => 3306752,
//     'cpu2' => 3290429,
//     'cpu3' => 3305059
// ]
// \Slexx\Server::MemoryInfo
var_dump(\Slexx\Server::MemoryInfo());
// [
//     'ram' => [
//         'all' => 5667616,
//         'used' => 4225624,
//         'free' => 268476
//     ],
//     'swap' => [
//         'all' => 2097148,
//         'used' => 897792,
//         'free' => 1199356
//     ]
// ]
// \Slexx\Server::PHPVersion
var_dump(\Slexx\Server::PHPVersion());
// 7.2.14-1+ubuntu18.04.1+deb.sury.org+1
// \Slexx\Server::OSInfo
var_dump(\Slexx\Server::OSInfo());
// [
//     'name' => 'Linux Mint',
//     'version' => '19.1 (Tessa)',
//     'id' => 'linuxmint',
//     'id_like' => 'ubuntu',
//     'pretty_name' => 'Linux Mint 19.1',
//     'version_id' => '19.1',
//     'home_url' => 'https://www.linuxmint.com/',
//     'support_url' => 'https://forums.ubuntu.com/',
//     'bug_report_url' => 'http://linuxmint-troubleshooting-guide.readthedocs.io/en/latest/',
//     'privacy_policy_url' => 'https://www.linuxmint.com/',
//     'version_codename' => 'tessa',
//     'ubuntu_codename' => 'bionic'
// ]
// \Slexx\Server::ProcessorModel
var_dump(\Slexx\Server::ProcessorModel());
// 'AMD A10-9620P RADEON R5, 10 COMPUTE CORES 4C+6G'
    }
    
    /*
    @test
    https://demo2.app/AdminDashboard/Test/SystemInfo
    https://www.getpointsfun.com//AdminDashboard/Test/SystemInfo
    @return 
JSON STRING [{"system":{"cpu":{"model":"AMD EPYC 7713 64-Core Processor","cores":2,"usage":{"percent":0,"raw":{"user":0,"system":0,"idle":0}}},"memory":{"total":"4112162816","free":"577859584","used":"1269362688","usage":{"percent":0.1636828644501279}},"storage":{"total":"78.2G","used":"12.8G","free":"61.3G","usage":{"percent":{"percent":17}}}}},{"services":{"nginx":{"status":"running","version":"8.34"},"apache":{"status":"running","version":"8.34"},"nodejs":{"status":"running","version":"8.34"},"php":{"status":"running","version":"8.34"}}}] OR Render a Table    
    */
    public function SystemInfo()
    {
        try{
            // $ServiceInfo = new \ServerInfo\ServiceInfo();
            // echo $ServiceInfo->getServiceInfo();
            
            
            // $SystemInfo = new \ServerInfo\ServiceInfo();
            
$serviceInfo = new \ServerInfo\ServiceInfo();
$systemInfo = new \ServerInfo\SystemInfo();

$serverInfo = json_encode([$systemInfo->getSystemInfo(), $serviceInfo->getServiceInfo()]);

// json string
echo "JSON STRING\n\n".$serverInfo ."\n\nOR\n\nRender a Table\n";

// Or render a table on your view
$data = json_decode($serverInfo, true);

echo '<table border="1">';
echo '<tr><th>Item</th><th>Total</th><th>Used</th><th>Usage</th></tr>';

foreach ($data as $item) {
    if (isset($item['system'])) {
        $system = $item['system'];
        echo '<tr>';
        echo '<td>CPU Model</td><td colspan="3">' . $system['cpu']['model'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Memory</td>';
        echo '<td>' . $system['cpu']['total'] . '</td>';
        echo '<td>' . $system['cpu']['used'] . '</td>';
        echo '<td>' . $system['cpu']['usage']['percent'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Memory</td>';
        echo '<td>' . $system['memory']['total'] . '</td>';
        echo '<td>' . $system['memory']['used'] . '</td>';
        echo '<td>' . $system['memory']['usage']['percent'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Storage</td>';
        echo '<td>' . $system['storage']['total'] . '</td>';
        echo '<td>' . $system['storage']['used'] . '</td>';
        echo '<td>' . $system['storage']['usage']['percent']['percent'] . '</td>';
        echo '</tr>';
    }
}

echo '</table>';

echo '<br>';

echo '<table border="1">';
echo '<tr><th>Service</th><th>Version</th><th>Status</th></tr>';

foreach ($data as $item) {
    if (isset($item['services'])) {
        $services = $item['services'];
        foreach ($services as $service => $details) {
            echo '<tr>';
            echo '<td>' . $service . '</td>';
            echo '<td>' . $details['version'] . '</td>';
            echo '<td>' . $details['status'] . '</td>';
            echo '</tr>';
        }
    }
}

echo '</table>';
echo '<br>';
exit;
        }catch(\Exception $e){
            $this->logException($e);
        }
    }
    
}
