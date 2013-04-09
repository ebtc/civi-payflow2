civi-payflow2
=============

The completion of the payflow plugin for CiviCRM (recurring billing).

Installing
=============

SQL changes: run the "install.sql" script to create an additional table, enable PayflowPro to be able to handle
             recurring payments and create a cron job within CiviCRM to handle the recurring updates.

Cron Job: a cron job needs to be set up on the server running CiviCRM (see Civi documentation on how to do that)
