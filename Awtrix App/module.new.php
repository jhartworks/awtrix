<?php

class AwtrixApp extends IPSModule
{
    public function Create()
    {
        parent::Create();

        $this->RegisterAttributeString('LastPayload', '');
        $this->RegisterAttributeString('LastAppName', '');

        $this->RegisterPropertyString('AwtrixIp', '172.78.88.67');
        $this->RegisterPropertyString('AppName', '');
        $this->RegisterPropertyString('Prefix', '');
        $this->RegisterPropertyString('Suffix', '');

        $this->RegisterVariables();

        if ($this->ReadAttributeString('LastPayload') === '') {
            $this->WriteAttributeString('LastPayload', $this->NormalizeForCompare($this->BuildAppPayload()));
        }

        if ($this->ReadAttributeString('LastAppName') === '') {
            $this->WriteAttributeString('LastAppName', $this->GetAppName());
        }
    }

    public function ApplyChanges()
    {
        parent::ApplyChanges();

        $payload = $this->BuildAppPayload();
        $payloadChanged = $this->NormalizeForCompare($payload) !== $this->ReadAttributeString('LastPayload');
        $appNameChanged = $this->GetAppName() !== $this->ReadAttributeString('LastAppName');

        if (!$payloadChanged && !$appNameChanged) {
            $this->SetStatus(102);
            return;
        }

        $this->SendApp();
    }

    public function RequestAction($Ident, $Value)
    {
        SetValue($this->GetIDForIdent($Ident), $Value);
        $this->SendApp();
    }

    public function SendApp()
    {
        $appName = $this->GetAppName();
        $payload = $this->BuildAppPayload();
        $previousAppName = $this->ReadAttributeString('LastAppName');

        if ($previousAppName !== '' && $previousAppName !== $appName) {
            $this->DeleteAppByName($previousAppName);
        }

        if (!$this->SendJsonRequest('/api/custom?name=' . rawurlencode($appName), $payload)) {
            return false;
        }

        $this->WriteAttributeString('LastPayload', $this->NormalizeForCompare($payload));
        $this->WriteAttributeString('LastAppName', $appName);
        return true;
    }

    public function DeleteApp()
    {
        $deleted = $this->DeleteAppByName($this->GetAppName());
        if ($deleted) {
            $this->WriteAttributeString('LastPayload', '');
            $this->WriteAttributeString('LastAppName', '');
        }

        return $deleted;
    }

    private function RegisterVariables()
    {
        $p = 0;

        $this->RegisterStringVariableWithDefault('text', 'Text', $this->StringInputPresentation(), $p += 10, '');
        $this->RegisterIntegerVariableWithDefault('textCase', 'Text Case', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 2,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5
        ], $p += 10, 0);
        $this->RegisterBooleanVariableWithDefault('topText', 'Top Text', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p += 10, false);
        $this->RegisterIntegerVariableWithDefault('textOffset', 'Text Offset', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 32,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5
        ], $p += 10, 0);
        $this->RegisterBooleanVariableWithDefault('center', 'Center Short Text', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p += 10, true);
        $this->RegisterIntegerVariableWithDefault('color', 'Text/Chart Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], $p += 10, 16777215);
        $this->RegisterBooleanVariableWithDefault('gradientEnabled', 'Gradient Enabled', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p += 10, false);
        $this->RegisterIntegerVariableWithDefault('gradient01', 'Gradient Color 1', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], $p += 10, 16777215);
        $this->RegisterIntegerVariableWithDefault('gradient02', 'Gradient Color 2', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], $p += 10, 16777215);
        $this->RegisterIntegerVariableWithDefault('blinkText', 'Blink Text (ms)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 10000,
            'STEP_SIZE' => 100,
            'USAGE_TYPE' => 5,
            'SUFFIX' => ' ms'
        ], $p += 10, 0);
        $this->RegisterIntegerVariableWithDefault('fadeText', 'Fade Text (ms)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 10000,
            'STEP_SIZE' => 100,
            'USAGE_TYPE' => 5,
            'SUFFIX' => ' ms'
        ], $p += 10, 0);
        $this->RegisterIntegerVariableWithDefault('background', 'Background Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], $p += 10, 0);
        $this->RegisterBooleanVariableWithDefault('rainbow', 'Rainbow Text', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p += 10, false);
        $this->RegisterStringVariableWithDefault('icon', 'Icon (ID/Filename/Base64)', $this->StringInputPresentation(), $p += 10, '');
        $this->RegisterIntegerVariableWithDefault('pushIcon', 'Push Icon', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 2,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5
        ], $p += 10, 0);
        $this->RegisterIntegerVariableWithDefault('repeat', 'Repeat (-1 Forever)', $this->NumericInputPresentation(), $p += 10, -1);
        $this->RegisterIntegerVariableWithDefault('duration', 'Duration (s)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 1,
            'MAX' => 300,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5,
            'SUFFIX' => ' s'
        ], $p += 10, 5);
        $this->RegisterStringVariableWithDefault('bar', 'Bar Values (JSON/CSV)', $this->StringInputPresentation(), $p += 10, '');
        $this->RegisterStringVariableWithDefault('line', 'Line Values (JSON/CSV)', $this->StringInputPresentation(), $p += 10, '');
        $this->RegisterBooleanVariableWithDefault('autoscale', 'Autoscale Bar/Line', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p += 10, true);
        $this->RegisterIntegerVariableWithDefault('barBC', 'Bar Background Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], $p += 10, 0);
        $this->RegisterIntegerVariableWithDefault('progress', 'Progress (-1 Off, 0-100)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => -1,
            'MAX' => 100,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5
        ], $p += 10, -1);
        $this->RegisterIntegerVariableWithDefault('progressC', 'Progress Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], $p += 10, 16777215);
        $this->RegisterIntegerVariableWithDefault('progressBC', 'Progress Background Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], $p += 10, 0);
        $this->RegisterIntegerVariableWithDefault('pos', 'Loop Position', $this->NumericInputPresentation(), $p += 10, 0);
        $this->RegisterStringVariableWithDefault('draw', 'Draw Instructions (JSON)', $this->StringInputPresentation(), $p += 10, '');
        $this->RegisterIntegerVariableWithDefault('lifetime', 'Lifetime (s)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 86400,
            'STEP_SIZE' => 10,
            'USAGE_TYPE' => 5,
            'SUFFIX' => ' s'
        ], $p += 10, 0);
        $this->RegisterIntegerVariableWithDefault('lifetimeMode', 'Lifetime Mode', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 1,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5
        ], $p += 10, 0);
        $this->RegisterBooleanVariableWithDefault('noScroll', 'Disable Scrolling', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p += 10, false);
        $this->RegisterIntegerVariableWithDefault('scrollSpeed', 'Scroll Speed (%)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 10,
            'MAX' => 200,
            'STEP_SIZE' => 5,
            'USAGE_TYPE' => 5,
            'SUFFIX' => ' %'
        ], $p += 10, 100);
        $this->RegisterStringVariableWithDefault('effect', 'Background Effect', $this->StringInputPresentation(), $p += 10, '');
        $this->RegisterStringVariableWithDefault('effectSettings', 'Effect Settings (JSON Map)', $this->StringInputPresentation(), $p += 10, '');
        $this->RegisterBooleanVariableWithDefault('save', 'Save App To Flash', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p += 10, false);
        $this->RegisterStringVariableWithDefault('overlay', 'Overlay', $this->StringInputPresentation(), $p += 10, 'clear');
        $this->RegisterVariableString('LastPayloadPreview', 'Last Payload', $this->StringInputPresentation(), $p += 10);
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

    private function BuildAppPayload()
    {
        $payload = [
            'textCase' => GetValueInteger($this->GetIDForIdent('textCase')),
            'topText' => GetValueBoolean($this->GetIDForIdent('topText')),
            'textOffset' => GetValueInteger($this->GetIDForIdent('textOffset')),
            'center' => GetValueBoolean($this->GetIDForIdent('center')),
            'color' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('color'))),
            'blinkText' => GetValueInteger($this->GetIDForIdent('blinkText')),
            'fadeText' => GetValueInteger($this->GetIDForIdent('fadeText')),
            'background' => $this->ColorToApi(GetValueInteger($this->GetIDForIdent('background'))),
            'rainbow' => GetValueBoolean($this->GetIDForIdent('rainbow')),
            'pushIcon' => GetValueInteger($this->GetIDForIdent('pushIcon')),
            'repeat' => GetValueInteger($this->GetIDForIdent('repeat')),
            'duration' => GetValueInteger($this->GetIDForIdent('duration')),
            'autoscale' => GetValueBoolean($this->GetIDForIdent('autoscale')),
            'noScroll' => GetValueBoolean($this->GetIDForIdent('noScroll')),
            'scrollSpeed' => GetValueInteger($this->GetIDForIdent('scrollSpeed'))
        ];

        $text = $this->ReadPropertyString('Prefix') . GetValueString($this->GetIDForIdent('text')) . $this->ReadPropertyString('Suffix');
        if ($text !== '') {
            $payload['text'] = $text;
        }

        $icon = trim(GetValueString($this->GetIDForIdent('icon')));
        if ($icon !== '') {
            $payload['icon'] = $icon;
        }

        if (GetValueBoolean($this->GetIDForIdent('gradientEnabled'))) {
            $payload['gradient'] = [
                $this->ColorToApi(GetValueInteger($this->GetIDForIdent('gradient01'))),
                $this->ColorToApi(GetValueInteger($this->GetIDForIdent('gradient02')))
            ];
        }

        $bar = $this->ParseIntListVariable('bar');
        if ($bar !== null) {
            $payload['bar'] = $bar;
            $payload['barBC'] = $this->ColorToApi(GetValueInteger($this->GetIDForIdent('barBC')));
        }

        $line = $this->ParseIntListVariable('line');
        if ($line !== null) {
            $payload['line'] = $line;
        }

        $progress = GetValueInteger($this->GetIDForIdent('progress'));
        if ($progress >= 0) {
            $payload['progress'] = $progress;
            $payload['progressC'] = $this->ColorToApi(GetValueInteger($this->GetIDForIdent('progressC')));
            $payload['progressBC'] = $this->ColorToApi(GetValueInteger($this->GetIDForIdent('progressBC')));
        }

        $draw = $this->ParseJsonVariable('draw', true);
        if ($draw !== null) {
            $payload['draw'] = $draw;
        }

        $pos = GetValueInteger($this->GetIDForIdent('pos'));
        if ($pos >= 0) {
            $payload['pos'] = $pos;
        }

        $lifetime = GetValueInteger($this->GetIDForIdent('lifetime'));
        if ($lifetime > 0) {
            $payload['lifetime'] = $lifetime;
            $payload['lifetimeMode'] = GetValueInteger($this->GetIDForIdent('lifetimeMode'));
        }

        $effect = trim(GetValueString($this->GetIDForIdent('effect')));
        if ($effect !== '') {
            $payload['effect'] = $effect;
        }

        $effectSettings = $this->ParseJsonVariable('effectSettings', false);
        if ($effectSettings !== null) {
            $payload['effectSettings'] = $effectSettings;
        }

        if (GetValueBoolean($this->GetIDForIdent('save'))) {
            $payload['save'] = true;
        }

        $overlay = trim(GetValueString($this->GetIDForIdent('overlay')));
        if ($overlay !== '') {
            $payload['overlay'] = $overlay;
        }

        return $payload;
    }

    private function ParseIntListVariable($ident)
    {
        $value = trim(GetValueString($this->GetIDForIdent($ident)));
        if ($value === '') {
            return null;
        }

        $json = json_decode($value, true);
        if (is_array($json)) {
            return array_map('intval', $json);
        }

        $parts = preg_split('/[\s,;]+/', $value, -1, PREG_SPLIT_NO_EMPTY);
        if (!is_array($parts) || count($parts) === 0) {
            return null;
        }

        return array_map('intval', $parts);
    }

    private function ParseJsonVariable($ident, $expectList)
    {
        $value = trim(GetValueString($this->GetIDForIdent($ident)));
        if ($value === '') {
            return null;
        }

        $decoded = json_decode($value, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            IPS_LogMessage('AWTRIX', 'Invalid JSON in ' . $ident . ': ' . json_last_error_msg());
            return null;
        }

        if ($expectList && array_keys($decoded) !== range(0, count($decoded) - 1)) {
            IPS_LogMessage('AWTRIX', 'Expected JSON array in ' . $ident);
            return null;
        }

        if (!$expectList && array_keys($decoded) === range(0, count($decoded) - 1)) {
            IPS_LogMessage('AWTRIX', 'Expected JSON object/map in ' . $ident);
            return null;
        }

        return $decoded;
    }

    private function GetAppName()
    {
        $appName = trim($this->ReadPropertyString('AppName'));
        if ($appName === '') {
            $appName = IPS_GetName($this->InstanceID);
        }

        $appName = preg_replace('/\s+/', '_', $appName);
        $appName = preg_replace('/[^A-Za-z0-9_-]/', '', $appName);

        if ($appName === '' || $appName === null) {
            $appName = 'app_' . $this->InstanceID;
        }

        return $appName;
    }

    private function DeleteAppByName($appName)
    {
        if ($appName === '') {
            return true;
        }

        return $this->SendRawPost('/api/custom?name=' . rawurlencode($appName), '');
    }

    private function SendJsonRequest($path, array $payload)
    {
        $response = $this->RequestAwtrix('POST', $path, json_encode($payload), ['Content-Type: application/json']);
        if ($response['success']) {
            SetValueString($this->GetIDForIdent('LastPayloadPreview'), json_encode($payload));
        }

        return $response['success'];
    }

    private function SendRawPost($path, $body)
    {
        return $this->RequestAwtrix('POST', $path, $body, [])['success'];
    }

    private function RequestAwtrix($method, $path, $body = null, array $headers = [])
    {
        $awtrixIp = trim($this->ReadPropertyString('AwtrixIp'));
        $url = 'http://' . $awtrixIp . $path;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 2000);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 5000);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if (count($headers) > 0) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }
            if ($body !== null) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            }
        } else {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $error !== '') {
            $this->SetStatus(104);
            IPS_LogMessage('AWTRIX', 'CURL error on ' . $path . ': ' . $error);
            return ['success' => false, 'raw' => $response];
        }

        if ($httpCode < 200 || $httpCode >= 300) {
            $this->SetStatus(104);
            IPS_LogMessage('AWTRIX', 'HTTP ' . $httpCode . ' on ' . $path . ': ' . $response);
            return ['success' => false, 'raw' => $response];
        }

        $this->SetStatus(102);
        return ['success' => true, 'raw' => $response];
    }

    private function ColorToApi($value)
    {
        $value = max(0, min((int) $value, 16777215));
        return '#' . strtoupper(str_pad(dechex($value), 6, '0', STR_PAD_LEFT));
    }

    private function NormalizeForCompare(array $value)
    {
        return json_encode($this->NormalizeValue($value));
    }

    private function NormalizeValue($value)
    {
        if (!is_array($value)) {
            return $value;
        }

        if (array_keys($value) === range(0, count($value) - 1)) {
            return array_map([$this, 'NormalizeValue'], $value);
        }

        ksort($value);
        foreach ($value as $key => $item) {
            $value[$key] = $this->NormalizeValue($item);
        }

        return $value;
    }

    private function StringInputPresentation()
    {
        if (defined('VARIABLE_PRESENTATION_INPUT')) {
            return ['PRESENTATION' => VARIABLE_PRESENTATION_INPUT];
        }

        return [];
    }

    private function NumericInputPresentation()
    {
        if (defined('VARIABLE_PRESENTATION_VALUE_INPUT')) {
            return ['PRESENTATION' => VARIABLE_PRESENTATION_VALUE_INPUT];
        }

        if (defined('VARIABLE_PRESENTATION_INPUT')) {
            return ['PRESENTATION' => VARIABLE_PRESENTATION_INPUT];
        }

        return [];
    }
}

?>
