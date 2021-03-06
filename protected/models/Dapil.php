<?php

/**
 * This is the model class for table "dapil".
 *
 * The followings are the available columns in table 'dapil':
 * @property string $id
 * @property string $user_id
 * @property string $lembaga
 * @property string $nama
 * @property string $count
 * @property string $count_read
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Dapil extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dapil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, user_id, lembaga, nama', 'required'),
			array('id, nama', 'length', 'max'=>128),
			array('user_id, lembaga, count, count_read', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, lembaga, nama, count, count_read', 'safe', 'on'=>'search'),
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
			'lembaga' => 'Lembaga',
			'nama' => 'Nama',
			'count' => 'Count',
			'count_read' => 'Count Read',
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
		$criteria->compare('lembaga',$this->lembaga,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('count',$this->count,true);
		$criteria->compare('count_read',$this->count_read,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dapil the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
    /**
     * 
     * @param string $userId
     * @return Dapil[]
     */
    public function findAllByUserId($userId) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("user_id = :user_id");
        $criteria->order = 'lembaga ASC';
        $criteria->params = array(':user_id' => $userId);
        return Dapil::model()->findAll($criteria);
    }

}
