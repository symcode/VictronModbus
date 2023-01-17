<?php

/**
 * Class VictronModbusRegister
 * Constants with Victron Modbus register and value translations
 *
 * @version     0.1
 * @category    Symcon
 * @package     VictronModbus
 * @author      Hermann Dötsch <info@doetsch-hermann.de>
 * @link        https://github.com/symcode/VictronModbus
 *
 */
class VictronModbusRegister
{
    const value_addresses = [

            /**
             * Global
             */

            806 => [
                'name' => 'CCGX Relay 1 state',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'mapping' => [
                    0 => 'open',
                    1 => 'close'
                ]
            ],
            807 => [
                'name' => 'CCGX Relay 2 state',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'mapping' => [
                    0 => 'open',
                    1 => 'close'
                ]
            ],
            808 => [
                'name' => 'PV - AC-coupled on output L1',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            809 => [
                'name' => 'PV - AC-coupled on output L2',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            810 => [
                'name' => 'PV - AC-coupled on output L3',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            811 => [
                'name' => 'PV - AC-coupled on input L1',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            812 => [
                'name' => 'PV - AC-coupled on input L2',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            813 => [
                'name' => 'PV - AC-coupled on input L3',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            814 => [
                'name' => 'PV - AC-coupled on generator L1',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            815 => [
                'name' => 'PV - AC-coupled on generator L2',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            816 => [
                'name' => 'PV - AC-coupled on generator L3',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            817 => [
                'name' => 'AC Consumption L1',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            818 => [
                'name' => 'AC Consumption L2',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            819 => [
                'name' => 'AC Consumption L3',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            820 => [
                'name' => 'Grid L1',
                'count' => 1,
                'signed' => 1,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            821 => [
                'name' => 'Grid L2',
                'count' => 1,
                'signed' => 1,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            822 => [
                'name' => 'Grid L3',
                'count' => 1,
                'signed' => 1,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            823 => [
                'name' => 'Genset L1',
                'count' => 1,
                'signed' => 1,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            824 => [
                'name' => 'Genset L2',
                'count' => 1,
                'signed' => 1,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            825 => [
                'name' => 'Genset L3',
                'count' => 1,
                'signed' => 1,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            826 => [
                'name' => 'Active input source',
                'count' => 1,
                'signed' => 1,
                'type' => 4,
                'scale' => 1,
                'mapping' => [
                    0 => 'Unknown',
                    1 => 'Grid',
                    2 => 'Generator',
                    3 => 'Shore power'
                ]
            ],
            840 => [
                'name' => 'Battery Voltage (System)',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 10,
                'profile' => '~Volt'
            ],
            841 => [
                'name' => 'Battery Current (System)',
                'count' => 1,
                'signed' => 1,
                'type' => 1,
                'scale' => 10,
                'profile' => '~Ampere'
            ],
            842 => [
                'name' => 'Battery Power (System)',
                'count' => 1,
                'signed' => 1,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            843 => [
                'name' => 'Battery State of Charge (System)',
                'count' => 1,
                'signed' => 0,
                'type' => 2,
                'scale' => 1,
                'profile' => '~Battery.100'
            ],
            844 => [
                'name' => 'Battery State (System)',
                'count' => 1,
                'signed' => 0,
                'type' => 4,
                'scale' => 1,
                'mapping' => [
                    0 => 'idle',
                    1 => 'charging',
                    2 => 'discharging'
                ]
            ],
            845 => [
                'name' => 'Battery Consumed Amphours (System)',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => -10,
                'profile' => '~Electricity'
            ],
            846 => [
                'name' => 'Battery Time to Go (System)',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 0.01,
                'profile' => 'Hours'
            ],
            850 => [
                'name' => 'PV - DC-coupled power',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            851 => [
                'name' => 'PV - DC-coupled current',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 10,
                'profile' => '~Ampere'
            ],
            855 => [
                'name' => 'Charger power',
                'count' => 1,
                'signed' => 1,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ],
            860 => [
                'name' => 'DC System Power',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ]/**,
            865 => [
                'name' => 'VE.Bus charge current (System)',
                'count' => 1,
                'signed' => 1,
                'type' => 2,
                'scale' => 10,
                'profile' => '~Ampere'
            ],
            866 => [
                'name' => 'VE.Bus charge power (System)',
                'count' => 1,
                'signed' => 0,
                'type' => 1,
                'scale' => 1,
                'profile' => 'Watt'
            ]*/

        
    ];
}