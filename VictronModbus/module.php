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
    private $update = true;
    private $applied = false;
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
        $this->RegisterTimer('UpdateData', 0, $this->_getPrefix() . '_UpdateValues($_IPS[\'TARGET\'], false);');

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
     * Update everything
     */
    public function Update()
    {
        $this->UpdateValues();
    }
    /**
     * read & update update registers
     * @param bool $applied
     */
    public function UpdateValues($applied = false)
    {

        $this->update = 'values';
        $this->ReadData(VictronModbusRegister::value_addresses);

    }

    /**
     * read & update device registers VictronModbus_UpdateDevice
     * @param bool $applied
     */
    /**
     * save data to variables
     */
    public function SaveData()
    {
        // loop data and create variables
        $position = ($this->update == 'values') ? count(VictronModbusRegister::value_addresses) - 1 : 0;
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

    private function ReadData(array $addresses)
    {
        // read data
        foreach ($addresses as $address => $config) {
            try {
                // wait some time before continue
                if (count($addresses) > 2) {
                    IPS_Sleep(200);
                }
                // read register
                $value = $this->SendDataToParent(json_encode(Array("DataID" => "{E310B701-4AE7-458E-B618-EC13A1A6F6A8}", "Function" => 3, "Address" => $address , "Quantity" => $config['count'], "Data" => "")));
                $value = (unpack("n*", substr($value,2)));
                If (is_array($value)) {
                    if (count($value) == 1) {
                        $value = $value[1];

                        if (intval($config['type'] == 0)) {
                            $value = ($value / floatval($config['scale']));
                        } else {
                            $value = $this->bin16dec($value / floatval($config['scale']));
                        }
                    }
                }
                // map value
                if (isset($config['mapping'][$value])) {
                    $value = $this->Translate($config['mapping'][$value]);
                }

                // set profile
                if (isset($config['profile']) && !isset($this->profile_mappings[$config['name']])) {
                    $this->profile_mappings[$config['name']] = $config['profile'];
                }

                // set archive
                if (isset($config['archive'])) {
                    $this->archive_mappings[$config['name']] = $config['archive'];
                }

                // append data
                $this->data[$config['name']] = $value;
            }
            catch (Exception $e) {
            }

            // save data
            $this->SaveData();
        }
    }

    private function bin16dec($dec)
    {
        // converts 16bit binary number string to integer using two's complement
        $BinString = decbin($dec);
        $DecNumber = bindec($BinString) & 0xFFFF; // only use bottom 16 bits
        If (0x8000 & $DecNumber) {
            $DecNumber = - (0x010000 - $DecNumber);
        }
        return $DecNumber;
    }

    /**
     * create custom variable profile
     * @param string $profile_id
     * @param string $name
     */
    protected function CreateCustomVariableProfile(string $profile_id, string $name)
    {
        switch ($name):
            case 'Watt':
                IPS_CreateVariableProfile($profile_id, 2); // float
                IPS_SetVariableProfileDigits($profile_id, 0); // 0 decimals
                IPS_SetVariableProfileText($profile_id, '', ' W'); // Watt
                IPS_SetVariableProfileIcon($profile_id, 'Electricity');
                break;
            case 'kWh.Fixed':
                IPS_CreateVariableProfile($profile_id, 2); // float
                IPS_SetVariableProfileDigits($profile_id, 0); // 0 decimals
                IPS_SetVariableProfileText($profile_id, '', ' kWh'); // kWh.Fixed
                IPS_SetVariableProfileIcon($profile_id, 'Electricity');
                break;
            case 'Hours':
                IPS_CreateVariableProfile($profile_id, 2); // float
                IPS_SetVariableProfileDigits($profile_id, 1); // 1 decimal
                IPS_SetVariableProfileText($profile_id, '', ' ' . $this->Translate('h')); // Hours
                IPS_SetVariableProfileIcon($profile_id, 'Clock');
                break;
        endswitch;
    }
}
