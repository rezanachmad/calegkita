<?php

/**
 * This is the model class for table "caleg".
 *
 * The followings are the available columns in table 'caleg':
 * @property string $id
 * @property string $user_id
 * @property integer $is_read
 * @property integer $rate
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Caleg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'caleg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, user_id', 'required'),
			array('is_read, rate', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>128),
			array('user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, is_read, rate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'is_read' => 'Is Read',
			'rate' => 'Rate',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('is_read',$this->is_read);
		$criteria->compare('rate',$this->rate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Caleg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function isRead($userId, $calegId) {
            return self::model()->findByAttributes(array(
                'user_id' => $userId,
                'id' => $calegId,
                'is_read' => 1,
            ));
        }
        
        public static function countRead($userId, $lembagaId) {
            if (strlen($lembagaId) == 2) {
                $lembagaId = "{$lembagaId}00-00-0000";
            }
            
            $crit = new CDbCriteria();
            $crit->condition = 'user_id = :user_id AND is_read = :is_read AND id LIKE :id';
            $crit->params = array(
                ':user_id' => $userId,
                ':is_read' => 1,
                ':id' => "$lembagaId%",
            );
            return self::model()->count($crit);
        }
        
        public static function getRate($userId, $calegId) {
            $model = self::model()->findByAttributes(array(
                'user_id' => $userId,
                'id' => $calegId,
            ));
            if ($model != NULL) {
                return $model->rate;
            } else {
                return 0;
            }
        }
}
