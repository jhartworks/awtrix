<?php

class AwtrixSettings extends IPSModule
{
    private const APP_KEYS = ['TIM', 'DAT', 'HUM', 'TEMP', 'BAT'];

    public function Create()
    {
        parent::Create();

        $this->RegisterAttributeString('Settings', '');
        $this->RegisterAttributeString('LastSettings', '');
        $this->RegisterAttributeInteger('SyncInProgress', 0);
        $this->RegisterAttributeInteger('State', 0);

        $this->RegisterPropertyString('AwtrixIp', '172.78.88.67');
        $this->RegisterPropertyBoolean('TIM', true);
        $this->RegisterPropertyBoolean('DAT', true);
        $this->RegisterPropertyBoolean('HUM', false);
        $this->RegisterPropertyBoolean('TEMP', false);
        $this->RegisterPropertyBoolean('BAT', false);
        $this->RegisterPropertyString('TFORMAT', '%H:%M:%S');
        $this->RegisterPropertyString('DFORMAT', '%d.%m');
        $this->RegisterPropertyBoolean('SOM', true);
        $this->RegisterPropertyBoolean('CEL', true);
        $this->RegisterPropertyInteger('CCORRECTION', 16777215);
        $this->RegisterPropertyInteger('CTEMP', 16777215);

        $this->RegisterIntegerVariableWithDefault('ATIME', 'App duration', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 60,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5,
            'SUFFIX' => ' sec'
        ], 0, 7);

        $this->RegisterIntegerVariableWithDefault('TEFF', 'App Transisioneffect', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 10,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5,
            'SUFFIX' => ''
        ], 10, 1);

        $this->RegisterIntegerVariableWithDefault('TSPEED', 'Transisiontime', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 2000,
            'STEP_SIZE' => 50,
            'USAGE_TYPE' => 5,
            'SUFFIX' => ' ms'
        ], 20, 500);

        $this->RegisterIntegerVariableWithDefault('TCOL', 'Global Text Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 30, 16777215);

        $this->RegisterIntegerVariableWithDefault('TMODE', 'Time App Style', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 6,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5,
            'SUFFIX' => ''
        ], 40, 1);

        $this->RegisterIntegerVariableWithDefault('CHCOL', 'Calendar Header Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 50, 16711680);

        $this->RegisterIntegerVariableWithDefault('CBCOL', 'Calendar Body Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 60, 16777215);

        $this->RegisterIntegerVariableWithDefault('CTCOL', 'Calendar Text Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 70, 0);

        $this->RegisterBooleanVariableWithDefault('WD', 'show Weekday', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 80, false);

        $this->RegisterIntegerVariableWithDefault('WDCA', 'Active Weekday Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 90, 65535);

        $this->RegisterIntegerVariableWithDefault('WDCI', 'Inactive Weekday Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 100, 35071);

        $this->RegisterIntegerVariableWithDefault('BRI', 'Brightness', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 255,
            'PERCENTAGE' => true,
            'USAGE_TYPE' => 2,
            'SUFFIX' => ' %'
        ], 110, 128);

        $this->RegisterBooleanVariableWithDefault('ABRI', 'Automatic Brightness', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 120, false);

        $this->RegisterBooleanVariableWithDefault('ATRANS', 'Automatic Transsions to next App', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 130, true);

        $this->RegisterBooleanVariableWithDefault('BLOCKN', 'Local Key Enable', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 160, true);

        $this->RegisterBooleanVariableWithDefault('UPPERCASE', 'Display Uppercase', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 170, false);

        $this->RegisterIntegerVariableWithDefault('TIME_COL', 'Time Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 180, 16777215);

        $this->RegisterIntegerVariableWithDefault('DATE_COL', 'Date Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 190, 16777215);

        $this->RegisterIntegerVariableWithDefault('TEMP_COL', 'Temperature Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 200, 16777215);

        $this->RegisterIntegerVariableWithDefault('HUM_COL', 'Humidity Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 210, 16777215);

        $this->RegisterIntegerVariableWithDefault('BAT_COL', 'Battery Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 220, 16777215);

        $this->RegisterIntegerVariableWithDefault('SSPEED', 'Scrollspeed', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 100,
            'PERCENTAGE' => true,
            'USAGE_TYPE' => 2,
            'SUFFIX' => ' %'
        ], 230, 100);

        $this->RegisterBooleanVariableWithDefault('MATP', 'Powerswitch', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 240, true);

        $this->RegisterStringVariableWithDefault('OVERLAY', 'Effect overlay', [
        ], 250, 'clear');

        $this->RegisterTimer('Update', 0, 'AWSET_UpdateConfig(' . $this->InstanceID . ');');

        if ($this->ReadAttributeString('LastSettings') === '') {
            $this->WriteLastSettings($this->BuildSettingsPayload());
        }
    }

    public function ApplyChanges()
    {
        parent::ApplyChanges();

        if ($this->ReadAttributeInteger('SyncInProgress') === 1) {
            $this->WriteAttributeInteger('SyncInProgress', 0);
            $this->SetStatus(102);
            return;
        }

        $currentSettings = $this->BuildSettingsPayload();
        $lastSettings = $this->ReadLastSettings();

        if ($this->SettingsAreEqual($currentSettings, $lastSettings)) {
            $this->SetStatus(102);
            return;
        }

        if (!$this->SendSettingsPayload($currentSettings)) {
            return;
        }

        if ($this->AppStatesChanged($currentSettings, $lastSettings)) {
            $this->SendReboot();
        }

        $this->WriteLastSettings($currentSettings);
    }

    public function RequestAction($Ident, $Value)
    {
        SetValue($this->GetIDForIdent($Ident), $Value);
        $this->SendSetting();
    }

    public function SendSetting()
    {
        $settings = $this->BuildSettingsPayload();
        $lastSettings = $this->ReadLastSettings();

        if (!$this->SendSettingsPayload($settings)) {
            return false;
        }

        if ($this->AppStatesChanged($settings, $lastSettings)) {
            $this->SendReboot();
        }

        $this->WriteLastSettings($settings);
        return true;
    }

    public function UpdateConfig()
    {
        $result = $this->RequestAwtrix('GET', '/api/settings');
        if (!$result['success']) {
            return false;
        }

        if (!is_array($result['data'])) {
            $this->SetErrorState('Invalid response from /api/settings');
            return false;
        }

        $data = $result['data'];
        $this->WriteAttributeString('Settings', json_encode($data));

        $this->UpdateRuntimeVariablesFromApi($data);
        $this->UpdateFormFieldsFromApi($data);

        $normalized = $this->NormalizeSettingsFromApi($data);
        $this->WriteLastSettings($normalized);

        if ($this->UpdateStoredPropertiesFromApi($data)) {
            $this->WriteAttributeInteger('SyncInProgress', 1);
            IPS_ApplyChanges($this->InstanceID);
        } else {
            $this->SetStatus(102);
        }

        return true;
    }

    public function SendReboot()
    {
        $result = $this->RequestAwtrix('POST', '/api/reboot', []);
        return $result['success'];
    }

    public function CheckIP()
    {
        $result = $this->RequestAwtrix('GET', '/api/stats');
        return $result['success'];
    }

    private function RegisterIntegerVariableWithDefault($ident, $name, array $presentation, $position, $defaultValue)
    {
        $exists = $this->HasIdent($ident);
        $this->RegisterVariableInteger($ident, $name, $presentation, $position);
        $this->EnableAction($ident);

        if (!$exists) {
            SetValueInteger($this->GetIDForIdent($ident), $defaultValue);
        }
    }

    private function RegisterBooleanVariableWithDefault($ident, $name, array $presentation, $position, $defaultValue)
    {
        $exists = $this->HasIdent($ident);
        $this->RegisterVariableBoolean($ident, $name, $presentation, $position);
        $this->EnableAction($ident);

        if (!$exists) {
            SetValueBoolean($this->GetIDForIdent($ident), $defaultValue);
        }
    }

    private function RegisterStringVariableWithDefault($ident, $name, array $presentation, $position, $defaultValue)
    {
        $exists = $this->HasIdent($ident);
        $this->RegisterVariableString($ident, $name, $presentation, $position);
        $this->EnableAction($ident);

        if (!$exists) {
            SetValueString($this->GetIDForIdent($ident), $defaultValue);
        }
    }

    private function HasIdent($ident)
    {
        return (@$this->GetIDForIdent($ident) > 0);
    }

    private function BuildSettingsPayload()
    {
        $settings = [
            'ATIME' => GetValueInteger($this->GetIDForIdent('ATIME')),
            'TEFF' => GetValueInteger($this->GetIDForIdent('TEFF')),
            'TSPEED' => GetValueInteger($this->GetIDForIdent('TSPEED')),
            'TMODE' => GetValueInteger($this->GetIDForIdent('TMODE')),
            'TCOL' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('TCOL'))),
            'TIME_COL' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('TIME_COL'))),
            'DATE_COL' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('DATE_COL'))),
            'TEMP_COL' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('TEMP_COL'))),
            'HUM_COL' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('HUM_COL'))),
            'BAT_COL' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('BAT_COL'))),
            'CHCOL' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('CHCOL'))),
            'CBCOL' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('CBCOL'))),
            'CTCOL' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('CTCOL'))),
            'WDCA' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('WDCA'))),
            'WDCI' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('WDCI'))),
            'TFORMAT' => $this->ReadPropertyString('TFORMAT'),
            'DFORMAT' => $this->ReadPropertyString('DFORMAT'),
            'WD' => GetValueBoolean($this->GetIDForIdent('WD')),
            'SOM' => $this->ReadPropertyBoolean('SOM'),
            'CEL' => $this->ReadPropertyBoolean('CEL'),
            'BRI' => GetValueInteger($this->GetIDForIdent('BRI')),
            'ABRI' => GetValueBoolean($this->GetIDForIdent('ABRI')),
            'ATRANS' => GetValueBoolean($this->GetIDForIdent('ATRANS')),
            'CCORRECTION' => $this->ColorToApi($this->ReadPropertyInteger('CCORRECTION')),
            'CTEMP' => $this->ColorToApi($this->ReadPropertyInteger('CTEMP')),
            'BLOCKN' => GetValueBoolean($this->GetIDForIdent('BLOCKN')),
            'UPPERCASE' => GetValueBoolean($this->GetIDForIdent('UPPERCASE')),
            'MATP' => GetValueBoolean($this->GetIDForIdent('MATP')),
            'TIM' => $this->ReadPropertyBoolean('TIM'),
            'DAT' => $this->ReadPropertyBoolean('DAT'),
            'TEMP' => $this->ReadPropertyBoolean('TEMP'),
            'HUM' => $this->ReadPropertyBoolean('HUM'),
            'BAT' => $this->ReadPropertyBoolean('BAT'),
            'SSPEED' => GetValueInteger($this->GetIDForIdent('SSPEED')),
            'OVERLAY' => GetValueString($this->GetIDForIdent('OVERLAY'))
        ];

        return $settings;
    }

    private function SendSettingsPayload(array $settings)
    {
        $result = $this->RequestAwtrix('POST', '/api/settings', $settings);
        if ($result['success']) {
            $this->WriteAttributeString('Settings', json_encode($settings));
        }

        return $result['success'];
    }

    private function RequestAwtrix($method, $path, array $payload = null)
    {
        $awtrixIp = trim($this->ReadPropertyString('AwtrixIp'));
        $url = 'http://' . $awtrixIp . $path;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 2000);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 5000);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            if ($payload !== null) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            }
        } else {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $error !== '') {
            $this->SetErrorState('CURL error on ' . $path . ': ' . $error);
            return ['success' => false, 'data' => null, 'raw' => $response];
        }

        if ($httpCode < 200 || $httpCode >= 300) {
            $this->SetErrorState('HTTP ' . $httpCode . ' on ' . $path);
            return ['success' => false, 'data' => null, 'raw' => $response];
        }

        $data = null;
        if ($response !== '' && $response !== null) {
            $data = json_decode($response, true);
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                $data = null;
            }
        }

        $this->SetStatus(102);
        return ['success' => true, 'data' => $data, 'raw' => $response];
    }

    private function UpdateRuntimeVariablesFromApi(array $data)
    {
        $this->SetIntegerVariableIfPresent('ATIME', $data, 'ATIME');
        $this->SetIntegerVariableIfPresent('TEFF', $data, 'TEFF');
        $this->SetIntegerVariableIfPresent('TSPEED', $data, 'TSPEED');
        $this->SetColorVariableIfPresent('TCOL', $data, 'TCOL');
        $this->SetIntegerVariableIfPresent('TMODE', $data, 'TMODE');
        $this->SetColorVariableIfPresent('CHCOL', $data, 'CHCOL');
        $this->SetColorVariableIfPresent('CBCOL', $data, 'CBCOL');
        $this->SetColorVariableIfPresent('CTCOL', $data, 'CTCOL');
        $this->SetBooleanVariableIfPresent('WD', $data, 'WD');
        $this->SetColorVariableIfPresent('WDCA', $data, 'WDCA');
        $this->SetColorVariableIfPresent('WDCI', $data, 'WDCI');
        $this->SetIntegerVariableIfPresent('BRI', $data, 'BRI');
        $this->SetBooleanVariableIfPresent('ABRI', $data, 'ABRI');
        $this->SetBooleanVariableIfPresent('ATRANS', $data, 'ATRANS');
        $this->SetBooleanVariableIfPresent('BLOCKN', $data, 'BLOCKN');
        $this->SetBooleanVariableIfPresent('UPPERCASE', $data, 'UPPERCASE');
        $this->SetColorVariableIfPresent('TIME_COL', $data, 'TIME_COL');
        $this->SetColorVariableIfPresent('DATE_COL', $data, 'DATE_COL');
        $this->SetColorVariableIfPresent('TEMP_COL', $data, 'TEMP_COL');
        $this->SetColorVariableIfPresent('HUM_COL', $data, 'HUM_COL');
        $this->SetColorVariableIfPresent('BAT_COL', $data, 'BAT_COL');
        $this->SetIntegerVariableIfPresent('SSPEED', $data, 'SSPEED');
        $this->SetBooleanVariableIfPresent('MATP', $data, 'MATP');
        $this->SetStringVariableIfPresent('OVERLAY', $data, 'OVERLAY');
    }

    private function UpdateFormFieldsFromApi(array $data)
    {
        if (array_key_exists('TIM', $data)) {
            $this->UpdateFormField('TIM', 'value', (bool) $data['TIM']);
        }
        if (array_key_exists('DAT', $data)) {
            $this->UpdateFormField('DAT', 'value', (bool) $data['DAT']);
        }
        if (array_key_exists('HUM', $data)) {
            $this->UpdateFormField('HUM', 'value', (bool) $data['HUM']);
        }
        if (array_key_exists('TEMP', $data)) {
            $this->UpdateFormField('TEMP', 'value', (bool) $data['TEMP']);
        }
        if (array_key_exists('BAT', $data)) {
            $this->UpdateFormField('BAT', 'value', (bool) $data['BAT']);
        }
        if (array_key_exists('TFORMAT', $data)) {
            $this->UpdateFormField('TFORMAT', 'value', (string) $data['TFORMAT']);
        }
        if (array_key_exists('DFORMAT', $data)) {
            $this->UpdateFormField('DFORMAT', 'value', (string) $data['DFORMAT']);
        }
        if (array_key_exists('SOM', $data)) {
            $this->UpdateFormField('SOM', 'value', (bool) $data['SOM']);
        }
        if (array_key_exists('CEL', $data)) {
            $this->UpdateFormField('CEL', 'value', (bool) $data['CEL']);
        }
        if (array_key_exists('CCORRECTION', $data)) {
            $this->UpdateFormField('CCORRECTION', 'value', $this->ApiColorToInt($data['CCORRECTION']));
        }
        if (array_key_exists('CTEMP', $data)) {
            $this->UpdateFormField('CTEMP', 'value', $this->ApiColorToInt($data['CTEMP']));
        }
    }

    private function UpdateStoredPropertiesFromApi(array $data)
    {
        $changed = false;

        $changed = $this->UpdatePropertyIfChanged('TIM', array_key_exists('TIM', $data) ? (bool) $data['TIM'] : null) || $changed;
        $changed = $this->UpdatePropertyIfChanged('DAT', array_key_exists('DAT', $data) ? (bool) $data['DAT'] : null) || $changed;
        $changed = $this->UpdatePropertyIfChanged('HUM', array_key_exists('HUM', $data) ? (bool) $data['HUM'] : null) || $changed;
        $changed = $this->UpdatePropertyIfChanged('TEMP', array_key_exists('TEMP', $data) ? (bool) $data['TEMP'] : null) || $changed;
        $changed = $this->UpdatePropertyIfChanged('BAT', array_key_exists('BAT', $data) ? (bool) $data['BAT'] : null) || $changed;
        $changed = $this->UpdatePropertyIfChanged('TFORMAT', array_key_exists('TFORMAT', $data) ? (string) $data['TFORMAT'] : null) || $changed;
        $changed = $this->UpdatePropertyIfChanged('DFORMAT', array_key_exists('DFORMAT', $data) ? (string) $data['DFORMAT'] : null) || $changed;
        $changed = $this->UpdatePropertyIfChanged('SOM', array_key_exists('SOM', $data) ? (bool) $data['SOM'] : null) || $changed;
        $changed = $this->UpdatePropertyIfChanged('CEL', array_key_exists('CEL', $data) ? (bool) $data['CEL'] : null) || $changed;
        $changed = $this->UpdatePropertyIfChanged('CCORRECTION', array_key_exists('CCORRECTION', $data) ? $this->ApiColorToInt($data['CCORRECTION']) : null) || $changed;
        $changed = $this->UpdatePropertyIfChanged('CTEMP', array_key_exists('CTEMP', $data) ? $this->ApiColorToInt($data['CTEMP']) : null) || $changed;

        return $changed;
    }

    private function UpdatePropertyIfChanged($propertyName, $newValue)
    {
        if ($newValue === null) {
            return false;
        }

        $currentValue = IPS_GetProperty($this->InstanceID, $propertyName);
        if ($currentValue === $newValue) {
            return false;
        }

        IPS_SetProperty($this->InstanceID, $propertyName, $newValue);
        return true;
    }

    private function NormalizeSettingsFromApi(array $data)
    {
        $currentSettings = $this->BuildSettingsPayload();

        foreach (['ATIME', 'TEFF', 'TSPEED', 'TMODE', 'BRI', 'SSPEED'] as $key) {
            if (array_key_exists($key, $data)) {
                $currentSettings[$key] = (int) $data[$key];
            }
        }

        foreach (['WD', 'ABRI', 'ATRANS', 'BLOCKN', 'UPPERCASE', 'MATP', 'SOM', 'CEL', 'TIM', 'DAT', 'HUM', 'TEMP', 'BAT'] as $key) {
            if (array_key_exists($key, $data)) {
                $currentSettings[$key] = (bool) $data[$key];
            }
        }

        foreach (['TFORMAT', 'DFORMAT', 'OVERLAY'] as $key) {
            if (array_key_exists($key, $data)) {
                $currentSettings[$key] = (string) $data[$key];
            }
        }

        foreach (['TCOL', 'TIME_COL', 'DATE_COL', 'TEMP_COL', 'HUM_COL', 'BAT_COL', 'CHCOL', 'CBCOL', 'CTCOL', 'WDCA', 'WDCI', 'CCORRECTION', 'CTEMP'] as $key) {
            if (array_key_exists($key, $data)) {
                $currentSettings[$key] = $this->ColorToApi($this->ApiColorToInt($data[$key]));
            }
        }

        return $currentSettings;
    }

    private function SetIntegerVariableIfPresent($ident, array $data, $key)
    {
        if (array_key_exists($key, $data)) {
            SetValueInteger($this->GetIDForIdent($ident), (int) $data[$key]);
        }
    }

    private function SetBooleanVariableIfPresent($ident, array $data, $key)
    {
        if (array_key_exists($key, $data)) {
            SetValueBoolean($this->GetIDForIdent($ident), (bool) $data[$key]);
        }
    }

    private function SetStringVariableIfPresent($ident, array $data, $key)
    {
        if (array_key_exists($key, $data)) {
            SetValueString($this->GetIDForIdent($ident), (string) $data[$key]);
        }
    }

    private function SetColorVariableIfPresent($ident, array $data, $key)
    {
        if (array_key_exists($key, $data)) {
            SetValueInteger($this->GetIDForIdent($ident), $this->ApiColorToInt($data[$key]));
        }
    }

    private function ColorToApi($value)
    {
        $value = max(0, min((int) $value, 16777215));
        return strtolower(str_pad(dechex($value), 6, '0', STR_PAD_LEFT));
    }

    private function ApiColorToInt($value)
    {
        if (is_int($value)) {
            return $value;
        }

        $value = strtolower(trim((string) $value));
        $value = ltrim($value, '#');
        if ($value === '') {
            return 0;
        }

        if (ctype_xdigit($value)) {
            return (int) hexdec($value);
        }

        if (is_numeric($value)) {
            return (int) $value;
        }

        return (int) hexdec($value);
    }

    private function AppStatesChanged(array $currentSettings, array $lastSettings)
    {
        foreach (self::APP_KEYS as $key) {
            $currentValue = array_key_exists($key, $currentSettings) ? (bool) $currentSettings[$key] : false;
            $lastValue = array_key_exists($key, $lastSettings) ? (bool) $lastSettings[$key] : false;
            if ($currentValue !== $lastValue) {
                return true;
            }
        }

        return false;
    }

    private function SettingsAreEqual(array $left, array $right)
    {
        return $this->NormalizeForCompare($left) === $this->NormalizeForCompare($right);
    }

    private function NormalizeForCompare(array $settings)
    {
        ksort($settings);
        return json_encode($settings);
    }

    private function ReadLastSettings()
    {
        $json = $this->ReadAttributeString('LastSettings');
        if ($json === '') {
            return [];
        }

        $data = json_decode($json, true);
        return is_array($data) ? $data : [];
    }

    private function WriteLastSettings(array $settings)
    {
        $this->WriteAttributeString('LastSettings', $this->NormalizeForCompare($settings));
    }

    private function SetErrorState($message)
    {
        $this->SetStatus(104);
        IPS_LogMessage('AWTRIX', $message);
    }
}

?>
