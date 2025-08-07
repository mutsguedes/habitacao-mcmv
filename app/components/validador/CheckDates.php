<?php

namespace app\components\validador;

use app\assets\AppAsset;
use DateTime;
use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap5\Html;
use yii\validators\Validator;

/**
 * CheckDates compares the specified attribute value with another value.
 *
 * The value being compared with can be another attribute value
 * (specified via [[compareAttribute]]) or a constant (specified via
 * [[compareValue]]. When both are specified, the latter takes
 * precedence. If neither is specified, the attribute will be compared
 * with another attribute whose name is by appending "_repeat" to the source
 * attribute name.
 *
 * CheckDates supports different comparison operators, specified
 * via the [[operator]] property.
 */
class CheckDates extends Validator {

    /**
     * @var string the name of the attribute to be compared with. When both this property
     * and [[compareValue]] are set, the latter takes precedence. If neither is set,
     * it assumes the comparison is against another attribute whose name is formed by
     * appending '_repeat' to the attribute being validated. For example, if 'password' is
     * being validated, then the attribute to be compared would be 'password_repeat'.
     * @see compareValue
     */
    public $compareAttribute;

    /**
     * @var mixed the constant value to be compared with. When both this property
     * and [[compareAttribute]] are set, this property takes precedence.
     * @see compareAttribute
     */
    public $compareValue;

    /**
     * @var string the operator for comparison. The following operators are supported:
     *
     * - `==`: check if two values are equal. The comparison is done is non-strict mode.
     * - `===`: check if two values are equal. The comparison is done is strict mode.
     * - `!=`: check if two values are NOT equal. The comparison is done is non-strict mode.
     * - `!==`: check if two values are NOT equal. The comparison is done is strict mode.
     * - `>`: check if value being validated is greater than the value being compared with.
     * - `>=`: check if value being validated is greater than or equal to the value being compared with.
     * - `<`: check if value being validated is less than the value being compared with.
     * - `<=`: check if value being validated is less than or equal to the value being compared with.
     */
    public $operator = '==';

    /**
     * @var string the user-defined error message. It may contain the following placeholders which
     * will be replaced accordingly by the validator:
     *
     * - `{attribute}`: the label of the attribute being validated
     * - `{value}`: the value of the attribute being validated
     * - `{compareValue}`: the value or the attribute label to be compared with
     * - `{compareAttribute}`: the label of the attribute to be compared with
     */
    public $message;

    /**
     * @var string Date format according to DateTime::createFromFormat specification.
     */
    public $format;

    /**
     * @var string Date format supported by moment.js. See http://momentjs.com/docs/#/parsing/string-format/
     */
    public $jsFormat;

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        if ($this->message === null) {
            switch ($this->operator) {
                case '==':
                    $this->message = Yii::t('yii', '{attribute} must be repeated exactly.');
                    break;
                case '===':
                    $this->message = Yii::t('yii', '{attribute} must be repeated exactly.');
                    break;
                case '!=':
                    $this->message = Yii::t('yii', '{attribute} must not be equal to "{compareValue}".');
                    break;
                case '!==':
                    $this->message = Yii::t('yii', '{attribute} must not be equal to "{compareValue}".');
                    break;
                case '>':
                    $this->message = Yii::t('yii', '{attribute} must be greater than "{compareValue}".');
                    break;
                case '>=':
                    $this->message = Yii::t('yii', '{attribute} must be greater than or equal to "{compareValue}".');
                    break;
                case '<':
                    $this->message = Yii::t('yii', '{attribute} must be less than "{compareValue}".');
                    break;
                case '<=':
                    $this->message = Yii::t('yii', '{attribute} must be less than or equal to "{compareValue}".');
                    break;
                default:
                    throw new InvalidConfigException("Unknown operator: {$this->operator}");
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute) {
        $value = $model->$attribute;
        if (is_array($value)) {
            $this->addError($model, $attribute, Yii::t('yii', '{attribute} is invalid.'));
            return;
        }
        if ($this->compareValue !== null) {
            $compareLabel = $compareValue = $this->compareValue;
        } else {
            $compareAttribute = $this->compareAttribute === null ? $attribute . '_repeat' : $this->compareAttribute;
            $compareValue = $model->$compareAttribute;
            $compareLabel = $model->getAttributeLabel($compareAttribute);
        }

        if (!$this->compareValues($this->operator, $value, $compareValue, $this->format)) {
            $this->addError($model, $attribute, $this->message, [
                'compareAttribute' => $compareLabel,
                'compareValue' => $compareValue,
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    protected function validateValue($value) {
        if ($this->compareValue === null) {
            throw new InvalidConfigException('CheckDates::compareValue must be set.');
        }
        if (!$this->compareValues($this->operator, $value, $this->compareValue, $this->format)) {
            return [$this->message, [
                    'compareAttribute' => $this->compareValue,
                    'compareValue' => $this->compareValue,
            ]];
        } else {
            return null;
        }
    }

    /**
     * Compares two values with the specified operator.
     * @param string $operator the comparison operator
     * @param mixed $value the value being compared
     * @param mixed $compareValue another value being compared
     * @return boolean whether the comparison using the specified operator is true.
     */
    protected function compareValues($operator, $value, $compareValue, $format) {
        $dateValue = empty($format) ? new DateTime($value) : DateTime::createFromFormat($format, $value);
        $dateCompareValue = empty($format) ? new DateTime($compareValue) : DateTime::createFromFormat($format, $compareValue);

        switch ($operator) {
            case '==':
                return $dateValue == $dateCompareValue;
            case '===':
                return $value === $compareValue;
            case '!=':
                return $dateValue != $dateCompareValue;
            case '!==':
                return $value !== $compareValue;
            case '>':
                return $dateValue > $dateCompareValue;
            case '>=':
                return $dateValue >= $dateCompareValue;
            case '<':
                return $dateValue < $dateCompareValue;
            case '<=':
                return $dateValue <= $dateCompareValue;
            default:
                return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function clientValidateAttribute($model, $attribute, $view) {
        $options = [
            'operator' => $this->operator
        ];

        if ($this->compareValue !== null) {
            $options['compareValue'] = $this->compareValue;
            $compareValue = $this->compareValue;
        } else {
            $compareAttribute = $this->compareAttribute === null ? $attribute . '_repeat' : $this->compareAttribute;
            $compareValue = $model->getAttributeLabel($compareAttribute);
            $options['compareAttribute'] = Html::getInputId($model, $compareAttribute);
        }

        if ($this->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }

        $options['message'] = Yii::$app->getI18n()->format($this->message, [
            'attribute' => $model->getAttributeLabel($attribute),
            'compareAttribute' => $compareValue,
            'compareValue' => $compareValue,
                ], Yii::$app->language);

        if (!empty($this->jsFormat)) {
            $options['format'] = $this->jsFormat;
        }
        AppAsset::register($view);
        return 'yiima.validation.datetimecompare(value, messages, ' . json_encode($options, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ');';
    }

}

/*    public function clientValidateAttribute($model, $attribute, $view) {
        //  if (empty($model->dt_hor_fal) && empty($model->dt_hor_sep)) {
        // $dt_hor_fal = $model->dt_hor_fal;
        //$dt_hor_sep = $model->dt_hor_sep;
        if ((new \DateTime($model->$attribute)) > (new \DateTime($model->$compareAttribute))) {
            $this->addError($model, $attribute, 'End date is not valid.');
            // }
            $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            //  $statuses = json_encode(Status::find()->select('id')->asArray()->column());
            return <<<JS
var def = $.Deferred(); 
messages.push($message); def.resolve();
deferred.push(def);
JS;
        }
    }

}*/
