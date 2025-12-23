<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Field Types Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration defines all available field types in the CMS.
    | Each field type includes settings for admin UI, public UI, validation,
    | and database storage.
    |
    */

    'text' => [
        'name' => 'Text',
        'description' => 'Single line text input',
        'admin_ui' => [
            'input_type' => 'text',
            'display_component' => 'text-field',
        ],
        'public_ui' => [
            'display_component' => 'text',
        ],
        'validation' => [
            'rules' => ['string', 'max:255'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'string',
            'max_length' => 255,
        ],
        'translatable' => true,
        'searchable' => true,
    ],

    'textarea' => [
        'name' => 'Textarea',
        'description' => 'Multi-line text input',
        'admin_ui' => [
            'input_type' => 'textarea',
            'display_component' => 'textarea-field',
        ],
        'public_ui' => [
            'display_component' => 'text',
        ],
        'validation' => [
            'rules' => ['string'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'text',
        ],
        'translatable' => true,
        'searchable' => true,
    ],

    'richtext' => [
        'name' => 'Rich Text',
        'description' => 'Rich text editor with formatting options',
        'admin_ui' => [
            'input_type' => 'richtext',
            'display_component' => 'richtext-field',
        ],
        'public_ui' => [
            'display_component' => 'html',
        ],
        'validation' => [
            'rules' => ['string'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'text',
        ],
        'translatable' => true,
        'searchable' => true,
    ],

    'number' => [
        'name' => 'Number',
        'description' => 'Numeric input field',
        'admin_ui' => [
            'input_type' => 'number',
            'display_component' => 'number-field',
        ],
        'public_ui' => [
            'display_component' => 'number',
        ],
        'validation' => [
            'rules' => ['numeric'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'integer',
        ],
        'translatable' => false,
        'searchable' => true,
    ],

    'email' => [
        'name' => 'Email',
        'description' => 'Email address input',
        'admin_ui' => [
            'input_type' => 'email',
            'display_component' => 'email-field',
        ],
        'public_ui' => [
            'display_component' => 'email-link',
        ],
        'validation' => [
            'rules' => ['email'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'string',
            'max_length' => 255,
        ],
        'translatable' => false,
        'searchable' => true,
    ],

    'url' => [
        'name' => 'URL',
        'description' => 'Web address input',
        'admin_ui' => [
            'input_type' => 'url',
            'display_component' => 'url-field',
        ],
        'public_ui' => [
            'display_component' => 'url-link',
        ],
        'validation' => [
            'rules' => ['url'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'string',
            'max_length' => 255,
        ],
        'translatable' => false,
        'searchable' => true,
    ],

    'date' => [
        'name' => 'Date',
        'description' => 'Date picker',
        'admin_ui' => [
            'input_type' => 'date',
            'display_component' => 'date-field',
        ],
        'public_ui' => [
            'display_component' => 'date',
        ],
        'validation' => [
            'rules' => ['date'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'date',
        ],
        'translatable' => false,
        'searchable' => true,
    ],

    'datetime' => [
        'name' => 'Date & Time',
        'description' => 'Date and time picker',
        'admin_ui' => [
            'input_type' => 'datetime-local',
            'display_component' => 'datetime-field',
        ],
        'public_ui' => [
            'display_component' => 'datetime',
        ],
        'validation' => [
            'rules' => ['date'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'datetime',
        ],
        'translatable' => false,
        'searchable' => true,
    ],

    'boolean' => [
        'name' => 'Boolean',
        'description' => 'True/False toggle',
        'admin_ui' => [
            'input_type' => 'checkbox',
            'display_component' => 'boolean-field',
        ],
        'public_ui' => [
            'display_component' => 'boolean',
        ],
        'validation' => [
            'rules' => ['boolean'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'boolean',
        ],
        'translatable' => false,
        'searchable' => true,
    ],

    'select' => [
        'name' => 'Select',
        'description' => 'Dropdown selection',
        'admin_ui' => [
            'input_type' => 'select',
            'display_component' => 'select-field',
        ],
        'public_ui' => [
            'display_component' => 'text',
        ],
        'validation' => [
            'rules' => ['string'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'string',
            'max_length' => 255,
        ],
        'translatable' => false,
        'searchable' => true,
    ],

    'multiselect' => [
        'name' => 'Multi Select',
        'description' => 'Multiple selection dropdown',
        'admin_ui' => [
            'input_type' => 'multiselect',
            'display_component' => 'multiselect-field',
        ],
        'public_ui' => [
            'display_component' => 'list',
        ],
        'validation' => [
            'rules' => ['array'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'json',
        ],
        'translatable' => false,
        'searchable' => true,
    ],

    'file' => [
        'name' => 'File Upload',
        'description' => 'File upload field',
        'admin_ui' => [
            'input_type' => 'file',
            'display_component' => 'file-field',
        ],
        'public_ui' => [
            'display_component' => 'file-link',
        ],
        'validation' => [
            'rules' => ['file'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'json',
        ],
        'translatable' => false,
        'searchable' => false,
    ],

    'image' => [
        'name' => 'Image Upload',
        'description' => 'Image upload field',
        'admin_ui' => [
            'input_type' => 'file',
            'display_component' => 'image-field',
        ],
        'public_ui' => [
            'display_component' => 'image',
        ],
        'validation' => [
            'rules' => ['image'],
            'default_rules' => ['required'],
        ],
        'database' => [
            'value_type' => 'json',
        ],
        'translatable' => false,
        'searchable' => false,
    ],
];