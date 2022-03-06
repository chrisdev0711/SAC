<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
        'setScrapped' => 'Successfully set status as scrapped'
    ],

    'appliances' => [
        'name' => 'Appliances',
        'index_title' => 'Appliances List',
        'new_title' => 'New Appliance',
        'create_title' => 'Create Appliance',
        'edit_title' => 'Edit Appliance',
        'show_title' => 'Show Appliance',
        'imported' => 'Successfully imported',
        'qr_title' => 'QR Code OverView',
        'import' => 'Import',
        'view_image' => 'View Image',
        'returned' => 'Product successfully returned',
        'inputs' => [
            'SACNo' => 'Sac No',
            'Status' => 'Status',
            'ModelNumber' => 'Model Number',
            'Description' => 'Description',
            'Supplier' => 'Supplier',
            'purchase_date' => 'Purchase Date',
            'CostExVat' => 'Cost Ex Vat',
            'VAT' => 'Vat',
            'CostIncVAT' => 'Cost Inc Vat',
            'PONumber' => 'PO Number',
            'OtherRef' => 'Other Ref',
            'SerialNum' => 'Serial Num',
            'Description' => 'Description',
            'Grade' => 'Grade',
            'Location' => 'Location',
        ],
    ],

    'appliance_actions' => [
        'name' => 'Appliance Actions',
        'index_title' => 'Actions List',
        'new_title' => 'New Action',
        'create_title' => 'Create Action',
        'edit_title' => 'Edit Action',
        'show_title' => 'Show Action',
        'inputs' => [
            'action' => 'Action',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'actionee' => 'Actionee'
        ],
    ],

    'fault_diagnosis' => [
        'name' => 'Fault Diagnosis',
        'index_title' => 'Fault Diagnoses List',
        'new_title' => 'New Fault Diagnosis',
        'create_title' => 'Create Fault Diagnosis',
        'edit_title' => 'Edit Fault Diagnosis',
        'show_title' => 'Show Fault Diagnosis',
        'inputs' => [
            'time_started' => 'Time Started',
            'time_finished' => 'Time Finished',
            'fault_found' => 'Fault Found',
            'parts_required' => 'Parts Required',
            'repaired' => 'Repaired',
            'test_again' => 'Test Again',
        ],
    ],

    'actions' => [
        'name' => 'Actions',
        'index_title' => 'Actions List',
        'new_title' => 'New Action',
        'create_title' => 'Create Action',
        'edit_title' => 'Edit Action',
        'show_title' => 'Show Action',
        'inputs' => [
            'actionable_id' => 'Actionable Id',
            'actionable_type' => 'Actionable Type',
            'appliance_id' => 'Appliance',
            'actioned_by' => 'Actioned By',
        ],
    ],

    'cleaning' => [
        'name' => 'Cleaning',
        'index_title' => 'Cleanings List',
        'new_title' => 'New Cleaning',
        'create_title' => 'Create Cleaning',
        'edit_title' => 'Edit Cleaning',
        'show_title' => 'Show Cleaning',
        'inputs' => [
            'time_started' => 'Time Started',
            'time_finished' => 'Time Finished',
            'inside_before_img' => 'Inside Before Img',
            'outside_before_img' => 'Outside Before Img',
            'inside_after_img' => 'Inside After Img',
            'outside_after_img' => 'Outside After Img',
        ],
    ],

    'quality_control' => [
        'name' => 'Quality Control',
        'index_title' => 'QC Records',
        'new_title' => 'New Quality control',
        'create_title' => 'Create QC Record',
        'edit_title' => 'Edit QC Record',
        'show_title' => 'Show QC Record',
        'inputs' => [
            'condition' => 'Condition',
            'parts_burners' => 'Parts Burners',
            'parts_pan_supports' => 'Parts Pan Supports',
            'parts_grill_tray' => 'Parts Grill Tray',
            'parts_oven_shelves' => 'Parts Oven Shelves',
            'parts_oven_rails' => 'Parts Oven Rails',
            'parts_door_glass' => 'Parts Door Glass',
            'parts_fridge_shelves' => 'Parts Fridge Shelves',
            'cosmetic_marks' => 'Cosmetic Marks',
            'cosmetic_mark_1_img' => 'Cosmetic Mark 1 Img',
            'cosmetic_mark_2_img' => 'Cosmetic Mark 2 Img',
            'cosmetic_mark_3_img' => 'Cosmetic Mark 3 Img',
            'cosmetic_mark_4_img' => 'Cosmetic Mark 4 Img',
            'cosmetic_mark_5_img' => 'Cosmetic Mark 5 Img',
            'cosmetic_mark_6_img' => 'Cosmetic Mark 6 Img',
            'cosmetic_mark_7_img' => 'Cosmetic Mark 7 Img',
            'cosmetic_mark_8_img' => 'Cosmetic Mark 8 Img',
            'cosmetic_mark_9_img' => 'Cosmetic Mark 9 Img',
            'cosmetic_mark_10_img' => 'Cosmetic Mark 10 Img',
            'cosmetic_mark_11_img' => 'Cosmetic Mark 11 Img',
            'cosmetic_mark_12_img' => 'Cosmetic Mark 12 Img',
            'cosmetic_mark_13_img' => 'Cosmetic Mark 13 Img',
            'cosmetic_mark_14_img' => 'Cosmetic Mark 14 Img',
        ],
    ],

    'check_in' => [
        'name' => 'Check In',
        'index_title' => 'CheckIns List',
        'new_title' => 'New Check in',
        'create_title' => 'Create CheckIn',
        'edit_title' => 'Edit CheckIn',
        'show_title' => 'Show CheckIn',
        'inputs' => [
            'sac_no' => 'SACNo',
            'serial_num' => 'Serial Num',
            'condition' => 'Condition',
            'appliance_in_img' => 'Appliance In Img',
            'data_badge_img' => 'Data Badge Img',
        ],
    ],

    'plug_check' => [
        'name' => 'Plug Check',
        'index_title' => 'PlugChecks List',
        'new_title' => 'New Plug check',
        'create_title' => 'Create PlugCheck',
        'edit_title' => 'Edit PlugCheck',
        'show_title' => 'Show PlugCheck',
        'inputs' => [
            'pass_test' => 'Pass Test',
            'repair_type' => 'Repair Type',
            'insulation' => 'Inuslation resistance',
            'earth' => 'Earth continuity',
            'gas' => 'Gas Tightness Test pass'
        ],
    ],

    'listing' => [
        'name' => 'Listing',
        'index_title' => 'Listings List',
        'new_title' => 'New Listing',
        'create_title' => 'Create Listing',
        'edit_title' => 'Edit Listing',
        'show_title' => 'Show Listing',
        'inputs' => [
            'complete' => 'Completed',
            'note' => 'Note',
        ],
    ],

    'costing' => [
        'name' => 'Costing',
        'index_title' => 'Costings List',
        'new_title' => 'New Costing',
        'create_title' => 'Create Costing',
        'edit_title' => 'Edit Costing',
        'show_title' => 'Show Costing',
        'inputs' => [
            'complete' => 'Completed',
            'note' => 'Note',
        ],
    ],

    'ebay' => [
        'name' => 'Ebay',
        'index_title' => 'Ebays List',
        'new_title' => 'New Ebay',
        'create_title' => 'Create Ebay',
        'edit_title' => 'Edit Ebay',
        'show_title' => 'Show Ebay',
        'inputs' => [
            'complete' => 'Completed',
            'note' => 'Note',
        ],
    ],

    'finalized' => [
        'name' => 'Finalizing(ed)',
        'index_title' => 'Finalizing(ed)s List',
        'new_title' => 'New Finalizing',
        'create_title' => 'Create Finalizing',
        'edit_title' => 'Edit Finalized',
        'show_title' => 'Show Finalized',
        'inputs' => [
            'complete' => 'Completed',
            'note' => 'Note',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role'
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
