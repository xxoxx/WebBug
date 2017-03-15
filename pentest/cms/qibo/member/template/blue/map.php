<?php

extract($db->get_one("SELECT COUNT(*) AS articleNum FROM {$pre}article WHERE uid=$lfjuid"));
extract($db->get_one("SELECT COUNT(*) AS commentNum FROM {$pre}comment WHERE uid=$lfjuid"));
extract($db->get_one("SELECT COUNT(*) AS favNum FROM {$pre}collection WHERE uid=$lfjuid"));
extract($db->get_one("SELECT COUNT(*) AS reportNum FROM {$pre}report WHERE uid=$lfjuid"));
extract($db->get_one("SELECT COUNT(*) AS specialNum FROM {$pre}special WHERE uid=$lfjuid"));
extract($db->get_one("SELECT COUNT(*) AS moneylogNum FROM {$pre}moneylog WHERE uid=$lfjuid"));


?>