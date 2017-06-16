<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-traits
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-traits
 * @version 0.1.0
 */

namespace cinghie\traits;

use kartik\widgets\Select2;
use Yii;

/**
 * Trait LanguageTrait
 *
 * @property string $language
 */
trait LanguageTrait
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language'], 'string', 'max' => 7],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'language' => Yii::t('traits', 'Language'),
        ];
    }

    /**
	 * Get language code (only 3 chars)
	 *
	 * @return string
	 */
    public function getLang() {
        return substr($this->language,0,2);
    }

    /**
     * Get language tag ()
     *
     * @return string
     */
    public function getLangTag() {
        return $this->language;
    }

    /**
     * Generate Language Form Widget
     *
     * @param \kartik\widgets\ActiveForm $form
     * @return \kartik\form\ActiveField
     */
    public function getLanguageWidget($form)
    {
        /** @var $this \yii\base\Model */
        return $form->field($this, 'language')->widget(Select2::classname(), [
            'data' => $this->getLanguagesSelect2(),
            'addon' => [
                'prepend' => [
                    'content'=>'<i class="glyphicon glyphicon-globe"></i>'
                ]
            ],
        ]);
    }

    /**
     * Return an array with languages allowed
     *
     * @return array
     */
    public function getLanguagesSelect2()
    {
        $languages = Yii::$app->urlManager->languages;
        $array = ['all' => Yii::t('traits', 'All Female')];

        foreach($languages as $language) {
            $array[$language] = strtoupper($language);
        }

        return $array;
    }

}
