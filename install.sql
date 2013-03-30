CREATE TABLE IF NOT EXISTS `civicrm_payflowpro_recur` (
  `invoice_id` varchar(64) NOT NULL,
  `profile_id` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

UPDATE `civicrm_payment_processor_type` SET is_recur = '1' WHERE name = 'PayflowPro';