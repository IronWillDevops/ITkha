<?php

namespace App\Services\Public;

class DeviceDetector
{
    public function parse(?string $agent): array
    {
        if (!$agent) {
            return $this->unknown();
        }

        $agent = strtolower($agent);

        $platformName = $this->detectPlatform($agent);
        $platformVersion = $this->detectPlatformVersion($agent, $platformName);

        $browserName = $this->detectBrowser($agent);
        $browserVersion = $this->detectBrowserVersion($agent, $browserName);

        return [
            'device' => $this->detectDevice($agent),

            'platform' => $platformVersion
                ? $platformName . ' ' . $platformVersion
                : $platformName,

            'browser' => $browserVersion
                ? $browserName . ' ' . $browserVersion
                : $browserName,

            'icon' => $this->detectIcon($agent),
        ];
    }

    private function unknown(): array
    {
        return [
            'device' => 'Unknown',
            'platform' => 'Unknown',
            'platform_version' => null,
            'browser' => 'Unknown',
            'browser_version' => null,
            'icon' => 'fa-desktop',
        ];
    }

    private function detectPlatform(string $agent): string
    {
        return match (true) {
            str_contains($agent, 'android') => 'Android',
            str_contains($agent, 'iphone'), str_contains($agent, 'ipad'), str_contains($agent, 'ios') => 'iOS',
            str_contains($agent, 'windows') => 'Windows',
            str_contains($agent, 'mac os x'), str_contains($agent, 'macintosh') => 'MacOS',
            str_contains($agent, 'linux') => 'Linux',
            default => 'Unknown',
        };
    }

    private function detectPlatformVersion(string $agent, string $platform): ?string
    {
        return match ($platform) {
            'Windows' => $this->extractVersion($agent, 'windows nt '),
            'Android' => $this->extractVersion($agent, 'android '),
            'iOS'     => $this->extractVersion($agent, 'os ', '_'),
            'MacOS'   => $this->extractVersion($agent, 'mac os x ', '_'),
            default   => null,
        };
    }

    private function detectBrowser(string $agent): string
    {
        return match (true) {
            str_contains($agent, 'edg/') => 'Edge',
            str_contains($agent, 'opr/') => 'Opera',
            str_contains($agent, 'chrome/') && !str_contains($agent, 'edg/') => 'Chrome',
            str_contains($agent, 'firefox/') => 'Firefox',
            str_contains($agent, 'safari/') && !str_contains($agent, 'chrome/') => 'Safari',
            default => 'Unknown',
        };
    }

    private function detectBrowserVersion(string $agent, string $browser): ?string
    {
        return match ($browser) {
            'Chrome'  => $this->extractVersion($agent, 'chrome/'),
            'Firefox' => $this->extractVersion($agent, 'firefox/'),
            'Edge'    => $this->extractVersion($agent, 'edg/'),
            'Opera'   => $this->extractVersion($agent, 'opr/'),
            'Safari'  => $this->extractVersion($agent, 'version/'),
            default   => null,
        };
    }

    private function detectDevice(string $agent): string
    {
        return match (true) {
            str_contains($agent, 'tablet'), str_contains($agent, 'ipad') => 'Tablet',
            str_contains($agent, 'mobile') => 'Mobile',
            default => 'Desktop',
        };
    }

    private function detectIcon(string $agent): string
    {
        return match (true) {
            str_contains($agent, 'tablet'), str_contains($agent, 'ipad') => 'fa-tablet-alt',
            str_contains($agent, 'mobile') => 'fa-mobile-alt',
            default => 'fa-desktop',
        };
    }

    private function extractVersion(string $agent, string $needle, string $replaceUnderscore = null): ?string
    {
        if (!str_contains($agent, $needle)) {
            return null;
        }

        preg_match('/' . preg_quote($needle, '/') . '([\d\._]+)/', $agent, $matches);

        if (!isset($matches[1])) {
            return null;
        }

        $version = $matches[1];

        if ($replaceUnderscore) {
            $version = str_replace($replaceUnderscore, '.', $version);
        }

        return $version;
    }
}
