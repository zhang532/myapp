<?php
namespace app\admin\model;

use think\Model;
use think\model\concern\SoftDelete;
class Admin extends Model
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
	/**
	 * 角色组
	 */
	public function groups()
	{
		return $this->belongsToMany(AuthGroup::class, AuthGroupAccess::class);
	}
	
	/**
	 * 加密
	 * @param {string} $password
	 * @param {string} $salt
	 * @param {string} $encrypt 加密方式
	 */
	public function encryptPassword($password, $salt = '', $encrypt = 'md5'){
		
		return $encrypt($password.$salt);
	}
	
	/**
	 * 重置密码
	 * @param {string} $uid
	 *  @param {string} $NewPassword
	 */
	public function resetPassword($uid, $NewPassword)
	{
		$passwd = $this->encryptPassword($NewPassword);
		$ret = $this->where(['id' => $uid])->update(['password' => $passwd]);
		return $ret;
	}
}