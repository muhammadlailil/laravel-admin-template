<?php

return [
     "Main Menu" => [
          [
               "id" => "dashboard",
               "name" => "Dashboard",
               "icon" => "isax icon-element-4",
               "url" => "dashboard",
          ],
          [
               "id" => "today-target",
               "name" => "Today Target",
               "icon" => "isax icon-watch",
               "url" => "today-target",
          ],
          [
               "id" => "manage-plan",
               "name" => "Manage Plan",
               "icon" => "isax icon-align-horizontally",
               "url" => "manage-plan",
          ],
          [
               "id" => "master-line",
               "name" => "Master Line",
               "icon" => "isax icon-bill",
               "url" => "master/factory-line"
          ],
          [
               "id" => "scan-barcode",
               "name" => "Scan Barcode",
               "icon" => "isax icon-barcode",
               "url" => "scanner",
          ],
          [
               "id" => "setting",
               "name" => "Setting",
               "icon" => "isax icon-setting-2",
               "url" => "setting",
          ],
     ],
     "Report" => [
          [
               "id" => "report-production",
               "name" => "Report Production",
               "icon" => "isax icon-building",
               "url" => "report/production",
          ],
          [
               "id" => "report-block",
               "name" => "Report per Block",
               "icon" => "isax icon-box-tick",
               "url" => "report/order-block",
          ]
     ],
     "Administrator" => [
          [
               "id" => "user-management",
               "name" => "Users Management",
               "icon" => "isax icon-profile-2user",
               "url" => "user-management",
          ]
     ]
];