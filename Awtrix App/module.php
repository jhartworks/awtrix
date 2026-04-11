<?
// Klassendefinition
class AwtrixApp extends IPSModule {
    // Überschreibt die interne IPS_Create($id) Funktion

     private function RegisterAllAwtrixVariables(): void
    {
        $p = 0;

        // text
        $this->RegisterVarStr('text', 'Text', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, '', 1);

        // textCase (0..2)
        $this->RegisterVarInt('textCase', 'Textcase', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0, 'MAX' => 2, 'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5
        ], $p+=10, 0, 1);

        $this->RegisterVarBool('topText', 'Top Text', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, false, 1);

        $this->RegisterVarInt('textOffset', 'Text Offset', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0, 'MAX' => 32, 'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5
        ], $p+=10, 0, 1);

        $this->RegisterVarBool('center', 'Center short text', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, true, 1);

        // color (text/bar/line)
        $this->RegisterVarInt('color', 'Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0, 'COLOR_SPACE' => 0, 'COLOR_CURVE' => 0
        ], $p+=10, 16777215, 1);

        // gradient (AWTRIX expects array of 2 colors) -> we model as enable + 2 colors
        $this->RegisterVarBool('gradientEnabled', 'Gradient enabled', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, false, 1);

        $this->RegisterVarInt('gradient01', 'Gradient Color 1', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0, 'COLOR_SPACE' => 0, 'COLOR_CURVE' => 0
        ], $p+=10, 16777215, 1);

        $this->RegisterVarInt('gradient02', 'Gradient Color 2', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0, 'COLOR_SPACE' => 0, 'COLOR_CURVE' => 0
        ], $p+=10, 16777215, 1);

        // blinkText / fadeText (ms)
        $this->RegisterVarInt('blinkText', 'Blink Text (ms)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0, 'MAX' => 10000, 'STEP_SIZE' => 100,
            'USAGE_TYPE' => 5, 'SUFFIX' => ' ms'
        ], $p+=10, 0, 1);

        $this->RegisterVarInt('fadeText', 'Fade Text (ms)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0, 'MAX' => 10000, 'STEP_SIZE' => 100,
            'USAGE_TYPE' => 5, 'SUFFIX' => ' ms'
        ], $p+=10, 0, 1);

        // background
        $this->RegisterVarInt('background', 'Background', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0, 'COLOR_SPACE' => 0, 'COLOR_CURVE' => 0
        ], $p+=10, 0, 1);

        $this->RegisterVarBool('rainbow', 'Rainbow text', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, false, 1);

        // icon (id/filename/base64)
        $this->RegisterVarStr('icon', 'Icon (ID/Filename/Base64)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, '', 1);

        // pushIcon (0..2)
        $this->RegisterVarInt('pushIcon', 'Push Icon', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0, 'MAX' => 2, 'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5
        ], $p+=10, 0, 1);

        // repeat (-1 = forever)
        $this->RegisterVarInt('repeat', 'Repeat (-1 forever)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT,
            'USAGE_TYPE' => 5
        ], $p+=10, -1, 1);

        // duration (seconds)
        $this->RegisterVarInt('duration', 'Duration (s)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 1, 'MAX' => 300, 'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5, 'SUFFIX' => ' s'
        ], $p+=10, 5, 1);

        // Notification-only keys
        $this->RegisterVarBool('hold', 'Notification: hold', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, false, 1);

        $this->RegisterVarStr('sound', 'Notification: sound (filename/id)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, '', 1);

        $this->RegisterVarStr('rtttl', 'Notification: RTTTL string', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, '', 1);

        $this->RegisterVarBool('loopSound', 'Notification: loop sound', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, false, 1);

        // bar / line arrays -> store as JSON or CSV in a string
        $this->RegisterVarStr('bar', 'Bar values (JSON/CSV)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, '', 1);

        $this->RegisterVarStr('line', 'Line values (JSON/CSV)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, '', 1);

        $this->RegisterVarBool('autoscale', 'Autoscale bar/line', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, true, 1);

        $this->RegisterVarInt('barBC', 'Bar Background Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0, 'COLOR_SPACE' => 0, 'COLOR_CURVE' => 0
        ], $p+=10, 0, 1);

        // progress (-1 disables)
        $this->RegisterVarInt('progress', 'Progress (-1 off, 0..100)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => -1, 'MAX' => 100, 'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5
        ], $p+=10, -1, 1);

        $this->RegisterVarInt('progressC', 'Progress Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0, 'COLOR_SPACE' => 0, 'COLOR_CURVE' => 0
        ], $p+=10, -1, 1);

        $this->RegisterVarInt('progressBC', 'Progress Background Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0, 'COLOR_SPACE' => 0, 'COLOR_CURVE' => 0
        ], $p+=10, -1, 1);

        // pos (experimental)
        $this->RegisterVarInt('pos', 'Position in loop (experimental)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT,
            'USAGE_TYPE' => 5
        ], $p+=10, 0, 1);

        // draw (array of objects) -> string
        $this->RegisterVarStr('draw', 'Draw instructions (JSON)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, '', 1);

        // lifetime / lifetimeMode
        $this->RegisterVarInt('lifetime', 'Lifetime (s)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0, 'MAX' => 86400, 'STEP_SIZE' => 10,
            'USAGE_TYPE' => 5, 'SUFFIX' => ' s'
        ], $p+=10, 0, 1);

        $this->RegisterVarInt('lifetimeMode', 'Lifetime Mode (0 delete, 1 stale)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0, 'MAX' => 1, 'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5
        ], $p+=10, 0, 1);

        $this->RegisterVarBool('stack', 'Notification stack', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, true, 1);

        $this->RegisterVarBool('wakeup', 'Wakeup display on notification', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, false, 1);

        $this->RegisterVarBool('noScroll', 'Disable scrolling', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, false, 1);

        $this->RegisterVarStr('clients', 'Forward clients (JSON array)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, '', 1);

        $this->RegisterVarInt('scrollSpeed', 'Scroll Speed (%)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 10, 'MAX' => 200, 'STEP_SIZE' => 5,
            'USAGE_TYPE' => 5, 'SUFFIX' => ' %'
        ], $p+=10, 100, 1);

        $this->RegisterVarStr('effect', 'Background effect name', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, '', 1);

        $this->RegisterVarStr('effectSettings', 'Effect settings (JSON map)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, '', 1);

        $this->RegisterVarBool('save', 'Save app to flash (careful!)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], $p+=10, false, 1);

        // app-specific overlay (clear/snow/rain/...)
        $this->RegisterVarStr('overlay', 'Overlay (app-specific)', [
            'PRESENTATION' => VARIABLE_PRESENTATION_INPUT
        ], $p+=10, 'clear', 1);

    }
    
    private function SetDefaultIfNew(string $ident, callable $setter, $value): void
    {
        // RegisterVariable* kann je nach Strict/Non-Strict bool oder int liefern.
        // Deshalb setzen wir Default robust über GetIDForIdent.
        $varId = @$this->GetIDForIdent($ident);
        if ($varId > 0) {
            // Wenn Variable noch "leer" wäre, müsstest du New-Check anders machen.
            // Pragmatismus: Defaults immer setzen ist oft unerwünscht.
            // => Wir setzen Defaults NUR, wenn Variable noch nicht existierte: das checken wir über IPS_VariableExists.
            // Aber: GetIDForIdent wirft Fehler, wenn nicht existiert. Daher oben @.
        }

    }

    private function RegisterVarInt(string $ident, string $name, array $presentation, int $pos, int $default, int $enableAction = 1): void
    {
        $ret = $this->RegisterVariableInteger($ident, $name, $presentation, $pos);

        if ($enableAction) {
            $this->EnableAction($ident);
        }

        // Default nur setzen, wenn neu erstellt:
        if ($ret === true || is_int($ret)) {
            $id = is_int($ret) ? $ret : $this->GetIDForIdent($ident);
            SetValueInteger($id, $default);
        }
    }

    private function RegisterVarBool(string $ident, string $name, array $presentation, int $pos, bool $default, int $enableAction = 1): void
    {
        $ret = $this->RegisterVariableBoolean($ident, $name, $presentation, $pos);

        if ($enableAction) {
            $this->EnableAction($ident);
        }

        if ($ret === true || is_int($ret)) {
            $id = is_int($ret) ? $ret : $this->GetIDForIdent($ident);
            SetValueBoolean($id, $default);
        }
    }

    private function RegisterVarStr(string $ident, string $name, array $presentation, int $pos, string $default, int $enableAction = 1): void
    {
        $ret = $this->RegisterVariableString($ident, $name, $presentation, $pos);

        if ($enableAction) {
            $this->EnableAction($ident);
        }

        if ($ret === true || is_int($ret)) {
            $id = is_int($ret) ? $ret : $this->GetIDForIdent($ident);
            SetValueString($id, $default);
        }
    }


    
    public function Create() {

        $this->RegisterAttributeString('Settings','');


        $this->RegisterPropertyString('AwtrixIp','172.78.88.67');
        $this->RegisterPropertyString('Prefix','');
        $this->RegisterPropertyString('Suffix','');

        $this->RegisterAllAwtrixVariables();
     
        $this->UpdateConfig();

        $this->RegisterTimer("Update", 0, 'AWSET_UpdateConfig('.$this->InstanceID.');');
        $this->SetTimerInterval("Update", 10 * 1000);

        parent::Create();

    }

    // Überschreibt die intere IPS_ApplyChanges($id) Funktion
    public function ApplyChanges() {

            $this->SendSetting();
            $this->SendReboot();

        // Diese Zeile nicht löschen
        parent::ApplyChanges();
    }
    /**
    * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
    * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
    *
    * DWM_SendMessage($id);
    *
    */
    public function RequestAction($Ident, $Value) {
                $varid = $this->GetIDForIdent($Ident);
                SetValue($varid, $Value);

                
                $this->SendSetting();
    }

    public function SendSetting() {
   
            // Discord webhook URL
            $awtrixIp = $this->ReadPropertyString("AwtrixIp");
            $url="http://{$awtrixIp}/api/settings";

            $atime = GetValue($this->GetIDForIdent('ATIME'));
            $teff = GetValue($this->GetIDForIdent('TEFF'));
            $tspeed = GetValue($this->GetIDForIdent('TSPEED'));
            $tcol = GetValue($this->GetIDForIdent('TCOL'));
            $tmode = GetValue($this->GetIDForIdent('TMODE'));

            $chcol = GetValue($this->GetIDForIdent('CHCOL'));
            $cbcol = GetValue($this->GetIDForIdent('CBCOL'));
            $ctcol = GetValue($this->GetIDForIdent('CTCOL'));
            $wd = GetValueBoolean($this->GetIDForIdent('WD'));
            $wdca = GetValue($this->GetIDForIdent('WDCA'));
            $wdci = GetValue($this->GetIDForIdent('WDCI'));
            $bri = GetValue($this->GetIDForIdent('BRI'));
            $abri = GetValueBoolean($this->GetIDForIdent('ABRI'));
            $atrans = GetValueBoolean($this->GetIDForIdent('ATRANS'));

            $ccorrection = $this->ReadPropertyInteger("CCORRECTION");
            $ctemp = $this->ReadPropertyInteger("CTEMP");

            $tformat = $this->ReadPropertyString("TFORMAT");
            $dformat = $this->ReadPropertyString("DFORMAT");

            $som = $this->ReadPropertyBoolean("SOM");
            $cel = $this->ReadPropertyBoolean("CEL");

            $blockn = GetValueBoolean($this->GetIDForIdent('BLOCKN'));
            $uppercase = GetValueBoolean($this->GetIDForIdent('UPPERCASE'));

            $time_col = GetValue($this->GetIDForIdent('TIME_COL'));
            $date_col = GetValue($this->GetIDForIdent('DATE_COL'));
            $temp_col = GetValue($this->GetIDForIdent('TEMP_COL'));
            $hum_col = GetValue($this->GetIDForIdent('HUM_COL'));
            $bat_col = GetValue($this->GetIDForIdent('BAT_COL'));

            $sspeed = GetValue($this->GetIDForIdent('SSPEED'));

            $tim = $this->ReadPropertyBoolean("TIM");
            $dat= $this->ReadPropertyBoolean("DAT");
            $hum = $this->ReadPropertyBoolean("HUM");
            $temp = $this->ReadPropertyBoolean("TEMP");
            $bat = $this->ReadPropertyBoolean("BAT");

            $matp = GetValueBoolean($this->GetIDForIdent('MATP'));


            $settings = [

                // Anzeige
                "ATIME" => $atime,
                "TEFF" => $teff,
                "TSPEED" => $tspeed,
                "TMODE" => $tmode,

                // Farben
                "TCOL" => dechex($tcol),
                "TIME_COL" => dechex($time_col),
                "DATE_COL" => dechex($date_col),
                "TEMP_COL" => dechex($temp_col),
                "HUM_COL" => dechex($hum_col),
                "BAT_COL" => dechex($bat_col),

                "CHCOL" => dechex($chcol),
                "CBCOL" => dechex($cbcol),
                "CTCOL" => dechex($ctcol),

                "WDCA" => dechex($wdca),
                "WDCI" => dechex($wdci),

                // Time / Date
                "TFORMAT" => $tformat,
                "DFORMAT" => $dformat,

                // Verhalten
                "WD" => $wd,
                "SOM" => $som,
                "CEL" => $cel,

                // Matrix
                "BRI" => $bri,
                "ABRI" => $abri,
                "ATRANS" => $atrans,
                "CCORRECTION" => $ccorrection,
                "CTEMP" => $ctemp,
                "BLOCKN" => $blockn,
                "UPPERCASE" => $uppercase,
                "MATP" => $matp,

                // Apps aktivieren
                "TIM" => $tim,
                "DAT" => $dat,
                "TEMP" => $temp,
                "HUM" => $hum,
                "BAT" => $bat,

                // Overlay Effekt
                "OVERLAY" => "clear",

                // Scroll Speed
                "SSPEED" => $sspeed,

                // Sound
                "VOL" => 10
            ];

            // =============================
            // CURL Request
            // =============================
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json"
            ]);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($settings));

            $response = curl_exec($ch);
            $error = curl_error($ch);

            curl_close($ch);
        
            //$this->WriteAttributeString('Settings',$settings);

    
    }
    public function UpdateConfig() {
   
            $awtrixIp = $this->ReadPropertyString("AwtrixIp");
            $url="http://{$awtrixIp}/api/settings";
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPGET, true);

            $response = curl_exec($ch);
            $error = curl_error($ch);

            curl_close($ch);

            if ($error) {
                echo "CURL Error: " . $error;
                exit;
            }

            $data = json_decode($response, true);
            
          //  $persData = $this->ReadAttributeString('Settings');
           

            Setvalue($this->GetIDForIdent('ATIME'),$data['ATIME']);
            Setvalue($this->GetIDForIdent('TEFF'),$data['TEFF']);
            Setvalue($this->GetIDForIdent('TSPEED'),$data['TSPEED']);
            Setvalue($this->GetIDForIdent('TCOL'),$data['TCOL']);
            Setvalue($this->GetIDForIdent('TMODE'),$data['TMODE']);
            Setvalue($this->GetIDForIdent('CHCOL'),$data['CHCOL']);
            Setvalue($this->GetIDForIdent('CBCOL'),$data['CBCOL']);
            Setvalue($this->GetIDForIdent('CTCOL'),$data['CTCOL']);
            SetValueBoolean($this->GetIDForIdent('WD'),$data['WD'] ?? false);
            Setvalue($this->GetIDForIdent('WDCA'),$data['WDCA']);
            Setvalue($this->GetIDForIdent('WDCI'),$data['WDCI']);
            Setvalue($this->GetIDForIdent('BRI'),$data['BRI']);
            SetValueBoolean($this->GetIDForIdent('ABRI'),$data['ABRI'] ?? false);
            SetValueBoolean($this->GetIDForIdent('ATRANS'),$data['ATRANS'] ?? false);

            $this->UpdateFormField("CCORRECTION",'value',hexdec($data['CCORRECTION']) ?? 0);
            $this->UpdateFormField("CTEMP",'value',hexdec($data['CTEMP']) ?? 0);

            $this->UpdateFormField("TFORMAT",'value',$data['TFORMAT']);
            $this->UpdateFormField("DFORMAT",'value',$data['DFORMAT']);

            $this->UpdateFormField("SOM",'value',$data['SOM'] ?? true);
            $this->UpdateFormField("CEL",'value',$data['CEL'] ?? true);

            SetValueBoolean($this->GetIDForIdent('BLOCKN'), $data['BLOCKN'] ?? false);
            SetValueBoolean($this->GetIDForIdent('UPPERCASE'), $data['UPPERCASE'] ?? false);

            Setvalue($this->GetIDForIdent('TIME_COL'),hexdec($data['TIME_COL']));
            Setvalue($this->GetIDForIdent('DATE_COL'),hexdec($data['DATE_COL']));
            Setvalue($this->GetIDForIdent('TEMP_COL'),hexdec($data['TEMP_COL']));
            Setvalue($this->GetIDForIdent('HUM_COL'),hexdec($data['HUM_COL']));
            Setvalue($this->GetIDForIdent('BAT_COL'),hexdec($data['BAT_COL']));
            
            Setvalue($this->GetIDForIdent('SSPEED'),$data['SSPEED']);
            
            $this->UpdateFormField("TIM",'value',$data['TIM']);
            $this->UpdateFormField("DAT",'value',$data['DAT']);
            $this->UpdateFormField("HUM",'value',$data['HUM']);
            $this->UpdateFormField("TEMP",'value',$data['TEMP']);
            $this->UpdateFormField("BAT",'value',$data['BAT']);

            SetValueBoolean($this->GetIDForIdent('MATP'),$data['MATP'] ?? false);

            //$this->WriteAttributeString('Settings',$data);

            
  

    }

    public function SendReboot() {
   
            // Discord webhook URL
            $awtrixIp = $this->ReadPropertyString("AwtrixIp");
            $url="http://{$awtrixIp}/api/reboot";

            $settings = [

                // Anzeige

            ];

            // =============================
            // CURL Request
            // =============================
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json"
            ]);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($settings));

            $response = curl_exec($ch);
            $error = curl_error($ch);

            curl_close($ch);

    }

}

?>