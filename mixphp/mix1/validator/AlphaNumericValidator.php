<?php

/**
 * AlphaNumericValidator类
 * @author 刘健 <code.liu@qq.com>
 */

namespace mix\validator;

class AlphaNumericValidator extends BaseValidator
{

    // 允许的功能集合
    protected $allowActions = ['type', 'length', 'minLength', 'maxLength'];

    // 类型验证
    protected function type()
    {
        $value = $this->attributeValue;
        if (!preg_match('/^[a-zA-Z0-9]+$/i', $value)) {
            if (is_null($this->attributeMessage)) {
                $error = "{$this->attributeLabel}只能为字母和数字.";
            } else {
                $error = "{$this->attributeLabel}{$this->attributeMessage}";
            }
            $this->errors[] = $error;
            return false;
        }
        return true;
    }

}
