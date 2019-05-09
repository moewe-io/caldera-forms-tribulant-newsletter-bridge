<?php

class MOEWE_Caldera_Forms_Tribulant_Newsletter_Processor extends Caldera_Forms_Processor_Processor {

    public function __construct() {
        $processor_config = array(
            'name'           => __('Tribulant Newsletter', 'caldera-forms-download-processor'),
            'description'    => __('Subscribe the user to a Tribulant Newsletter list', 'caldera-forms-download-processor'),
            'post_processor' => [$this, 'subscribe_user'],
            'template'       => MOEWE_CALDERA_TRIBULANT_BASE_DIR . '/includes/config-ui.php',
            "single"         => false

        );

        $fields = include MOEWE_CALDERA_TRIBULANT_BASE_DIR . '/includes/fields.php';
        parent::__construct($processor_config, $fields, 'moewe_io_subscribe_to_tribulant_newsletter');
    }

    /**
     * Add a subscriber to a list
     *
     * @param array $subscriber_data Data for new subscriber
     * @param string $list_name Name of list
     *
     */
    public function subscribe_user(array $config, array $form, $proccesid) {
        $entry_id = Caldera_Forms::get_field_data('_entry_id', $form);
        $list_id = $config['list_id'];
        $email = Caldera_Forms::get_field_data($config['email'], $form, $entry_id);

        if (!class_exists('wpMail')) {
            return;
        }

        // Process Tribulant Newsletters custom fields

        $wpMail = new wpMail();
        /** @var wpmlSubscriber $Subscriber */
        global $Subscriber;
        $data = [
            'email'   => $email,
            'list_id' => [$list_id]
        ];

        /** @var wpmlField $Field */
        global $Field;
        $tribulant_fields = $Field->get_all();
        if (is_array($tribulant_fields)) {
            /** @var wpmlField $tribulant_field */

            foreach ($tribulant_fields as $tribulant_field) {
                $value = Caldera_Forms::get_field_data($config['tribulant_' . $tribulant_field->slug], $form, $entry_id);
                if (!empty($value)) {
                    $data[$tribulant_field->slug] = $value;
                }
            }
        }

        $Subscriber->optin($data, false);

    }

    /**
     * Validate the process if possible, and if not return errors.
     *
     * @param array $config Processor config
     * @param array $form Form config
     * @param string $proccesid Unique ID for this instance of the processor
     *
     * @return array Return if errors, do not return if not
     * @since 1.3.5.3
     *
     */
    public function pre_processor(array $config, array $form, $proccesid) {
        // Do nothing
    }

    /**
     * If validate do processing
     *
     * @param array $config Processor config
     * @param array $form Form config
     * @param string $proccesid Process ID
     *
     * @return array Return meta data to save in entry
     * @since 1.3.5.3
     *
     */
    public function processor(array $config, array $form, $proccesid) {
        // Do nothing
    }
}
