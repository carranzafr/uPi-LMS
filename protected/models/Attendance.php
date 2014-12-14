<?php

/**
 * This is the model class for table "attendances".
 *
 * The followings are the available columns in table 'attendances':
 * @property integer $id
 * @property string $start
 * @property string $end
 * @property string $tipo
 * @property integer $idsubject
 * @property integer $iddevice
 *
 * The followings are the available model relations:
 * @property Subjects $idsubject0
 * @property Devices $iddevice0
 * @property Users[] $users
 */
class Attendance extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'attendances';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		// will receive user inputs.
		return array(
			array('end, tipo, idsubject, iddevice', 'required'),
			array('idsubject, iddevice', 'numerical', 'integerOnly'=>true),
			array('tipo', 'length', 'max'=>255),
			array('end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, start, end, tipo, idsubject, iddevice', 'safe', 'on'=>'search'),
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
			'idsubject0' => array(self::BELONGS_TO, 'Subjects', 'idsubject'),
			'iddevice0' => array(self::BELONGS_TO, 'Devices', 'iddevice'),
			'users' => array(self::MANY_MANY, 'Users', 'usersattendances(idattendance, iduser)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'start' => 'Start',
			'end' => 'End',
			'tipo' => 'Tipo',
			'idsubject' => 'Idsubject',
			'iddevice' => 'Iddevice',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('idsubject',$this->idsubject);
		$criteria->compare('iddevice',$this->iddevice);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Attendance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
