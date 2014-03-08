<?php

/**
 * This is the model class for table "caleg".
 *
 * The followings are the available columns in table 'caleg':
 * @property string $id
 * @property string $user_id
 * @property integer $is_read
 * @property string $unlike_count
 * @property string $like_count
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
			array('is_read', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>128),
			array('user_id, unlike_count, like_count', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, is_read, unlike_count, like_count', 'safe', 'on'=>'search'),
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
			'unlike_count' => 'Unlike Count',
			'like_count' => 'Like Count',
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
		$criteria->compare('unlike_count',$this->unlike_count,true);
		$criteria->compare('like_count',$this->like_count,true);

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
}
