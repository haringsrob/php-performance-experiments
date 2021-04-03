<?php

$item = new RecursiveDirectoryIterator(__DIR__ . '/../experiments');
$iterator = new RecursiveIteratorIterator($item);

$excludeFiles = [
    '.',
    '..',
    '.DS_Store',
];

$data = [];

/** @var \SplFileInfo $item */
foreach ($iterator as $item) {
    if ($item->isFile() && !in_array($item->getFilename(), $excludeFiles, true)) {
        $exploded = explode('/experiments/', $item->getPath());

        if (!isset($exploded[1])) {
            continue;
        }

        $experiment = $exploded[1];

        $extension = $item->getExtension();

        if ($extension === 'md') {
            $data[$experiment]['readme'] = $item->getPath() . '/' . $item->getFilename();
        } else {
            // We need these relative.
            $name = str_replace([".$extension", 'plot_'], '', $item->getFilename());
            $data[$experiment][$name][$extension] = "../experiments/$experiment/" . $item->getFilename();
        }
    }
}

// Build the actual documentation results
$targetDir = __DIR__ . '/../results/';
ensureDirExists($targetDir);

// Build the pages.
$indexItems = [];
foreach ($data as $experiment => $experimentData) {
    $indexItems["./$experiment/$experiment.md"] = $experiment;
    ensureDirExists("$targetDir/$experiment");
    $page = buildExperimentPage($experimentData);
    file_put_contents("$targetDir/$experiment/$experiment.md", $page);
}

file_put_contents("$targetDir/readme.md", getIndexPage($indexItems));

function getIndexPage(array $indexItems): string
{
    $content = "# Experiments";
    $content .= "\r\n";
    $content .= "\r\n";
    foreach ($indexItems as $indexItem => $title) {
        $content .= "- [$title]($indexItem)\r\n";
    }

    return $content;
}

function buildExperimentPage(array $data): string
{
    $readmeContent = isset($data['readme']) ? file_get_contents($data['readme']) : '';

    $page = $readmeContent;

    foreach ($data as $index => $details) {
        if ($index !== 'readme') {
            $title = ucfirst(str_replace('_', ' ', $index));
            $php = file_get_contents(__DIR__ . '/' . $details['php']);
            $page .= "\r\n";
            $page .= "## $title \r\n";
            $page .= "\r\n";
            $page .= "![Plot](../" . $details['png'] . ")\r\n";
            $page .= "\r\n";
            $page .= "```php \r\n";
            $page .= "\r\n";
            $page .= $php;
            $page .= "\r\n";
            $page .= "```\r\n";
        }
    }


    return $page;
}

function ensureDirExists(string $dir): void
{
    if (!is_dir($dir) && !mkdir($dir) && !is_dir($dir)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
    }
}
