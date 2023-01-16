<?php

// declare(strict_types=1);
define('__ROOT__', dirname(dirname(__FILE__)));
define('__MODULE__', dirname(__FILE__));

require_once(__ROOT__ . '/libs/helpers/autoload.php');
require_once(__MODULE__ . '/VictronModbusRegister.php');

/**
 * Class VictronModbus
 * IP-Symcon Victron Modbus Module
 *
 * @version     0.1
 * @category    Symcon
 * @package     VictronModbus
 * @author      Hermann Dötsch <info@doetsch-hermann.de>
 * @link        https://github.com/symcode
 *
 */
class VictronModbus extends Module
{
    use InstanceHelper;
    public $data = [];
    //public $position = [];
    protected $profile_mappings = [];
    protected $archive_mappings = [];
    /**public function __construct($InstanceID) {

        //Never delete this line!
        parent::__construct($InstanceID);

    }
     */
    public function Create() {

        //Never delete this line!
        parent::Create();

        $this->ConnectParent("{A5F663AB-C400-4FE5-B207-4D67CC030564}");

        $this->RegisterPropertyInteger('interval', 5);

        // register timers
        $this->RegisterTimer('UpdateData', 0, VictronModbus_SaveData($_IPS[\'TARGET\'], false);');

    }
    /**
     * execute, when kernel is ready
     */
    protected function onKernelReady()
    {
        $this->applied = true;

        // update timer
        $this->SetTimerInterval('UpdateData', $this->ReadPropertyInteger('interval') * 1000);

        $this->SaveData();
    }
    /**
     * save data to variables
     */
    private function SaveData()
    {
        // loop data and create variables
        $position = 1 ? count(VictronModbusRegister::value_addresses) - 1 : 0;
        foreach ($this->data AS $key => $value) {
            $this->CreateVariableByIdentifier([
                'parent_id' => $this->InstanceID,
                'name' => $key,
                'value' => $value,
                'position' => $position
            ]);
            $position++;
        }
    }

    public function RequestRead() {

        //$Address = 0x334;
        $GridL1 = $this->SendDataToParent(json_encode(Array("DataID" => "{E310B701-4AE7-458E-B618-EC13A1A6F6A8}", "Function" => 3, "Address" => 820 , "Quantity" => 1, "Data" => "")));
        //$this->SendDebug("GetData", "Grid L1".": ".$GridL1, 0);
        $GridL1 = (unpack("n*", substr($GridL1,2)));
        $this->SendDebug("GetData", "Grid L1".": ".$GridL1[1].",".$GridL1[2], 0);
        SetValue($this->GetIDForIdent("GridL1"), ($GridL1[1] + ($GridL1[2] << 16))/1);
        $this->SendDebug("GetData", "Grid L1".": ".($GridL1[1] + ($GridL1[2] << 16))/1, 0);

        //$Address = 0x335;
        $GridL2 = $this->SendDataToParent(json_encode(Array("DataID" => "{E310B701-4AE7-458E-B618-EC13A1A6F6A8}", "Function" => 3, "Address" => 821 , "Quantity" => 1, "Data" => "")));
        //$this->SendDebug("GetData", "Grid L2".": ".$GridL2, 0);
        $GridL2 = (unpack("n*", substr($GridL2,2)));
        $this->SendDebug("GetData", "Grid L2".": ".$GridL2[1].",".$GridL2[2], 0);
        SetValue($this->GetIDForIdent("GridL2"), ($GridL2[1] + ($GridL2[2] << 16))/1);
        $this->SendDebug("GetData", "Grid L2".": ".($GridL2[1] + ($GridL2[2] << 16))/1, 0);

        //$Address = 0x336;
        $GridL3 = $this->SendDataToParent(json_encode(Array("DataID" => "{E310B701-4AE7-458E-B618-EC13A1A6F6A8}", "Function" => 3, "Address" => 822 , "Quantity" => 1, "Data" => "")));
        //$this->SendDebug("GetData", "Grid L3".": ".$GridL3, 0);
        $GridL3 = (unpack("n*", substr($GridL3,2)));
        $this->SendDebug("GetData", "Grid L3".": ".$GridL3[1].",".$GridL3[2], 0);
        SetValue($this->GetIDForIdent("GridL3"), ($GridL3[1] + ($GridL3[2] << 16))/1);
        $this->SendDebug("GetData", "Grid L3".": ".($GridL3[1] + ($GridL3[2] << 16))/1, 0);

    }


}
