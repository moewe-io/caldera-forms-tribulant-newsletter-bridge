<?php
$tribulant_lists = [];

$fields = array(
    array(
        'id'       => 'list_id',
        'label'    => __('Newsletter List Id', 'caldera-forms-tribulant-newsletter-bridge'),
        'desc'     => __('Users will be subscribed to this list.', 'caldera-forms-tribulant-newsletter-bridge'),
        'type'     => 'text',
        'required' => true,
        'magic'    => true,
    ),
    array(
        'id'       => 'email',
        'label'    => __('E-Mail', 'caldera-forms-tribulant-newsletter-bridge'),
        'desc'     => __('The users E-Mailadress', 'caldera-forms-tribulant-newsletter-bridge'),
        'type'     => 'text',
        'required' => true,
        'magic'    => true,
    ),
);

/** Add Tribulant Newsletters custom fields to the processors configuration. */
if (class_exists('wpMail')) {
    $wpMail = new wpMail();
    /** @var wpmlField $Field */
    global $Field;

    $tribulant_fields = $Field->get_all();
    if (is_array($tribulant_fields)) {
        /** @var wpmlField $tribulant_field */

        foreach ($tribulant_fields as $tribulant_field) {
            $fields[] = [
                'id'       => 'tribulant_' . $tribulant_field->slug,
                'label'    => __('Tribulant: ', 'caldera-forms-tribulant-newsletter-bridge') . $tribulant_field->title,
                'type'     => 'text',
                'required' => false,
                'magic'    => true,
            ];
        }
    }
}

return $fields;