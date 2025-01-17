<?php
namespace TOURIST\Controller;
use Think\Controller;
class AccountController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    
    /**
     * 注册
     * localhost:8001/museum/index.php/TOURIST/Account/signin?username=test_user1&password=147258&tel=13112345678&nickname=测试用户&email=new@dl.com
     * @param unknown $username:	必须
     * @param unknown $password:	必须
     * @param unknown $email:	必须
     * @param string $tel:	非必须
     * @param string $nickname:	非必须
     */
    public function signin($username,$password,$email,$tel=null,$nickname=null){
        if(IS_GET){
            $user_table = M('normal_visiter');
            $condition['NV_NAME_TX'] = $username;
            /*检查是否已存在*/
            $user = $user_table->where($condition)->find();
            $condition = null;
            if($user != false) {
            	echo 'username exists!';
            	return;
            }
            
            $data = array(
                'NV_NAME_TX'	=> $username,
                'NV_PASSWORD_TX'=> md5($password),
                'NV_PHONE_TX'	=> $tel,
                'NV_EMAIL_TX'	=> $email,
                'NV_NICKNAME_TX'=> $nickname,
                'NV_STATE_TX_FX'=> 'ACT',
            );
            $ret=$user_table->add($data);
            $condition['NV_ID_INT_PK'] = $ret;
            $result_user = $user_table->where($condition)->find();
            echo JSON($result_user);
        }
        else{
            $this->error('请求方式错误！');
        }
    }

    /**
     * 登录
     * http://localhost:8001/Museum/index.php/TOURIST/Account/login?username=test_user&password=147258
     * @param string $username:	必须
     * @param string $password:	必须
     * @return	返回用户全部信息
     */
    public function login($username = null, $password = null){
        if(IS_GET){
            $user_table = M('normal_visiter');
            $map['NV_NAME_TX'] = $username;
            $map['NV_STATE_TX_FX'] = 'ACT';
            $normal_user = $user_table->where($map)->find();
            if(!$normal_user){
                echo 'user doesn\'t exist';
                $this->error('帐号不存在或被禁用');
            }
            if($normal_user['NV_PASSWORD_TX'] != md5($password)){
                echo('wrong password');
                $this->error('密码错误');
            }

            $data = array(
                'NV_ID_INT_PK'              => $normal_user['NV_ID_INT_PK'],
                'NV_LAST_LOGIN_TIMESTAMP' 	=> date('Y-m-d H:i:s',NOW_TIME),
            );
            $user_table->save($data);

            /* 记录登录SESSION和COOKIES */
            $auth = array(
                'uid'             => $normal_user['NV_ID_INT_PK'],
                'username'        => $normal_user['NV_NICKNAME_TX'],
                'last_login_time' => $data['NV_LAST_LOGIN_TIMESTAMP'],
            );
            session('user', $auth);
            echo JSON($normal_user);
        }
        else{
            $this->error('请求方式错误！');
        }
    }

    /**
     * log out
     * http://localhost8001/museum/index.php/TOURIST/Account/logout
     */
    public function logout() {
        if(is_login()){
            session('user', null);
            session('[destroy]');
            echo 'log out succeed';
            $this->success('退出成功！', U('login'));
        } else { 	
            $this->redirect('login');
        }
    }
    
    public function test() {
    	$value = session('user');
    	echo JSON($value);
    }
 
}