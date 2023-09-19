<?php

class Validate
{
    private ?Db $_db;
    private array $_errors = [];
    private bool $_passed = false;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items): void
    {
        $this->_errors = [];

        foreach ($items as $item => $rules) {
            $item = Input::sanitize($item);
            $display = $rules['display'];

            foreach ($rules as $rule => $rule_value) {
                $value = Input::sanitize(trim($source[$item]));

                if ($rule == 'required' && $rule_value && empty($value)) {
                    $this->addError(["{$display} is required", $item]);
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError(["{$display} must be a minimum of {$rule_value} characters.", $item]);
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError(["{$display} must be a maximum of {$rule_value} characters.", $item]);
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $matchDisplay = $items[$rule_value]['display'];
                                $this->addError(["{$matchDisplay} and {$display} must match.", $item]);
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->query("SELECT * FROM {$rule_value} WHERE {$item} = ?", [$value]);
                            if ($check->count()) {
                                $this->addError(["{$display} already exists. Please choose another {$display}.", $item]);
                            }
                            break;
                        case 'unique_update':
                            $t = explode(',', $rule_value);
                            $table = $t[0];
                            $id = $t[1];
                            $query = $this->_db->query("SELECT * FROM {$table} WHERE {$item} = ? AND {$table}_id != ?", [$value, $id]);
                            if ($query->count()) {
                                $this->addError(["{$display} already exists. Please choose another {$display}.", $item]);
                            }
                            break;
                        case 'is_numeric':
                            if (!is_numeric($value)) {
                                $this->addError(["{$display} must be a number.", $item]);
                            }
                            break;
                        case 'valid_email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError(["{$display} must be a valid email address.", $item]);
                            }
                            break;
                        case 'numeric':
                            if (!is_numeric($value)) {
                                $this->addError(["{$display} must be an integer.", $item]);
                            }
                            break;
                        case 'phone':
                            if (!preg_match('/[+]?(9[976]\d|8[987530]\d|6[987]\d|5[90]\d|42\d|3[875]\d|2[98654321]\d|9[8543210]|8[6421]|6[6543210]|5[87654321]|4[987654310]|3[9643210]|2[70]|7|1)\d{1,14}$/', $value)) {
                                $this->addError(["{$display} must be a valid phone number.", $item]);
                            }
                            break;
                    }
                }
            }

            if (empty($this->_errors)) {
                $this->_passed = true;
            } else {
                $this->_passed = false;
            }
        }
    }

    public function addError($error): void
    {
        $this->_errors[] = $error;
        if (empty($this->_errors)) {
            $this->_passed = true;
        } else {
            $this->_passed = false;
        }
    }

    public function errors(): array
    {
        return $this->_errors;
    }

    public function passed(): bool
    {
        return $this->_passed;
    }

    public function displayErrors(): string
    {
        $html = '<ul class="bg-light" style="border-radius: 5px;">';
        foreach ($this->_errors as $error) {
            if (is_array($error)) {
                $html .= '<li class="text-danger" style="padding: 2px;">' . $error[0] . '</li>';
                $html .= '<script>jQuery("document").ready(function(){jQuery("#' . $error[1] . '").parent().closest("div").addClass("has-error");});</script>';
            } else {
                $html .= '<li>' . $error . '</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
}