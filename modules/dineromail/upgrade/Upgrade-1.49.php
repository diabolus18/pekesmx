<?php
/*
 * File: /upgrade/Upgrade-1.49.php
 * @file-version 0.2
 */

function upgrade_module_1_49($module) {
    // Process Module upgrade for commissions functionality
    return (
        Db::getInstance()->execute(
            'ALTER TABLE `' . _DB_PREFIX_ . Dineromail::DM_TABLE . '` ADD `fee` varchar(10) NULL'
        ) AND
        Configuration::updateValue(Dineromail::CONFIG_PREFIX.'_FEE', '0.00%')
    );
}

?>