<?php

require_once('includes/prospect.inc');
require_once('includes/customer.inc');
require_once('includes/lead.inc');
require_once('includes/needs.inc');
require_once('includes/contact.inc');

$test = new stdClass();
$test->status = 'Qualified';
$test->type = 'Lead';
$test->name = 'Kate Guerrina';
$test->company = 'Chroma Technology Corp';
$test->yearlysales = '$' . number_format(150000,2);
$test->AccountsReceiveable = '$' . number_format(1000,2);
$test->AccountsReceiveableAge = '45 days';
$test->DaysPayableOutstanding = '65.3 days';
$test->terms = 'Net 30';

$contact = new Contact($test);

$prospectClass = 'Prospect' . $contact->getType();

$prospect = new $prospectClass($contact);

$needs = new NeedsAssessment($prospect);

