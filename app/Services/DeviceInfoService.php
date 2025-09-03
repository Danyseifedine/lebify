<?php

namespace App\Services;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class DeviceInfoService
{
    protected $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function getDeviceInfo(Request $request)
    {
        return [
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'browser' => $this->agent->browser(),
            'browser_version' => $this->agent->version($this->agent->browser()),
            'device' => $this->getDevice(),
            'platform' => $this->agent->platform(),
            'platform_version' => $this->agent->version($this->agent->platform()),
            'is_mobile' => $this->agent->isMobile(),
            'is_tablet' => $this->agent->isTablet(),
            'is_desktop' => $this->agent->isDesktop(),
            'language' => $request->getPreferredLanguage(),
            'screen_resolution' => $request->input('device_info.screenResolution'),
            'color_depth' => $request->input('device_info.colorDepth'),
            'device_memory' => $request->input('device_info.deviceMemory'),
            'time_zone' => $request->input('device_info.timeZone'),
            'touch_support' => $request->input('device_info.touchSupport'),
            'connection_type' => $request->input('device_info.connectionType'),
        ];
    }

    protected function getDevice()
    {
        if ($this->agent->isPhone()) {
            return $this->agent->device();
        }
        if ($this->agent->isTablet()) {
            return 'Tablet';
        }
        return 'Desktop';
    }
}
