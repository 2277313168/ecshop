<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/2/26
 * Time: 16:17
 */
namespace Home\Model;
use Think\Model;
class AddressModel extends Model{
    protected $_validate = array(
        array('consignee','require','收件人姓名必须！'), //默认情况下用正则进行验证
        array('province','require','收件地址不完整！'), //默认情况下用正则进行验证
        array('city','require','收件地址不完整！'), //默认情况下用正则进行验证
        array('area','require','收件地址不完整！'), //默认情况下用正则进行验证
        array('street','require','收件地址不完整！'), //默认情况下用正则进行验证
        array('zipcode','require','邮政编码必须！'), //默认情况下用正则进行验证
        array('telephone','require','联系电话必须！'), //默认情况下用正则进行验证

    );

}