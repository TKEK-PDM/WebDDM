<?php
/**
 * CodeIgniter 3 → 4 마이그레이션 대상 파일 목록 추출 스크립트
 */

$basePath = __DIR__ . '/application'; // CI3의 application 폴더 경로
$outputFile = __DIR__ . '/migration_file_list.txt';

$targets = [
    'controllers' => 'Controllers',
    'models' => 'Models',
    'views' => 'Views',
    'libraries' => 'Libraries',
    'helpers' => 'Helpers',
    'config' => 'Config',
    'language' => 'Language Files',
];

$result = [];

function scanFiles($dir, &$resultArr) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $fullPath = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($fullPath)) {
            scanFiles($fullPath, $resultArr);
        } else {
            $resultArr[] = $fullPath;
        }
    }
}

foreach ($targets as $folder => $label) {
    $dir = $basePath . DIRECTORY_SEPARATOR . $folder;
    if (is_dir($dir)) {
        $files = [];
        scanFiles($dir, $files);
        $result[$label] = $files;
    }
}

// 파일로 출력
$output = "CI3 to CI4 Migration File List\n";
$output .= "Generated on: " . date('Y-m-d H:i:s') . "\n\n";

foreach ($result as $section => $files) {
    $output .= "== $section (" . count($files) . " files) ==\n";
    foreach ($files as $f) {
        $output .= str_replace($basePath . '/', '', $f) . "\n";
    }
    $output .= "\n";
}

file_put_contents($outputFile, $output);
echo "📁 마이그레이션 대상 파일 목록 생성 완료: $outputFile\n";
