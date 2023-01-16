<?php

// declare(strict_types=1);
class VictronModbus extends IPSModule {
    public function __construct($InstanceID) {

        //Never delete this line!
        parent::__construct($InstanceID);

    }
    public function Create() {

        //Never delete this line!
        parent::Create();

        $this->ConnectParent("{A5F663AB-C400-4FE5-B207-4D67CC030564}");

        $this->RegisterPropertyInteger("Poller", 0);
        $this->RegisterPropertyInteger("Phase", 1);

        $this->RegisterTimer("Poller", 0, "VictronModbus_RequestRead(\$_IPS['TARGET']);");

    }

    public function ApplyChanges() {
        //Never delete this line!
        parent::ApplyChanges();


        $this->RegisterVariableFloat("GridL1", "Grid L1", "Watt.14490", 3);
        $this->RegisterVariableFloat("GridL2", "Grid L2", "Watt.14490", 3);
        $this->RegisterVariableFloat("GridL3", "Grid L3", "Watt.14490", 3);
        // $this->RegisterVariableFloat("kWh", "Total kWh", "Electricity", 4);
        $this->SetTimerInterval("Poller", $this->ReadPropertyInteger("Poller"));
    }

    public function RequestRead() {

        $Address = 0x334;
        $GridL1 = $this->SendDataToParent(json_encode(Array("DataID" => "{E310B701-4AE7-458E-B618-EC13A1A6F6A8}", "Function" => 3, "Address" => $Address , "Quantity" => 2, "Data" => "")));
        if($GridL1 === false)
            return;
        $GridL1 = (unpack("n*", substr($GridL1,2)));

        $Address = 0x335;
        $GridL2 = $this->SendDataToParent(json_encode(Array("DataID" => "{E310B701-4AE7-458E-B618-EC13A1A6F6A8}", "Function" => 3, "Address" => $Address , "Quantity" => 2, "Data" => "")));
        if($GridL2 === false)
            return;
        $GridL2 = (unpack("n*", substr($GridL2,2)));

        $Address = 0x336;
        $GridL3 = $this->SendDataToParent(json_encode(Array("DataID" => "{E310B701-4AE7-458E-B618-EC13A1A6F6A8}", "Function" => 3, "Address" => $Address , "Quantity" => 2, "Data" => "")));
        if($GridL3 === false)
            return;
        $GridL3 = (unpack("n*", substr($GridL3,2)));


        if(IPS_GetProperty(IPS_GetInstance($this->InstanceID)['ConnectionID'], "SwapWords")) {
            SetValue($this->GetIDForIdent("GridL1"), ($GridL1[1] + ($GridL1[2] << 16))/10);
            SetValue($this->GetIDForIdent("GridL2"), ($GridL2[1] + ($GridL2[2] << 16))/10);
            SetValue($this->GetIDForIdent("GridL3"), ($GridL3[1] + ($GridL3[2] << 16))/10);
        } else {
            SetValue($this->GetIDForIdent("GridL1"), ($GridL1[2] + ($GridL1[1] << 16))/10);
            SetValue($this->GetIDForIdent("GridL2"), ($GridL2[2] + ($GridL2[1] << 16))/10);
            SetValue($this->GetIDForIdent("GridL3"), ($GridL3[2] + ($GridL3[1] << 16))/10);
        }

    }


}
