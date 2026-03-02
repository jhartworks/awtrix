<?
// Klassendefinition
class AwtrixSettings extends IPSModule {
    // Überschreibt die interne IPS_Create($id) Funktion



    
    public function Create() {
        $this->RegisterAttributeString('Settings','');
        $this->RegisterAttributeInteger('State',0);

        $this->RegisterPropertyString('AwtrixIp','172.78.88.67');
        $this->RegisterPropertyBoolean('TIM',true);
        $this->RegisterPropertyBoolean('DAT',true);
        $this->RegisterPropertyBoolean('HUM',false);
        $this->RegisterPropertyBoolean('TEMP',false);
        $this->RegisterPropertyBoolean('BAT',false);
        $this->RegisterPropertyString('TFORMAT', '%H:%M:%S');
        $this->RegisterPropertyString('DFORMAT', '%d.%m');
        $this->RegisterPropertyBoolean('SOM',true);
        $this->RegisterPropertyBoolean('CEL',true);
        $this->RegisterPropertyInteger('CCORRECTION',16777215);
        $this->RegisterPropertyInteger('CTEMP',16777215);



         $this->RegisterVariableInteger ('ATIME', 'App duration', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 60,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5, ///5 = none
            'SUFFIX' => ' sec',
        ], 0);
        $this->EnableAction("ATIME");
        SetValueInteger($this->GetIDForIdent("ATIME"),7);

        $this->RegisterVariableInteger ('TEFF', 'App Transisioneffect', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 10,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5, ///5 = none
            'SUFFIX' => ''
        ], 10);
        $this->EnableAction("TEFF");
        SetValueInteger($this->GetIDForIdent("TEFF"),1);

        $this->RegisterVariableInteger ('TSPEED', 'Transisiontime', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 2000,
            'STEP_SIZE' => 50,
            'USAGE_TYPE' => 5, ///5 = none
            'SUFFIX' => ' ms'
        ], 20);
        $this->EnableAction("TSPEED");
        SetValueInteger($this->GetIDForIdent("TSPEED"),500);

         $this->RegisterVariableInteger ('TCOL', 'Global Text Color',[
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 30);
        $this->EnableAction("TCOL");
        SetValueInteger($this->GetIDForIdent("TCOL"),16777215); ///is white...Frank White

        $this->RegisterVariableInteger ('TMODE', 'Time App Style',[
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 6,
            'STEP_SIZE' => 1,
            'USAGE_TYPE' => 5, ///5 = none
            'SUFFIX' => ''
        ], 40);
        $this->EnableAction("TMODE");
        SetValueInteger($this->GetIDForIdent("TMODE"),1);

        $this->RegisterVariableInteger ('CHCOL', 'Calendar Header Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 50);
        $this->EnableAction("CHCOL");
        SetValueInteger($this->GetIDForIdent("CHCOL"),16711680); //Red like Reddington


         $this->RegisterVariableInteger ('CBCOL', 'Calendar Body Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 60);
        $this->EnableAction("CBCOL");
        SetValueInteger($this->GetIDForIdent("CBCOL"),16777215); //white


         $this->RegisterVariableInteger ('CTCOL', 'Calendar Text Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 70);
        $this->EnableAction("CTCOL");
        SetValueInteger($this->GetIDForIdent("CTCOL"),0); //i see black for you

        $this->RegisterVariableBoolean ('WD', 'show Weekday', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 80);
        $this->EnableAction("WD");
        SetValueBoolean($this->GetIDForIdent("WD"),0);

        $this->RegisterVariableInteger ('WDCA', 'Active Weekday Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 90);
        $this->EnableAction("WDCA");
        SetValueInteger($this->GetIDForIdent("WDCA"),65535);

         $this->RegisterVariableInteger ('WDCI', 'Inactive Weekday Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 100);
        $this->EnableAction("WDCI");
        SetValueInteger($this->GetIDForIdent("WDCI"),35071);

        $this->RegisterVariableInteger ('BRI', 'Brightness', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 255,
            'PERCENTAGE' => true,
            'USAGE_TYPE' => 2, ///5 = none
            'SUFFIX' => ' %'
        ], 110);
        $this->EnableAction("BRI");
        SetValueInteger($this->GetIDForIdent("BRI"),128);

         $this->RegisterVariableBoolean ('ABRI', 'Automatic Brightness', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 120);
        $this->EnableAction("ABRI");
        SetValueBoolean($this->GetIDForIdent("ABRI"),0);

         $this->RegisterVariableBoolean ('ATRANS', 'Automatic Transsions to  next App', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 130);
        $this->EnableAction("ATRANS");
        SetValueBoolean($this->GetIDForIdent("ATRANS"),1);

        $this->RegisterVariableBoolean('BLOCKN', 'Local Key Enable', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 160);
        $this->EnableAction("BLOCKN");
        SetValueBoolean($this->GetIDForIdent("BLOCKN"),1);

        $this->RegisterVariableBoolean('UPPERCASE', 'Display Uppercase', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 170);
        $this->EnableAction("UPPERCASE");
        SetValueBoolean($this->GetIDForIdent("UPPERCASE"),0);

        $this->RegisterVariableInteger ('TIME_COL', 'Time Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 180);
        $this->EnableAction("TIME_COL");
        SetValueInteger($this->GetIDForIdent("TIME_COL"),16777215);

         $this->RegisterVariableInteger ('DATE_COL', 'Date Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 190);
        $this->EnableAction("DATE_COL");
        SetValueInteger($this->GetIDForIdent("DATE_COL"),16777215);

        $this->RegisterVariableInteger ('TEMP_COL', 'Temperature Color',[
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 200);
        $this->EnableAction("TEMP_COL");
        SetValueInteger($this->GetIDForIdent("TEMP_COL"),16777215);

         $this->RegisterVariableInteger ('HUM_COL', 'Humidity Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 210);
        $this->EnableAction("HUM_COL");
        SetValueInteger($this->GetIDForIdent("HUM_COL"),16777215);

         $this->RegisterVariableInteger ('BAT_COL', 'Battery Color', [
            'PRESENTATION' => VARIABLE_PRESENTATION_COLOR,
            'ENCODING' => 0,
            'COLOR_SPACE' => 0,
            'COLOR_CURVE' => 0
        ], 220);
        $this->EnableAction("BAT_COL");
        SetValueInteger($this->GetIDForIdent("BAT_COL"),16777215);

         $this->RegisterVariableInteger ('SSPEED', 'Scrollspeed',[
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 100,
            'PERCENTAGE' => true,
            'USAGE_TYPE' => 2, ///5 = none
            'SUFFIX' => ' %'
        ], 230);
        $this->EnableAction("SSPEED");
        SetValueInteger($this->GetIDForIdent("SSPEED"),100);

        $this->RegisterVariableBoolean('MATP', 'Powerswitch', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SWITCH
        ], 240);
        $this->EnableAction("MATP");
        SetValueBoolean($this->GetIDForIdent("MATP"),1);

        $this->RegisterVariableString ('OVERLAY', 'Effectsoverlay', [
            'PRESENTATION' => VARIABLE_PRESENTATION_SLIDER,
            'MIN' => 0,
            'MAX' => 2000,
            'STEP_SIZE' => 50,
            'USAGE_TYPE' => 5, ///5 = none
            'SUFFIX' => ' ms'
        ], 250);
        /*Overlay effects:

            "clear"
            "snow"
            "rain"
            "drizzle"
            "storm"
            "thunder"
            "frost"*/
           
        // Diese Zeile nicht löschen.

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
        if (!$this->CheckIP()) {
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
    
    }
    public function UpdateConfig() {

        if ($this->CheckIP()) {
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

    }

    public function SendReboot() {

        if (!$this->CheckIP()) {
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

    public function CheckIP() {
   
            // Discord webhook URL
            $awtrixIp = $this->ReadPropertyString("AwtrixIp");
            $url="http://{$awtrixIp}/api/stats";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPGET, true);

            $response = curl_exec($ch);
            $error = curl_error($ch);

            curl_close($ch);
            if (!curl_errno($ch)) {
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($http_code == 200) {
                    return true;
                    $this->SetStatus(102);
                } else {
                    return false;
                    $this->SetStatus(104);
                }
            } else {
                return false;
                $this->SetStatus(104);
            }

    }
}

?>