<?php

/**
 * Vite production asset loader. Never probes localhost:5173.
 */
class BSL_Vite
{
    public static $output_uri = '';

    public static function vite($entry, $output_dir, $output_uri)
    {
        self::$output_uri = trailingslashit($output_uri);
        $output_dir = trailingslashit($output_dir);

        return "\n" . self::jsTag($entry, $output_dir)
            . "\n" . self::jsPreloadImports($entry, $output_dir)
            . "\n" . self::cssTag($entry, $output_dir);
    }

    public static function jsTag($entry, $output_dir)
    {
        $url = self::assetUrl($entry, $output_dir);
        if (!$url) {
            return '';
        }
        return '<script type="module" src="' . esc_url($url) . '"></script>';
    }

    public static function jsPreloadImports($entry, $output_dir)
    {
        $res = '';
        foreach (self::importsUrls($entry, $output_dir) as $url) {
            $res .= '<link rel="modulepreload" href="' . esc_url($url) . '">';
        }
        return $res;
    }

    public static function cssTag($entry, $output_dir)
    {
        $tags = '';
        foreach (self::cssUrls($entry, $output_dir) as $url) {
            $tags .= '<link rel="stylesheet" href="' . esc_url($url) . '">';
        }
        return $tags;
    }

    public static function getManifest($output_dir)
    {
        static $cache = array();
        if (isset($cache[$output_dir])) {
            return $cache[$output_dir];
        }
        $paths = array(
            $output_dir . '.vite/manifest.json',
            $output_dir . 'manifest.json',
        );
        foreach ($paths as $manifest_path) {
            if (is_readable($manifest_path)) {
                $data = json_decode((string) file_get_contents($manifest_path), true);
                return $cache[$output_dir] = is_array($data) ? $data : array();
            }
        }
        return $cache[$output_dir] = array();
    }

    public static function assetUrl($entry, $output_dir)
    {
        $manifest = self::getManifest($output_dir);
        return isset($manifest[$entry]['file']) ? self::out_uri($manifest[$entry]['file']) : '';
    }

    public static function importsUrls($entry, $output_dir)
    {
        $urls = array();
        $manifest = self::getManifest($output_dir);
        if (!empty($manifest[$entry]['imports'])) {
            foreach ($manifest[$entry]['imports'] as $imports) {
                if (!empty($manifest[$imports]['file'])) {
                    $urls[] = self::out_uri($manifest[$imports]['file']);
                }
            }
        }
        return $urls;
    }

    public static function cssUrls($entry, $output_dir)
    {
        $urls = array();
        $manifest = self::getManifest($output_dir);
        if (!empty($manifest[$entry]['css'])) {
            foreach ($manifest[$entry]['css'] as $file) {
                $urls[] = self::out_uri($file);
            }
        }
        if (!empty($manifest[$entry]['imports'])) {
            foreach ($manifest[$entry]['imports'] as $import) {
                if (!empty($manifest[$import]['css'])) {
                    foreach ($manifest[$import]['css'] as $file) {
                        $urls[] = self::out_uri($file);
                    }
                }
            }
        }
        return $urls;
    }

    public static function out_uri($file)
    {
        return self::$output_uri . ltrim($file, '/');
    }
}
